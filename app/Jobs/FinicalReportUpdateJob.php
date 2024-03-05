<?php

namespace App\Jobs;

use App\Enums\BetStatus;
use App\Enums\TransactionName;
use App\Enums\UserType;
use App\Models\FinicalReport;
use App\Models\Transaction;
use App\Services\UserService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class FinicalReportUpdateJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Transaction::with(["payable", "slip"])
            ->where("is_report_generated", false)
            ->whereIn("name", [
                TransactionName::Stake,
                TransactionName::Payout,
                TransactionName::CreditAdjustment,
                TransactionName::DebitAdjustment,
                TransactionName::Commission
            ])
            ->orderBy("payable_id")
            ->chunkById(100, function ($transactions) {
                $items = [];
                $ids = [];
                foreach ($transactions as $transaction) {
                    $hierarchy = UserService::getUserHierarchy($transaction->payable);
                    
                    $slip = $transaction->slip;

                    if(!$slip->calculated_at){
                        continue;
                    }

                    $ids[] = $transaction->id;

                    $report_date = $this->reportDate($slip->calculated_at);

                    foreach ($hierarchy as $user) {
                        $key = $report_date . "_" . $user->id;
                        if (!isset($items[$key])) {
                            $items[$key] = [
                                "date" => $report_date,
                                "user_id" => $user->id,
                                "turnover" => 0,
                                "payout" => 0,
                                "commission" => 0,
                            ];
                        }

                        $amount = abs($transaction->amount);

                        if ($user->type == UserType::Admin && $user->id == $transaction->payable_id) {
                            if ($transaction->name == TransactionName::Commission && $user->id == $transaction->payable_id && $transaction->type == "deposit") {
                                $items[$key]["commission"] += $amount;
                            }
                            continue;
                        }

                        if ($transaction->name == TransactionName::Stake) {
                            $items[$key]["turnover"] += $amount;
                        }
                        if (
                            $transaction->name == TransactionName::Payout
                            || $transaction->name == TransactionName::CreditAdjustment
                        ) {
                            $items[$key]["payout"] += $amount;
                        }
                        if ($transaction->name == TransactionName::DebitAdjustment) {
                            $items[$key]["payout"] -= $amount;
                        }
                        if ($transaction->name == TransactionName::Commission && $user->id == $transaction->payable_id) {
                            $items[$key]["commission"] += $amount;
                        }
                    }
                }

                $report_dates = collect($items)->pluck("date");

                $existing_reports = FinicalReport::whereIn("date", $report_dates)->select(DB::raw('CONCAT(date, "_", user_id) as unique_report_key'))->pluck("unique_report_key")->toArray();

                $new_reports = collect($items)->filter(function ($item) use ($existing_reports) {
                    return !in_array($item["date"] . "_" . $item["user_id"], $existing_reports);
                })->values();

                if ($new_reports->count() > 0) {
                    FinicalReport::insert($new_reports->toArray());
                }

                $update_reports = collect($items)->filter(function ($item) use ($existing_reports) {
                    return in_array($item["date"] . "_" . $item["user_id"], $existing_reports);
                })->values();

                foreach($update_reports as $update_report){
                    $date = $update_report["date"];
                    $user_id = $update_report["user_id"];

                    unset($update_report["date"]);
                    unset($update_report["user_id"]);

                    FinicalReport::where("date", $date)->where("user_id", $user_id)->incrementEach($update_report);
                }

                Transaction::whereIn("id", $ids)->update([
                    "is_report_generated" => true
                ]);
            });
    }

    private function reportDate($date)
    {
        $date->setTimezone("Asia/Yangon");

        $separator = $date->copy()->setTime(12, 0, 0);

        $day_to_add = 0;

        $second_diff = $date->diffInSeconds($separator, false);

        if ($second_diff < 1) {
            $day_to_add = 1;
        }

        return $date->addDays($day_to_add)->format("Y-m-d");
    }
}

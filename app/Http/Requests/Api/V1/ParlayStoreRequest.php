<?php

namespace App\Http\Requests\Api\V1;

use App\Enums\BetType;
use App\Enums\AbSelectableSide;
use App\Enums\OuSelectableSide;
use App\Models\Market;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ParlayStoreRequest extends FormRequest
{
    protected array $bets;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => [
                'required',
                'numeric',
                'min:1000',
            ],
            'bets' => [
                'required',
                'array',
                'min:2',
                'max:11'
            ],
            'bets.*.market_id' => ['required', 'exists:markets,id', function ($attribute, $value, Closure $fail) {
                $index = explode('.', $attribute)[1];
                foreach ($this->input("bets") as $index_2 => $bet) {
                    if ($index != $index_2 && $bet["market_id"] == $value) {
                        $fail("Cant have same market id for {$attribute}");
                    }
                }
            }],
            'bets.*.type' => [
                'required',
                new Enum(BetType::class),
                function ($attribute, $value, Closure $fail) {
                    $index = explode('.', $attribute)[1];
                    $market_id = $this->input("bets.{$index}.market_id");

                    if (BetType::tryFrom($value)) {
                        $market = Market::whereNotNull($value)->where("id", $market_id)->first();

                        if (!$market) {
                            $fail("No odd data for {$attribute}");
                        }
                    }
                }
            ],
            'bets.*.selected_side' => Rule::forEach(function ($value, $attribute) {
                $index = explode('.', $attribute)[1];
                $type = $this->input("bets.{$index}.type");

                return [
                    "required",
                    $type === BetType::Ab->value
                        ? new Enum(AbSelectableSide::class)
                        : new Enum(OuSelectableSide::class)
                ];
            })
        ];
    }

    public function bets()
    {
        $bets = [];

        foreach ($this->input("bets") as $bet) {
            $bets[] = [
                "market" => Market::whereNotNull($bet["type"])->where("id", $bet["market_id"])->first(),
                "type" => BetType::from($bet["type"]),
                "selected_side" => $bet["type"] == BetType::Ab->value ? AbSelectableSide::from($bet["selected_side"]) : OuSelectableSide::from($bet["selected_side"])
            ];
        }

        return $bets;
    }
}

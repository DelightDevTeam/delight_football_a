<?php

namespace App\Http\Requests\Api\V1;

use App\Enums\AbSelectableSide;
use App\Enums\BetType;
use App\Enums\OuSelectableSide;
use App\Models\Market;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class SingleStoreRequest extends FormRequest
{   
    protected array $bet = [];

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
            'bet' => [
                'required',
            ],
            'bet.market_id' => ['required', 'exists:markets,id'],
            'bet.type' => [
                'required',
                new Enum(BetType::class),
                function ($attribute, $value, Closure $fail) {
                    $market_id = $this->input("bet.market_id");

                    if (BetType::tryFrom($value)) {
                        $market = Market::whereNotNull($value)->where("id", $market_id)->first();

                        if (!$market) {
                            $fail("No odd data for {$attribute}");
                        }
                    }
                }
            ],
            'bet.selected_side' => Rule::forEach(function ($value, $attribute) {
                $type = $this->input("bet.type");

                return [
                    "required",
                    $type === BetType::Ab->value
                        ? new Enum(AbSelectableSide::class)
                        : new Enum(OuSelectableSide::class)
                ];
            })
        ];
    }

    public function bet(){
        return $this->bet = [
            "market" => Market::whereNotNull($this->input("bet.type"))->where("id", $this->input("bet.market_id"))->first(),
            "type" => BetType::from($this->input("bet.type")),
            "selected_side" => $this->input("bet.type") == BetType::Ab->value ? AbSelectableSide::from($this->input("bet.selected_side")) : OuSelectableSide::from($this->input("bet.selected_side"))
        ];
    }
}

<?php

namespace App\Http\Requests\Api\V1;

use App\Enums\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class WithdrawRequestStoreRequest extends FormRequest
{
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
            "account_name" => ["required"],
            "account_username" => ["required"],
            "amount" => ["required", "numeric", "max:" . $this->user()->balance],
            "payment_method" => ["required", new Enum(PaymentMethod::class)],
        ];
    }
}

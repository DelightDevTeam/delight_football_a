<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case KPay = "k_pay";
    case WaveMoney = "wave_money";
}

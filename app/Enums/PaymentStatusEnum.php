<?php
namespace App\Enums;

abstract class PaymentStatusEnum
{
    const
    PENDING = 'pending',
    PAID = 'paid',
    LATE = 'late',
    Lack = 'lack',
    FINISH = 'finish'
    ;
}

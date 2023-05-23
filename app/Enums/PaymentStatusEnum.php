<?php

namespace App\Enums;

enum PaymentStatusEnum:string {
    case Processing = 'processing';
    case Failed = 'failured';
    case Approved = 'approved';
}

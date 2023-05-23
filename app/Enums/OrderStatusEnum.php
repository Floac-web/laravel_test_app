<?php

namespace App\Enums;

enum OrderStatusEnum:string {
    case Wait = 'waiting';
    case Approved = 'approved';
    case Failed = 'failured';
}

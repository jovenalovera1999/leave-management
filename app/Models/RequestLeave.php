<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestLeave extends Model
{
    use HasFactory;

    protected $table = 'tbl_request_leaves';
    protected $primaryKey = 'request_leave_id';
    protected $fillable = [
        'employee_id',
        'leave_id',
        'leave_date_from',
        'leave_date_to',
        'is_with_pay',
        'is_approved',
        'is_deleted',
    ];
}

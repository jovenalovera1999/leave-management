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
        'regular_salary',
        'regular schedule_date_from',
        'regular_schedule_date_to',
        'leave_date_from',
        'leave_date_to',
        'salary_deduction',
        'leave_id',
        'remaining_days',
        'is_deleted',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypesOfLeave extends Model
{
    use HasFactory;

    protected $table = 'tbl_types_of_leave';
    protected $primaryKey = 'leave_id';
    protected $fillable = [
        'leave',
        'number_of_days',
        'is_deleted',
    ];
}

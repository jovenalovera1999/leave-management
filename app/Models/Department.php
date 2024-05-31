<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'tbl_departments';
    protected $primaryKey = 'department_id';
    protected $fillable = [
        'department',
        'is_deleted',
    ];
}

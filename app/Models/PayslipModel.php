<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayslipModel extends Model
{
    protected $table = 'employee_salary';
    public $timestamps  = false;
}

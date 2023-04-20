<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employeeDocModel extends Model
{
    use HasFactory;

    protected $table = 'employee_documents';
    public $timestamps  = false;
}
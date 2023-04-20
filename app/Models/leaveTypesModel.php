<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaveTypesModel extends Model
{
    use HasFactory;

    protected $table = 'leaves_type';
    public $timestamps  = false;
}

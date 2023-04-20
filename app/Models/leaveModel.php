<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaveModel extends Model
{
    use HasFactory;

    protected $table = 'leaves';
    public $timestamps  = false;
}

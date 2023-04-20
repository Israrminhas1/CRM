<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roleMenuModel extends Model
{
    use HasFactory;

    protected $table = 'menus'; // table name

    public $timestamps  = false; // if there is updated_at, created_at fields in table

    protected $guarded = array(); // mass update

    //protected $fillable = ['menu_id'];

    //protected $guarded = ['id'];

    public $incrementing = false; //if there is no auto increment in the table

    public $primaryKey = null; //if there is no primary key in the table
}
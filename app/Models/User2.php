<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User2 extends Model
{
    protected $table = 'users';
    protected $guarded = array('id');
    protected $primaryKey = 'id';
    public $timestamps = false;
}
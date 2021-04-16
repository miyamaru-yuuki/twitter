<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table = 'follow';
    protected $guarded = array('followId');
    protected $primaryKey = 'followId';
    public $timestamps = false;
}
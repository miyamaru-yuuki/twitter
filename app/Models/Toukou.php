<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Toukou extends Model
{
    protected $table = 'toukou';
    protected $guarded = array('toukouid');
    protected $primaryKey = 'toukouid';
    public $timestamps = false;
}
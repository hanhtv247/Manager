<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capacity extends Model
{
    protected $table = 'capacity';
    protected $fillable = ['name','status'];
    
}

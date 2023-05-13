<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table = "tasks";
    
    protected $fillable = [
        'name',	'project_id',	'description',	'dealine','status',
    ];
}

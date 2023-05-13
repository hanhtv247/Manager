<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = "project";
    
    protected $fillable = [
        'name', 'user_id', 'cost', 'date_start', 'date_end', 'status', 'description', 'file',
    ];

}

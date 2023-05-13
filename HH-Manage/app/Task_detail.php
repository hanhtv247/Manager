<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task_detail extends Model
{
    protected $table = "task_detail";
    
    protected $fillable = [
        'user_id','task_id',
    ];
}

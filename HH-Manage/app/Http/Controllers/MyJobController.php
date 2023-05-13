<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Project;
use App\User;
use App\Tasks;
use App\Task_detail;

class MyJobController extends Controller
{
    public function showMyjob(){
        $idUserLogin = Auth::id();

        $listTask = Tasks::join('project', 'tasks.project_id', '=', 'project.id')
        ->join('task_detail', 'task_detail.task_id', '=', 'tasks.id')

        ->where('task_detail.user_id',  $idUserLogin)
        ->select('tasks.*', 'project.name as name_pro',)
        ->orderBy('id', 'desc')
        ->paginate(3);
        return view('admin.myJob.index',compact('listTask'));
    }
}

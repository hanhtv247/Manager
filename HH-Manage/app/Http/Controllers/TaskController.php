<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;
use App\Tasks;
use App\Task_detail;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $key = '';
        if ($req->input('key')) {
            $key = $req->input('key');
        }
        // $listTask = DB::table('tasks')
        // ->join('project', 'tasks.project_id', '=', 'project.id')
        // ->join('users', 'tasks.project_id', '=', 'project.id') 
        // ->select('tasks.*', 'users.name as name_em', 'project.name as name_pro')
        // ->get();

        $listTask = Tasks::join('project', 'tasks.project_id', '=', 'project.id')

            ->where('project.name', 'LIKE', "%{$key}%")
            ->select('tasks.*', 'project.name as name_pro',)
            ->orderBy('id', 'desc')
            ->paginate(3);

        return view('admin.tasks.index', compact('listTask'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = Project::all();
        $employee = User::all();

        return view('admin.tasks.add', compact('project', 'employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {

        $req->validate(
            [
                'name' => 'required|string',
                'project_id' => 'required',
                'employee_id' => 'required',
                'dealine' => 'required',
                'description' => 'required',
                'status' => 'required',

            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'name' => 'Tên công việc',
                'project_id' => 'Dự án',
                'employee_id' => 'Nhân viên tham gia',
                'dealine' => 'Hạn nộp',
                'description' => 'Mổ tả công việc',
                'status' => 'Trạng thái',
            ]
        );


        $task =  Tasks::create([
            'name' => $req->input('name'),
            'project_id' => $req->input('project_id'),
            'dealine' => $req->input('dealine'),
            'description' => $req->input('description'),
            'status' => $req->input('status'),

        ]);

        if ($req->has('employee_id')) {
            foreach ($req->employee_id as $value) {
                Task_detail::create([
                    'user_id' => $value,
                    'task_id' => $task->id,
                ]);
            }
        }

        return redirect()->route('task.index')->with('flash', 'Thêm mới công việc thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Tasks::find($id);
        $project = Project::all();
        $employee = User::all();
        return view('admin.tasks.edit', compact('task', 'project', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {

        $task = Tasks::find($id);

        $req->validate(
            [
                'name' => 'required|string',
                'project_id' => 'required',
                'employee_id' => 'required',
                'dealine' => 'required',
                'description' => 'required',
                'status' => 'required',

            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'name' => 'Tên công việc',
                'project_id' => 'Dự án',
                'employee_id' => 'Nhân viên tham gia',
                'dealine' => 'Hạn nộp',
                'description' => 'Mổ tả công việc',
                'status' => 'Trạng thái',
            ]
        );


        $task->update([
            'name' => $req->input('name'),
            'project_id' => $req->input('project_id'),
            'dealine' => $req->input('dealine'),
            'description' => $req->input('description'),
            'status' => $req->input('status'),

        ]);



        if ($req->has('employee_id')) {
            foreach ($req->employee_id as $value) {
                $color_old = Task_detail::where('user_id', $value)->get();
                foreach ($color_old as $key => $values) {
                    $values->delete($values->id);
                }
                Task_detail::create([
                    'user_id' => $value,
                    'task_id' => $task->id,
                ]);
            }
        }

        return redirect()->route('task.index')->with('flash', 'Cập nhật công việc thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task_detail::where('task_id', $id)->delete();

        Task_detail::where('task_id', $id)->delete();

        $task_delete = Tasks::find($id)->delete();

        if ($task_delete) {
            return redirect()->route('task.index')->with('flash', 'Xóa công việc thành công!');
        } 
    }
}

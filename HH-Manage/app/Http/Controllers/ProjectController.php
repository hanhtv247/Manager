<?php

namespace App\Http\Controllers;

use App\Project;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Auth\Middleware\checkRole;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
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
        $listProject = Project::join('users', 'users.id', '=', 'project.user_id')
            ->select('project.*', 'users.name as name_em')
            ->where('project.name', 'LIKE', "%{$key}%")
            ->orderBy('id', 'desc')
            ->paginate(3);

        return view('admin.project.index', compact('listProject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leader = User::all();

        return view('admin.project.add', compact('leader'));
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
                'employee_id' => 'required',
                'cost' => 'required',
                'date_start' => 'required',
                'date_end' => 'required',
                'status' => 'required',
                'description' => 'required',
                'file' => 'required',

            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'name' => 'Tên dự án',
                'employee_id' => 'Người quản lý',
                'cost' => 'Ngân sách',
                'date_start' => 'Ngày bắt đầu',
                'date_end' => 'Ngày kết thúc',
                'status' => 'Trạng thái',
                'description' => 'Mô tả dự án',
                'file' => 'File dự án',
            ]
        );

        if ($req->has('file')) {
            $file1 = $req->file;
            $file_project = $file1->getClientOriginalName();
            $file1->move(public_path('files'), $file_project);
        }

        $req->merge(['file_project' => $file_project]);

        Project::create([
            'name' => $req->input('name'),
            'user_id' => $req->input('employee_id'),
            'cost' => $req->input('cost'),
            'date_start' => $req->input('date_start'),
            'date_end' => $req->input('date_end'),
            'status' => $req->input('status'),
            'description' => $req->input('description'),
            'file' => $file_project,

        ]);

        return redirect()->route('project.index')->with('flash', 'Thêm mới dự án thành công');
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
        $employ = User::all();

        $project = Project::find($id);

        return view('admin.project.edit', compact('project', 'employ'));
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
        $req->validate(
            [
                'name' => 'required|string',
                'employee_id' => 'required',
                'cost' => 'required',
                'date_start' => 'required',
                'date_end' => 'required',
                'status' => 'required',
                'description' => 'required'

            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'name' => 'Tên dự án',
                'employee_id' => 'Người quản lý',
                'cost' => 'Ngân sách',
                'date_start' => 'Ngày bắt đầu',
                'date_end' => 'Ngày kết thúc',
                'status' => 'Trạng thái',
                'description' => 'Mô tả dự án'
            ]
        );

        $projectUpdate = Project::find($id);


        if ($req->has('file')) {

            // Xóa file cũ
            $isExists = File::exists(public_path('files/' . $projectUpdate->file));

            if ($isExists) {
                File::delete(public_path('files/' . $projectUpdate->file));
            }

            $file1 = $req->file;
            $file_project = $file1->getClientOriginalName();
            $file1->move(public_path('files'), $file_project);

            $req->merge(['file_project' => $file_project]);
        }


        $fileUpload = $file_project ?? $projectUpdate->file;

        $projectUpdate->update([
            'name' => $req->input('name'),
            'user_id' => $req->input('employee_id'),
            'cost' => $req->input('cost'),
            'date_start' => $req->input('date_start'),
            'date_end' => $req->input('date_end'),
            'status' => $req->input('status'),
            'description' => $req->input('description'),
            'file' => $fileUpload
        ]);
        
        return redirect()->route('project.index')->with('flash', 'Cập nhật dự án thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        // Xóa file cũ
        $isExists = File::exists(public_path('files/' . $project->file));

        if ($isExists) {
            File::delete(public_path('files/' . $project->file));
        }

        $project->delete();

        return redirect()->route('project.index')->with('flash', 'Xóa thành công');
    }
}

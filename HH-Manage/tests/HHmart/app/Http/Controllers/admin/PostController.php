<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CatPost;
use App\Post;

class PostController extends Controller
{
    //category
    public function list_cat()
    {

        $list_cat = CatPost::paginate(5);

        return view('admin.pages.post.list_cat', compact('list_cat'));
    }


    public function store_cat(Request $req)
    {

        $req->validate(
            [
                'name' => 'required|string|unique:cat_post',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'unique' => 'Tên đã tồn tại',
                'max' => 'Độ dài không hợp lệ',
            ],
            [
                'name' => 'Tên',
                'status' => 'Trạng thái',
            ]
        );

        CatPost::create([
            'name' => $req->input('name'),
            'status' => $req->input('status'),
        ]);
        return redirect()->route('catPost.list')->with('flash', 'Thêm thành công');
    }

    public function edit_cat($id)
    {
        $cat = CatPost::find($id);

        return view('admin.pages.post.edit', compact('cat'));
    }

    public function update_cat(Request $req, $id)
    {
        $req->validate(
            [
                'name' => 'required|string',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => 'Độ dài không hợp lệ',
            ],
            [
                'name' => 'Tên',
                'status' => 'Trạng thái',
            ]
        );

        CatPost::where('id', $id)->update([
            'name' => $req->input('name'),
            'status' => $req->input('status'),
        ]);

        return redirect()->route('catPost.list')->with('flash', 'Cập nhật thành công');
    }

    public function delete_cat($id)
    {
        CatPost::where('id', $id)
            ->delete();

        return redirect()->route('catPost.list')->with('flash', 'Xóa thành công');
    }
    //post
    public function list_post(Request $req)
    {
        $act = [
            'delete' => 'Xóa tạm thời'
        ];
        if ($req->input('status') == 'trash') {
            $act = [
                'forceDelete' => 'Xóa vĩnh viễn',
                'restore' => 'khôi phục'
            ];
            $posts = Post::join('cat_post', 'cat_post.id', '=', 'post.cat_id')
                ->select('post.*', 'cat_post.name')
                ->onlyTrashed()
                ->paginate(6);
        } else {
            $key = '';
            if ($req->input('key')) {
                $key = $req->input('key');
            }

            $posts = Post::join('cat_post', 'cat_post.id', '=', 'post.cat_id')
                ->select('post.*', 'cat_post.name')
                ->where('title', 'LIKE', "%{$key}%")->paginate(6);
        }

        $count_active = Post::count();
        $count_trash = Post::onlyTrashed()->count();
        return view('admin.pages.post.list', compact('posts', 'count_active', 'count_trash', 'act'));
    }

    public function add_post()
    {
        $cat = CatPost::all();
        return view('admin.pages.post.addPost', compact('cat'));
    }

    public function store_post(Request $req)
    {

        $req->validate(
            [
                'title' => 'required|string',
                'content' => 'required',
                'image' => 'required',
                'cat_id' => 'required',
                'status' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'title' => 'Tiêu đề',
                'status' => 'Trạng thái',
                'content' => 'Nội dung',
                'image' => 'Ảnh',
                'cat_id' => 'Danh mục',
            ]
        );

        if ($req->has('image')) {
            $file = $req->image;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('upload'), $file_name);
        }

        $req->merge(['file_name' => $file_name]);


        Post::create([
            'title' => $req->input('title'),
            'image' => $file_name,
            'content' => $req->input('content'),
            'cat_id' => $req->input('cat_id'),
            'status' => $req->input('status'),
        ]);

        return redirect()->route('post.list')->with('flash', 'Thêm mới thành công');
    }

    public function edit_post($id)
    {

        $post = Post::find($id);
        $cat = CatPost::all();

        return view('admin.pages.post.editpost', compact('post', 'cat'));
    }

    public function update_post(Request $req, $id)
    {
        $req->validate(
            [
                'title' => 'required|string',
                'content' => 'required',
                'image' => 'required',
                'cat_id' => 'required',
                'status' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'title' => 'Tiêu đề',
                'status' => 'Trạng thái',
                'content' => 'Nội dung',
                'image' => 'Ảnh',
                'cat_id' => 'Danh mục',
            ]
        );

        if ($req->has('image')) {
            $file = $req->image;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('upload'), $file_name);
        }

        $req->merge(['file_name' => $file_name]);

        Post::where('id', $id)
            ->update([
                'title' => $req->input('title'),
                'image' => $file_name,
                'content' => $req->input('content'),
                'cat_id' => $req->input('cat_id'),
                'status' => $req->input('status'),
            ]);

        return redirect()->route('post.list')->with('flash', 'Cập nhật thành công');
    }

    public function action(Request $req)
    {
        $list_check = $req->input('list_check');


        if (!empty($list_check)) {
            $act = $req->input('act');
            if ($act == 'delete') {
                Post::destroy($list_check);
                return redirect()->route('post.list')->with('flash', 'Xóa thành công');
            }

            if ($act == 'restore') {
                Post::withTrashed()
                    ->whereIn('id', $list_check)
                    ->restore();
                return redirect()->route('post.list')->with('flash', 'Khôi phục thành công');
            }

            if ($act == 'forceDelete') {
                Post::withTrashed()
                    ->whereIn('id', $list_check)
                    ->forceDelete();
                return redirect()->route('post.list')->with('flash', 'Xóa vĩnh viễn thành công');
            }
        } else {
            return redirect()->route('post.list')->with('flash', 'Bạn cần chọn mục thể thực hiện hành động');
        }
    }
    public function delete_post($id)
    {
        $user = Post::find($id);
        $user->delete();

        return redirect()->route('post.list')->with('flash', 'Xóa thành công');
    }
}

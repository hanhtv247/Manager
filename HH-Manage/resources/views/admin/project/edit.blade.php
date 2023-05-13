@extends('admin.master')
@section('title', 'Edit Project')
@section('main')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        @if (session('flash'))
                <div class="alert alert-success" role="alert">
                    {{ session('flash') }}
                </div>
            @endif
        <div class="row">   
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Chỉnh sửa dự án</strong>
                    </div>
                    <div class="card-body card-block">
                        <form method="POST" action="{{ route('project.update', $project->id) }}" enctype="multipart/form-data"
                            class="form-horizontal">
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Tên dự án</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" value="{{ $project->name }}" name="name"
                                        placeholder="Nhập tên dự án" class="form-control">
                                        @error('name')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="select" class=" form-control-label">Chọn người quản lý</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="employee_id" id="select" class="form-control">
                                        @foreach($employ as $item)
                                            <option value="{{ $item->id }}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="email-input" class=" form-control-label">Ngân sách</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" id="text-input" value="{{ $project->cost }}" name="cost" placeholder="Nhập ngân sách"
                                        class="form-control">

                                        @error('cost')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input"  class=" form-control-label">Ngày bắt đầu</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="date" id="text-input" value="{{ $project->date_start }}" name="date_start" class="form-control">
                                    @error('date_start')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input"  class=" form-control-label">Ngày kết thúc</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="date" id="text-input" value="{{ $project->date_end }}" name="date_end" class="form-control">
                                    @error('date_end')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="select" class=" form-control-label">Trạng thái dự án</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="status" id="select" class="form-control">
                                        @if($project->status == 0)
                                            <option value="0">Chưa hoàn thành</option>
                                            <option value="1">Hoàn thành</option>
                                        @else
                                            <option value="1">Hoàn thành</option>
                                            <option value="0">Chưa hoàn thành</option>
                                        @endif
                                    </select>
                                    @error('status')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="textarea-input" class=" form-control-label">Mô tả dự án</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <textarea name="description"  rows="9" value="" class="form-control">{{ $project->description }}</textarea>
                                </div>
                                        @error('description')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="file-input" class=" form-control-label">File dự án</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="file" id="file-input" value="{{ $project->file }}" name="file" class="form-control-file">
                                    <a href="{{ asset('files') }}\{{ $project->file }}">{{ $project->file }}</a>
                                    @error('file')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" value="update" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Cập nhật
                                </button>
                                
                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                    <p>Copyright © 2022 Colorlib. All rights reserved. Template by <a
                        href="https://www.facebook.com/tranthe.hanh.1">Tran Van Hanh</a>.</p>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
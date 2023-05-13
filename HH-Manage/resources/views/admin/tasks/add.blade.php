@extends('admin.master')
@section('title', 'Add Task')

@section('main')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Thêm mới công việc</strong>
                        </div>
                        <div class="card-body card-block">
                            <form method="POST" action="{{ route('task.store') }}" enctype="multipart/form-data"
                                class="form-horizontal">
                                @csrf
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Tên công việc</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="name"
                                            placeholder="Nhập tên công việc" class="form-control">
                                        @error('name')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="select" class=" form-control-label">Thuộc dự án</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="project_id" id="select" class="form-control">
                                            <option>Mời chọn</option>
                                            @foreach ($project as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach

                                        </select>
                                        @error('project_id')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="select" class=" form-control-label">Nhân viên tham gia</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select id="employee" name="employee_id[]" multiple>
                                            @foreach ($employee as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                            ...
                                        </select>
                                        @error('employee_id')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>



                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Hạn nộp</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="date" id="text-input" name="dealine" class="form-control">
                                        @error('dealine')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="textarea-input" class=" form-control-label">Mô tả công việc</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea name="description" rows="9" placeholder="Nhập mô tả...." class="form-control"></textarea>
                                    </div>
                                    @error('description')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="select" class=" form-control-label">Trạng thái</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="status" id="select" class="form-control">
                                            <option>Chọn trạng thái công việc</option>
                                            <option value="0">Chưa hoàn thành</option>
                                            <option value="1">Hoàn thành</option>
                                        </select>
                                        @error('status')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" value="add" class="btn btn-primary btn-sm">
                                        <i class="fa fa-dot-circle-o"></i> Thêm
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">
                                        <i class="fa fa-ban"></i> Làm mới
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

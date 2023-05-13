@extends('admin.master')
@section('title', 'Add Employee')

@section('main')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Thêm mới nhân viên</strong>
                        </div>
                        <div class="card-body card-block">
                            <form method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data"
                                class="form-horizontal">
                                @csrf
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Tên nhân viên</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="name"
                                            placeholder="Nhập tên nhân viên" class="form-control">
                                            @error('name')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="email-input" class=" form-control-label">Email nhân viên</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="email" id="email-input" name="email" placeholder="Nhập email"
                                            class="form-control">

                                            @error('email')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="password-input" class=" form-control-label">Mật khẩu</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="password" id="password-input" name="password" placeholder="Password"
                                            class="form-control">

                                            @error('password')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="file-input" class=" form-control-label">Ảnh đại diện</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file" id="file-input" name="avartar" class="form-control-file">
                                        @error('avartar')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label class=" form-control-label">Giới tính</label>
                                    </div>
                                    <div class="col col-md-9">
                                        <div class="form-check">
                                            <div class="radio">
                                                <label for="radio1" class="form-check-label ">
                                                    <input type="radio" id="radio1" name="sex" value="0"
                                                        class="form-check-input">Nam
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label for="radio1" class="form-check-label ">
                                                    <input type="radio" id="radio1" name="sex" value="1"
                                                        class="form-check-input">Nữ
                                                </label>
                                            </div>
                                        </div>
                                        @error('sex')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Ngày sinh</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="date" id="text-input" name="birthday" class="form-control">
                                        @error('birthday')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Địa chỉ</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="address"
                                            placeholder="Nhập địa chỉ nhân viên" class="form-control">
                                            @error('address')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Lương nhân viên</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="number" id="text-input" name="salary"
                                            placeholder="Nhập lương nhân viên" class="form-control">
                                            @error('salary')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Vị trí làm việc</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="position"
                                            placeholder="Nhập vị trí làm việc nhân viên" class="form-control">
                                            @error('position')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Ngày vào công ty</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="date" id="text-input" name="dateJoinCompany"
                                            class="form-control">
                                            @error('dateJoinCompany')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="select" class=" form-control-label">Quyền truy cập</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="role" id="select" class="form-control">
                                            <option>Mời chọn</option>
                                            <option value="0">Quản trị viên</option>
                                            <option value="1">Nhân viên</option>
                                        </select>
                                        @error('role')
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

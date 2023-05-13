@extends('admin.master')
@section('title', 'listProject')
@section('main')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            @if (session('flash'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Thông báo</span>
            {{ session('flash') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if (session('warning'))
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
            <span class="badge badge-pill badge-danger">Cảnh báo</span>
            {{ session('warning') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
            <div class="row">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <h3 class="title-5 m-b-35">Danh sách dự án</h3>
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <form class="form-header" action="#">
                                <input class="au-input au-input--xl" type="text" name="key"
                                    value="{{ request()->input('key') }}" placeholder="Tìm kiếm dự án" />
                                <button class="au-btn--submit" type="submit" value="Tìm kiếm">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>


                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('project.add') }}" class="au-btn au-btn-icon au-btn--green au-btn--small text-decoration-none">
                                <i class="zmdi zmdi-plus"></i>Thêm dự án</a>

                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Tên dự án</th>
                                    <th>Người quản lý dự án</th>
                                    <th>Ngân sách</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Trạng thái</th>
                                    <th>Mô tả dự án</th>
                                    <th>File dự án</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listProject as $item)
                                    <tr class="tr-shadow">
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->name_em }}</td>
                                        <td>{{ number_format($item->cost) }}đ</td>
                                        <td>{{ date('d-m-Y', strtotime($item->date_start))    }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->date_end)) }}</td>
                                        @if($item->status == 0)
                                            <td><span class="badge badge-danger">Chưa hoàn thành</span></td>
                                        @else
                                            <td><span class="badge badge-success">Hoàn thành</span></td>
                                        @endif
                                        <td>{!!Str::limit($item->description, 10, '(...)')!!}</td>
                                        <td><a href="{{ asset('files') }}\{{ $item->file }}">{{ $item->file }}</a></td>
                                        <td>
                                            <div class="table-data-feature">

                                                <a href="{{ route('project.edit', $item->id) }}" class="item" data-toggle="tooltip"
                                                    data-placement="top" title="Chi tiết">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <a class="item" href="{{ route('project.delete',$item->id)}}" onclick="return confirm('Bạn có chắc muốn xóa dự án này')" data-toggle="tooltip" data-placement="top" title="Xóa">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
            {{ $listProject->links() }}
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

@extends('admin.master')
@section('title', 'Employee')

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
                <h3 class="title-5 m-b-35">Danh sách nhân viên</h3>
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <form class="form-header" action="#">
                            <input class="au-input au-input--xl" type="text" name="key" value="{{ request()->input('key') }}" placeholder="Tìm kiếm nhân viên" />
                            <button class="au-btn--submit" type="submit" value="Tìm kiếm">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                        
                        
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('employee.add') }}" class="au-btn au-btn-icon au-btn--green au-btn--small text-decoration-none">
                            <i class="zmdi zmdi-plus"></i>Thêm nhân viên</a>
                        
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                               
                                <th>Tên</th> 
                                <th>Ảnh đại diện</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Địa chỉ</th>
                                <th>Mức lương</th>
                                <th>Vị trí</th>
                                <th>Ngày vào cty</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $k = 0; ?>
                            @foreach ($user as $item)
                            <tr class="tr-shadow">     
                                <td>{{ $item->name }}</td>
                                <td class="desc"><img src="{{asset('uploads')}}\{{ $item->avartar }}" width="70px" alt=""></td>
                                @if($item->sex == 0)
                                <td>Nam</td>
                                @else
                                <td>Nữ</td>
                                @endif
                                <td>{{ date('d-m-Y', strtotime($item->birthday))  }}</td>
                                <td>{{ $item->address}}</td>
                                <td>{{ number_format($item->salary)  }}đ</td>
                                <td>{{ $item->position }}</td>
                                <td>{{ date('d-m-Y', strtotime( $item->dateJoinCompany)) }}</td>
                                <td>
                                    <div class="table-data-feature">
                                       
                                        <a href="{{ route('employee.edit',$item->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Chi tiết">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        @if (Auth::id() != $item->id)
                                        <a class="item" href="{{ route('employee.delete',$item->id)}}" onclick="return confirm('Bạn có chắc muốn xóa người dùng này')" data-toggle="tooltip" data-placement="top" title="Xóa">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>
                                        @endif
                                        
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
        {{ $user->links() }}
        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                    <p>Copyright © 2022 Colorlib. All rights reserved. Template by <a href="https://www.facebook.com/tranthe.hanh.1">Tran Van Hanh</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
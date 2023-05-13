@extends('admin.master')
@section('title', 'Dashboard')

@section('main')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Trang chủ</h2>
                        
                    </div>
                </div>
            </div>
            <div class="row m-t-25">
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                                <div class="text">
                                    <h2>{{ $users }}</h2>
                                    <span>Thành viên</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart1"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c2">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="fa fa-file" aria-hidden="true"></i>
                                </div>
                                <div class="text">
                                    <h2>{{ $projects }}</h2>
                                    <span>Dự án</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c3">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                </div>
                                <div class="text">
                                    <h2>{{ $total_job }}</h2>
                                    <span>Tổng số công việc</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart3"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c4">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-money"></i>
                                </div>
                                <div class="text">
                                    <h2>{{ number_format($total_price ) }}đ </h2>
                                    <span>Tổng ngân sách</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart4"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
  
  
                  <div class="card">
                    <div class="card-header">
                      <strong class="card-title">Giới thiệu</strong>
                    </div>
  
                    <div class="card-body">
                      <div class="typo-articles">
                        <p>
                          Quy trình quản lý dự án phần mềm là quy trình vận dụng những kiến thức, kỹ năng và kỹ thuật công nghệ vào hoạt động của dự án để đạt được mục tiêu của dự án đặt ra. Những ứng dụng này được đưa vào phần mềm theo một tiêu chuẩn hóa của quản lý dự án theo tiêu chuẩn PMI.
                        </p>
                        <p>
                          <p>Để đảm bảo dự án thành công, các thành viên dự án phải đảm bảo:</p>
                          <div class="card-body">
                            <p> •	Lựa chọn quy trình phù hợp để đạt được mục tiêu của dự án.</p>
                            <p> •	Tuân theo các yêu cầu để đáp ứng được nhu cầu và mong đợi của các bên liên quan.</p>
                            <p> •	Cân bằng được các yêu cầu (nhân tố) cạnh tranh trong dự án như: phạm vi công việc, ngân sách, tiến độ, chất lượng, rủi ro, thay đổi. Tùy theo quy mô của từng dự án mà các mỗi giai đoạn lại có thể gồm những quy trình nhỏ hơn.</p>
                          </div>
                          <p>  Ngoài các lợi ích chiến lược nêu trên phần mềm còn cung cấp đầy đủ các tính năng hệ thống. Việc bảo mật được tiến hành một cách tuyệt đối nghiêm ngặt. Việc phân quyền được cụ thể đến từng vai trò của người sử dụng. </p>

                        </p>  
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

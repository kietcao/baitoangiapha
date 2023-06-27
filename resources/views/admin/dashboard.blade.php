@extends('admin.main')
@section('content')
    <div class="content-wrapper">
        @include('global.content_head', [
            'title' => 'Dashboard',
        ])
        <section class="content">
            <div class="container-fluid">
                <label>Hệ thống</label>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-microchip"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">CPU Traffic</span>
                                <span class="info-box-number">
                                    <span>{{$cpu}}</span>
                                    ({{ $cpuUsed }}
                                    <small>%</small>)
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-hdd"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Bộ nhớ</span>
                                <span class="info-box-number">{{ number_format($totalDisk) }} GB</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="far fa-hdd"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Bộ nhớ trống</span>
                                <span class="info-box-number">{{ number_format($freeDisk) }} GB</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="far fa-hdd"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Chiếm dụng</span>
                                <span class="info-box-number">{{ number_format($usedDisk) }} GB</span>
                            </div>
                        </div>
                    </div>
                </div>
                <label>Ứng dụng</label>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-7">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">User mới</h3>
                                <div class="card-tools">
                                    <span class="badge badge-danger">8 người mới</span>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="users-list clearfix">
                                    @foreach ($newUsers as $user)
                                    <li>
                                        <img
                                            @if (!empty($user->avatar))
                                                src="{{$user->avatar}}"
                                            @else
                                                src="img/fixed/default_avatar_1.png"
                                            @endif
                                            alt="{{$user->id}}"
                                        >
                                        <a class="users-list-name" href="#">Alexander Pierce</a>
                                        <span class="users-list-date">{{$user->created_at->diffForHumans()}}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{route('users')}}">Xem toàn bộ</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-5">
                        <div class="info-box mb-3 bg-warning">
                            <span class="info-box-icon"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tổng thành viên cây</span>
                                <span class="info-box-number">{{number_format($totalFamilyMembers)}}</span>
                            </div>
                        </div>
                        <div class="info-box mb-3 bg-success">
                            <span class="info-box-icon"><i class="fas fa-male"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tổng thành viên nam</span>
                                <span class="info-box-number">{{number_format($totalMaleFamilyMembers)}}</span>
                            </div>
                        </div>
                        <div class="info-box mb-3 bg-info">
                            <span class="info-box-icon"><i class="fas fa-female"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tổng thành viên nữ</span>
                                <span class="info-box-number">{{number_format($totalFemaleFamilyMembers)}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Sự kiện sắp diễn ra</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>Thứ tự</th>
                                                <th>Tiêu đề</th>
                                                <th>Ngày diễn ra</th>
                                                <th>Số thành viên</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#1</td>
                                                <td>Đám cưới</td>
                                                <td>12-02-2022</td>
                                                <td><span class="badge badge-success">5 người</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@extends('admin.main')
@section('content')
<div class="content-wrapper">
    @include('global.content_head', [
        'title' => 'Trang của tôi'
    ])
    <style>
        .wrap-avatar {
            width: 120px;
            height: 120px;
            border-radius: 999px;
            overflow: hidden;
            background-color: white;
            margin: auto;
            border: 5px solid #dddddd;
            position: relative;
        }

        .wrap-avatar img {
            width: 100%;
            height: 100%;
            position: absolute;
            z-index: 1;
        }

        .wrap-avatar input {
            width: 100%;
            height: 100%;
            position: absolute;
            z-index: 2;
            opacity: 0;
        }

        .wrap-avatar * {
            cursor: pointer;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header"><b>Thông tin</b></div>
                <div class="card-body">
                    <form action="{{route('mypage.update_info')}}" method="post" enctype="multipart/form-data" class="row">
                        @csrf
                        <div class="form-group col-12">
                            <div class="wrap-avatar">
                                <img src="{{$user->avatar ?? "img/fixed/default_avatar.png"}}">
                                <input id="avatar" type="file" name="avatar" accept="image/*">
                            </div>
                            <div class="text-center pt-2 pb-3">
                                <label for="avatar">Ảnh đại diện</label>
                            </div>
                            @error('avatar')
                                <div class="text-center"><div style="font-size: 13px; padding-top: 2px;"><i class="text-danger">{{$message}}</i></div></div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Họ tên</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{old('name', $user->name)}}">
                            @error('name')
                                <div style="font-size: 13px; padding-top: 2px;"><i class="text-danger">{{$message}}</i></div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" id="address" value="{{old('address', $user->address)}}">
                            @error('address')
                                <div style="font-size: 13px; padding-top: 2px;"><i class="text-danger">{{$message}}</i></div>
                            @enderror
                        </div>
                        <div class="col-12 text-right">
                            <button class="btn btn-success">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header"><b>Đổi mật khẩu</b></div>
                <div class="card-body">
                    <form class="row" action="{{route('mypage.update_password')}}" method="post">
                        @csrf
                        <div class="form-group col-md-12">
                            <label for="old_password">Mật khẩu cũ <span class="text-danger">(*)</span></label>
                            <input type="password" class="form-control" name="old_password" id="old_password">
                            @error('old_password')
                                <div style="font-size: 13px; padding-top: 2px;"><i class="text-danger">{{$message}}</i></div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="password">Mật khẩu mới <span class="text-danger">(*)</span></label>
                            <input type="password" class="form-control" name="password" id="password">
                            @error('password')
                                <div style="font-size: 13px; padding-top: 2px;"><i class="text-danger">{{$message}}</i></div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="re_password">Nhắc lại mật khẩu mới <span class="text-danger">(*)</span></label>
                            <input type="password" class="form-control" name="re_password" id="re_password">
                            @error('re_password')
                                <div style="font-size: 13px; padding-top: 2px;"><i class="text-danger">{{$message}}</i></div>
                            @enderror
                        </div>
                        @if(session()->has('message'))
                            <div class="alert alert-info w-100" role="alert">{{session('message')}}</div>
                        @endif
                        <div class="col-12 text-right">
                            <button class="btn btn-success">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        $('.wrap-avatar').find('input').change(function(){
            var file = event.target.files[0];
            var reader = new FileReader();
            let _this = $(this);

            reader.onload = function(e) {
                _this.closest('.form-group').find('img').attr('src', e.target.result);
            };

            reader.readAsDataURL(file);
        });
    </script>
</div>
@endsection
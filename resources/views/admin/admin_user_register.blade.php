@extends('admin.main')
@section('content')
<div class="content-wrapper">
    @include('global.content_head', [
        'title' => 'Admin đăng ký user'
    ])
    <style>
        .wrap-cccd {
            width: 200px;
            height: auto;
        }

        .wrap-cccd img {
            width: 100%;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin_user_register')}}" method="post" enctype="multipart/form-data" class="row">
                        @csrf
                        <div class="col-lg-4 form-group">
                            <label for="user_type">Loại user</label>
                            <select id="user_type" class="form-control" name="user_type">
                                <option
                                    value="{{App\Constants\UserType::ADMIN}}"
                                    @if (old('user_type') == null || old('user_type') == App\Constants\UserType::ADMIN)
                                    selected
                                    @endif
                                >Admin</option>
                                <option
                                    value="{{App\Constants\UserType::USER}}"
                                    @if (old('user_type') == App\Constants\UserType::USER)
                                    selected
                                    @endif
                                >User</option>
                            </select>
                        </div>
                        <div class="col-lg-4 form-group">
                            <label for="name">Họ tên</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                            @error('name')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="col-lg-4 form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" value="{{old('email')}}">
                            @error('email')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="col-lg-4 form-group">
                            <label for="address">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" id="address" value="{{old('address')}}">
                            @error('address')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="col-lg-4 form-group">
                            <label for="avatar">Ảnh đại diện</label>
                            <input type="file" class="form-control" name="avatar" id="avatar">
                            @error('avatar')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="col-lg-4 form-group">
                            <label for="cccd_number">Mã căn cước</label>
                            <input type="text" class="form-control" name="cccd_number" id="cccd_number" value="{{old('cccd_number')}}">
                            @error('cccd_number')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="col-lg-12 form-group">
                            <label for="cccd_image_before">Mặt trước CCCD:</label>
                            <div class="wrap-cccd">
                                <img
                                    src="img/fixed/before_cccd_default.jpg"
                                    alt="before"
                                >
                                <input type="file" class="form-control" name="cccd_image_before" id="cccd_image_before">
                            </div>
                            @error('cccd_image_before')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="col-lg-12 form-group">
                            <label for="cccd_image_after">Mặt sau CCCD:</label>
                            <div class="wrap-cccd">
                                <img
                                    src="img/fixed/after_cccd_default.jpg"
                                    alt="after"
                                >
                                <input type="file" class="form-control" name="cccd_image_after" id="cccd_image_after">
                            </div>
                            @error('cccd_image_after')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="col-12 text-center pt-3">
                            <button class="btn btn-info btn-lg">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        $('.wrap-cccd').find('input').change(function(){
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
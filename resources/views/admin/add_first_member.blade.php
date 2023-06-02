@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <style>
        .gender-item-radio {
            cursor: pointer;
        }

        #male_gender, #female_gender {
            width: 17px;
            height: 17px;
        }

        .wrap-input-avatar {
            position: relative;
            width: 150px;
            height: 150px;
            overflow: hidden;
        }

        .wrap-input-avatar input,
        .wrap-input-avatar img {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .wrap-input-avatar img {
            object-fit: cover;
        }

        .wrap-input-avatar input {
            z-index: 2;
            opacity: 0;
        }
    </style>
    @include('global.content_head', [
        'title' => 'Thêm thành viên đầu tiên'
    ])
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('add_first_member')}}" method="post" enctype="multipart/form-data" class="row">
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="fullname">Họ tên</label>
                            <input class="form-control" type="text" name="fullname" id="fullname" value="{{old('fullname')}}">
                            @error('fullname')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="role_name">Tên vai trò</label>
                            <input class="form-control" type="text" name="role_name" id="role_name" value="{{old('role_name')}}">
                            @error('role_name')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="avatar">Ảnh đại diện</label>
                            <div class="wrap-input-avatar">
                                <input class="form-control" type="file" name="avatar" id="avatar" accept="image/*">
                                <img
                                    src="{{old('avatar', "img/fixed/default_avatar.png" )}}"
                                    alt=""
                                >
                            </div>
                            @error('avatar')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="birthday">Ngày sinh</label>
                                    <input class="form-control" type="text" name="birthday" id="birthday" value="{{old('birthday')}}">
                                    @error('birthday')
                                        <i class="text-danger">{{$message}}</i>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="leaveday">Ngày mất</label>
                                    <input class="form-control" type="text" name="leaveday" id="leaveday" value="{{old('leaveday')}}">
                                    @error('leaveday')
                                        <i class="text-danger">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address">Địa chỉ</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{old('address')}}">
                            @error('address')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Số điện thoại</label>
                            <input class="form-control" type="text" name="phone" id="phone" value="{{old('phone')}}">
                            @error('phone')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input class="form-control" type="text" name="email" id="email" value="{{old('email')}}">
                            @error('email')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group col-md-2 gender">
                            <label for="">Giới tính</label>
                            <div class="d-flex align-items-center pt-2">
                                <div class="d-flex align-items-center pr-4">
                                    <label class="m-0 pr-2" for="male_gender">Nam</label>
                                    <input
                                        id="male_gender"
                                        name="gender"
                                        type="radio"
                                        value="{{\App\Constants\Gender::MALE}}"
                                        @if (old('gender') == null || old('gender') != null && old('gender') == \App\Constants\Gender::MALE)
                                        checked
                                        @endif
                                    >
                                </div>
                                <div class="d-flex align-items-center">
                                    <label class="m-0 pr-2" for="female_gender">Nữ</label>
                                    <input
                                        id="female_gender"
                                        name="gender"
                                        type="radio"
                                        value="{{\App\Constants\Gender::FEMALE}}"
                                        @if (old('gender') != null && old('gender') == \App\Constants\Gender::FEMALE)
                                        checked
                                        @endif
                                    >
                                </div>
                            </div>
                            @error('gender')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="story">Tiểu sử</label>
                            <textarea name="story" id="story">{{old('story')}}</textarea>
                            @error('story')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-success btn-lg">Thêm thành viên</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        let editor = CKEDITOR.replace('story', {
            height: 400
        });
        $( "[name=birthday]" ).datepicker({
            dayNamesMin: [ "T2", "T3", "T4", "T5", "T6", "T7", "CN" ],
            monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            dateFormat: "yy-mm-dd",
        });
        $( "[name=leaveday]" ).datepicker({
            dayNamesMin: [ "T2", "T3", "T4", "T5", "T6", "T7", "CN" ],
            monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            dateFormat: "yy-mm-dd",
        });

        $('.wrap-input-avatar input').change(function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.wrap-input-avatar img').attr('src', e.target.result);
            };

            reader.readAsDataURL(file);
        });
    </script>
</div>
@endsection
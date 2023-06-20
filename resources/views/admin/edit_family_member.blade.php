@extends('admin.main')
@section('content')
<div class="content-wrapper">
    @include('global.content_head', [
        'title' => 'Sửa thông tin của ' . $member->fullname
    ])
    <section class="content">
        <style>
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
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('update_family_member')}}" method="post" enctype="multipart/form-data" class="row">
                        @csrf
                        <input type="hidden" name="id" value="{{$member->id}}">
                        <div class="form-group col-md-6">
                            <label for="fullname">Họ tên</label>
                            <input class="form-control" type="text" name="fullname" id="fullname" value="{{old('fullname', $member->fullname)}}">
                            @error('fullname')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="role_name">Tên vai trò</label>
                            <input class="form-control" type="text" name="role_name" id="role_name" value="{{old('role_name', $member->role_name)}}">
                            @error('role_name')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="avatar">Ảnh đại diện</label>
                            <div class="wrap-input-avatar">
                                <input class="form-control" type="file" name="avatar" id="avatar" accept="image/*">
                                <img
                                    src="{{old('avatar', $member->avatar)}}"
                                    alt=""
                                >
                            </div>
                            @error('avatar')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="birthday">Ngày sinh</label>
                            <input class="form-control" type="text" name="birthday" id="birthday" value="{{old('birthday', $member->birthday)}}">
                            @error('birthday')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="leaveday">Ngày mất</label>
                            <input class="form-control" type="text" name="leaveday" id="leaveday" value="{{old('leaveday', $member->leaveday)}}">
                            @error('leaveday')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address">Địa chỉ</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{old('address', $member->address)}}">
                            @error('address')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Số điện thoại</label>
                            <input class="form-control" type="text" name="phone" id="phone" value="{{old('phone', $member->phone)}}">
                            @error('phone')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="cccd_number">Mã căn cước <span>(*)</span></label>
                            <input type="text" class="form-control" name="cccd_number" id="cccd_number" value="{{old('cccd_number', $member->cccd_number)}}">
                            @error('cccd_number')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="cccd_image_before">Mặt trước CCCD <span>(*)</span></label>
                            <div class="wrap-cccd">
                                <img
                                    @if (!empty($member->cccd_image_before))
                                    src={{route('get_cccd', $member->cccd_image_before)}}
                                    @else
                                    src="img/fixed/before_cccd_default.jpg"
                                    @endif
                                    alt="before"
                                    class="w-100"
                                >
                                <input type="file" class="form-control" name="cccd_image_before" id="cccd_image_before">
                            </div>
                            @error('cccd_image_before')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="cccd_image_after">Mặt sau CCCD <span>(*)</span></label>
                            <div class="wrap-cccd">
                                <img
                                    @if (!empty($member->cccd_image_after))
                                    src={{route('get_cccd', $member->cccd_image_after)}}
                                    @else
                                    src="img/fixed/after_cccd_default.jpg"
                                    @endif
                                    alt="before"
                                    class="w-100"
                                >
                                <input type="file" class="form-control" name="cccd_image_after" id="cccd_image_after">
                            </div>
                            @error('cccd_image_after')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="email">Email</label>
                            <input class="form-control" type="text" name="email" id="email" value="{{old('email', $member->email)}}">
                            @error('email')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        @if ( !empty($member->position_index) )
                        <div class="form-group col-md-12 position_index">
                            <label for="position_index">Thứ tự</label>
                            <input id="position_index" class="form-control" type="text" name="position_index" id="position_index" value="{{old('position_index', $member->position_index)}}">
                            @error('position_index')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        @endif
                        <div class="form-group col-md-12">
                            <label for="story">Tiểu sử</label>
                            <textarea name="story" id="story">{{old('story', $member->story)}}</textarea>
                            @error('story')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-success btn-lg">Cập nhật thông tin</button>
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
@extends('admin.main')
@section('content')
    <style>
        .wrap-avatar {
            width: 50px;
            height: 50px;
            overflow: hidden;
            border-radius: 9999px;
        }

        .wrap-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #users-table td{
            vertical-align: middle;
        }

        @media screen and (max-width: 1025px) {
            .col-avatar,
            .col-email {
                display: none;
            }
        }

        @media screen and (max-width: 628px) {
            #users-table_wrapper button,
            #users-table_wrapper a,
            #users-table_wrapper div
            {
                font-size: 13.5px!important;
                text-align: center;
            }

            .btn-sm {
                padding: 2px!important;
            }
        }
    </style>
    <div class="content-wrapper">
        @include('global.content_head', [
            'title' => 'Quản lý users',
        ])
        <section class="content">
            <div class="container-fluid pb-3">
                <a href="{{route('admin_user_register_view')}}" class="btn btn-info">Đăng ký user</a>
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <table class="table data-table" id="users-table">
                            <thead class="bg-info">
                                <tr>
                                    <th class="col-avatar">Avatar</th>
                                    <th>Họ tên</th>
                                    <th class="col-email">Email</th>
                                    <th>Loại User</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr
                                    @if ($user->enable_status == App\Constants\EnableStatus::DISABLE)
                                    class="bg-warning"
                                    @endif
                                >
                                    <td class="col-avatar">
                                        <div class="wrap-avatar">
                                            <img
                                                @if (!empty($user->avatar))
                                                    src="{{$user->avatar}}"
                                                @else
                                                    src="img/fixed/default_avatar_1.png"
                                                @endif
                                                alt="{{$user->id}}"
                                            >
                                        </div>
                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td class="col-email">{{$user->email}}</td>
                                    <td>
                                        @if ($user->user_type == App\Constants\UserType::ADMIN)
                                        Admin
                                        @else
                                        Thành viên
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->enable_status != App\Constants\EnableStatus::UNACTIVE)
                                        <select data-id="{{$user->id}}" class="form-control enable-user" style="width: 130px;">
                                            <option
                                                value="{{App\Constants\EnableStatus::DISABLE}}"
                                                @if ($user->enable_status == App\Constants\EnableStatus::DISABLE)
                                                selected
                                                @endif
                                            >Vô hiệu hóa</option>
                                            <option
                                                value="{{App\Constants\EnableStatus::ENABLE}}"
                                                @if ($user->enable_status == App\Constants\EnableStatus::ENABLE)
                                                selected
                                                @endif
                                            >Bình thường</option>
                                        </select>
                                        @else
                                        <div class="btn btn-sm btn-secondary">Chờ user xác nhận</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-info">Chi tiết</a>
                                        <a href="" class="btn btn-sm btn-danger">Xóa</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        $('.data-table').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        $('.enable-user').change(function(){
            let isEnable = $(this).val();
            let id = $(this).attr('data-id');
            if (isEnable == {{App\Constants\EnableStatus::DISABLE}}) {
                $(this).closest('tr').addClass('bg-warning');
            } else {
                $(this).closest('tr').removeClass('bg-warning');
            }

            $.ajax({
                url: '{{route('update_is_enable')}}',
                method: 'post',
                dataType: 'json',
                data : {
                    _token : '{{csrf_token()}}',
                    enable_status : isEnable,
                    id : id
                },
                success: function(response) {
                    // Do nothing
                }
            });
        });


    </script>
@endsection

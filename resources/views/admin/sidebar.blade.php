<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="img/fixed/logo.png" alt="AdminLTE Logo" class="brand-image elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Gia Phả</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img
                    @if (!empty(auth()->user()->avatar))
                    src="{{auth()->user()->avatar}}"
                    @else
                    src="img/fixed/default_avatar_1.png"
                    @endif
                    class="img-circle elevation-2"
                    alt="User Image"
                >
            </div>
            <div class="info">
                <a href="{{route('mypage')}}" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link @if($current_page == App\Constants\CurrentPage::DASHBOARD){{'active'}}@endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                    {{-- <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index2.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index3.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v3</p>
                            </a>
                        </li>
                    </ul> --}}
                </li>
                <li class="nav-item">
                    <a href="{{route('genealogy')}}" class="nav-link @if($current_page == App\Constants\CurrentPage::GENEALOGY){{'active'}}@endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Gia phả
                            <span class="right badge badge-danger">{{$family_member_count}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('themes')}}" class="nav-link @if($current_page == App\Constants\CurrentPage::THEMES){{'active'}}@endif">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Cấu hình cây gia phả (demo)
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('event_list')}}" class="nav-link @if($current_page == App\Constants\CurrentPage::EVENT){{'active'}}@endif">
                        <i class="nav-icon fas fa-calendar-week"></i>
                        <p>
                            Quản lý sự kiện
                        </p>
                    </a>
                </li>
                @if (auth()->user()->user_type == App\Constants\UserType::ADMIN)
                <li class="nav-item">
                    <a href="{{route('users')}}" class="nav-link @if($current_page == App\Constants\CurrentPage::USER){{'active'}}@endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Quản lý thành viên
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-header">Tài khoản</li>
                <li class="nav-item">
                    <a href="{{route('mypage')}}" class="nav-link @if($current_page == App\Constants\CurrentPage::MYPAGE){{'active'}}@endif">
                        <i class="far fa-circle nav-icon text-info"></i>
                        <p>Tài khoản</p>
                    </a>
                </li>
                <form class="nav-item" action="{{route('logout_user')}}" method="post" id="form-logout" style="cursor: pointer;">
                    @csrf
                    <a class="nav-link" id="logout">
                        <i class="far fa-circle nav-icon text-danger"></i>
                        <p>Đăng xuất</p>
                    </a>
                    <script>
                        document.getElementById('logout').addEventListener('click', function(){
                            document.getElementById('form-logout').submit();
                        });
                    </script>
                </form>
            </ul>
        </nav>
    </div>
</aside>

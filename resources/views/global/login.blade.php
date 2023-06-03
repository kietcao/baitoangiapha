<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>


    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form class="login" action="{{route('login')}}" method="post">
                    @csrf
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="login__input" placeholder="Email" name="email" value="{{old('email')}}">
                        @error('email')
                            <div style="font-size: 13px; padding-top: 2px;"><i class="text-danger">{{$message}}</i></div>
                        @enderror
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" placeholder="Password" name="password">
                        @error('password')
                            <div style="font-size: 13px; padding-top: 2px;"><i class="text-danger">{{$message}}</i></div>
                        @enderror
                    </div>
                    @if($errors->has('message'))
                        <i class="text-danger">{{$errors->first()}}</i>
                    @endif
                    <button class="button login__submit">
                        <span class="button__text">Đăng nhập</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                </form>
                <div class="social-login">
                    <h3>Tùy chọn</h3>
                    <div class="social-icons">
                        <a href="#" class="social-login__icon d-block">Quên mật khẩu</a>
                        <a href="#" class="social-login__icon fab fa-instagram d-block">Đăng ký</a>
                    </div>
                </div>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng ký thành viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <link rel="stylesheet" href="css/auth_css_1.css">
</head>

<body>


    <div class="container register">
        <div class="row">
            <div class="col-md-3 register-left">
                <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt="" />
                <h3>Welcome</h3>
                <p>Đăng ký tham gia hệ thống quản lý gia phả</p>
                <a href="{{route('login_view')}}" class="btnLogin">Đăng nhập</a>
            </div>
            <div class="col-md-9 register-right">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Đăng ký thành viên</h3>
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Họ và tên *" value="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Email *" value="" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Địa chỉ" value="" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Mã căn cước *" value="" />
                                </div>
                            </div>
                            <div class="col-md-6 select-cccd">
                                <div class="wrap-cccd form-group">
                                    <label>Mặt trước căn cước:</label>
                                    <div class="wrap-preview">
                                        <img src="img/fixed/before_cccd_default.jpg">
                                    </div>
                                    <input type="file" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6 select-cccd">
                                <div class="wrap-cccd form-group">
                                    <label>Mặt sau căn cước:</label>
                                    <div class="wrap-preview">
                                        <img src="img/fixed/after_cccd_default.jpg">
                                    </div>
                                    <input type="file" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Mật khẩu *" value="" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nhập lại mật khẩu *" value="" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="btnRegister" value="Đăng ký" />
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
<script>
    $('.wrap-cccd').find('input').change(function(){
        var file = event.target.files[0];
        var reader = new FileReader();
        let _this = $(this);

        reader.onload = function(e) {
            _this.closest('.select-cccd').find('img').attr('src', e.target.result);
        };

        reader.readAsDataURL(file);
    });
</script>
</html>

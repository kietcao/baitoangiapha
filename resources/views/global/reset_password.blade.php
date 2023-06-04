<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đặt lại mật khẩu</title>
    <style>
        .mainDiv {
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
            background-color: #f9f9f9;
            font-family: 'Open Sans', sans-serif;
        }

        .cardStyle {
            width: 500px;
            border-color: white;
            background: #fff;
            padding: 36px 0;
            border-radius: 4px;
            margin: 30px 0;
            box-shadow: 0px 0 2px 0 rgba(0, 0, 0, 0.25);
        }

        #signupLogo {
            max-height: 100px;
            margin: auto;
            display: flex;
            flex-direction: column;
        }

        .formTitle {
            font-weight: 600;
            margin-top: 20px;
            color: #2F2D3B;
            text-align: center;
        }

        .inputLabel {
            font-size: 12px;
            color: #555;
            margin-bottom: 6px;
            margin-top: 24px;
        }

        .inputDiv {
            width: 70%;
            display: flex;
            flex-direction: column;
            margin: auto;
        }

        input {
            height: 40px;
            font-size: 16px;
            border-radius: 4px;
            border: none;
            border: solid 1px #ccc;
            padding: 0 11px;
        }

        input:disabled {
            cursor: not-allowed;
            border: solid 1px #eee;
        }

        .buttonWrapper {
            margin-top: 40px;
        }

        .submitButton {
            width: 70%;
            height: 40px;
            margin: auto;
            display: block;
            color: #fff;
            background-color: #065492;
            border-color: #065492;
            text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.12);
            box-shadow: 0 2px 0 rgba(0, 0, 0, 0.035);
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
        }

        .submitButton:disabled,
        button[disabled] {
            border: 1px solid #cccccc;
            background-color: #cccccc;
            color: #666666;
        }

        #loader {
            position: absolute;
            z-index: 1;
            margin: -2px 0 0 10px;
            border: 4px solid #f3f3f3;
            border-radius: 50%;
            border-top: 4px solid #666666;
            width: 14px;
            height: 14px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        .text-danger {
            font-size: 13px;
            padding-top: 5px;
            color: red;
        }
    </style>
</head>

<body>
    <div class="mainDiv">
        <div class="cardStyle">
            <form action="{{route('reset_password')}}" method="post" name="signupForm" id="signupForm">
                @csrf
                <input type="hidden" name="token_reset" value="{{$token_reset}}">
                <img src="https://lajos.nl/wp-content/uploads/2023/04/laravel.png" id="signupLogo" />

                <h2 class="formTitle">
                    Đặt lại mật khẩu của bạn
                </h2>

                <div class="inputDiv">
                    <label class="inputLabel" for="password">Mật khẩu mới</label>
                    <input type="password" id="password" name="password">
                    @error('password')
                        <i class="text-danger">{{$message}}</i>
                    @enderror
                </div>

                <div class="inputDiv">
                    <label class="inputLabel" for="re_password">Nhập lại mật khẩu</label>
                    <input type="password" id="re_password" name="re_password">
                    @error('re_password')
                        <i class="text-danger">{{$message}}</i>
                    @enderror
                </div>

                <div class="buttonWrapper">
                    <button class="submitButton">Xác nhận</button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>

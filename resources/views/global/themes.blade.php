@extends('admin.main')
@section('content')
    <div class="content-wrapper">
        @include('global.content_head', [
            'title' => 'Tempate',
        ])
        <style>
            .card-template {
                text-align: center;
                user-select: none;
                cursor: pointer;
            }

            .card-template:hover .wrap-img {
                box-shadow: 0px 0px 15px #0000007a!important;
            }

            .card-template .wrap-img {
                height: 200px;
                border-radius: 20px;
                overflow: hidden;
                box-shadow: 0px 0px 10px #00000036;
                transition: .3s;
            }

            .card-template .wrap-img img{
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .card-template .template-title {
                padding-top: 5px;
            }

            .card-template input {
                width: 16px;
                height: 16px;
                cursor: pointer;
                margin-top: 5px;
            }
        </style>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group m-auto text-center col-md-6">
                                <label for="title">Tiêu đề gia phả</label>
                                <input class="form-control text-center" type="text" name="title" id="title">
                            </div>
                        </div>
                        <div class="row pt-4">
                            <div class="col-12 text-center pb-3"><label for="title">Mẫu cây</label></div>
                            <div class="col-md-3 item-template" data-id="1">
                                <div class="card-template">
                                    <div class="wrap-img">
                                        <img class="w-100" src="https://scontent.fsgn5-14.fna.fbcdn.net/v/t1.15752-9/353817888_134408652972681_3776615963331717005_n.png?_nc_cat=106&ccb=1-7&_nc_sid=ae9488&_nc_ohc=JHN6tPB_bfEAX_mtvWe&_nc_ht=scontent.fsgn5-14.fna&oh=03_AdSbfMykMUdriztV473iQ4Tnfu2pGMShpMQ9do8lX6FQXQ&oe=64C373E0" alt="">
                                    </div>
                                    <div class="template-title">Template phượng</div>
                                    <input type="radio" checked>
                                </div>
                            </div>
                            <div class="col-md-3 item-template" data-id="2">
                                <div class="card-template">
                                    <div class="wrap-img">
                                        <img class="w-100" src="https://scontent.fsgn5-11.fna.fbcdn.net/v/t1.15752-9/353853307_248513494552603_8744280463113893035_n.png?_nc_cat=110&ccb=1-7&_nc_sid=ae9488&_nc_ohc=4EuIlLFuu54AX-bBiJE&_nc_ht=scontent.fsgn5-11.fna&oh=03_AdQkeFU9Tn31ENsoeZfmEPTgJlQTf9GszMZav7tlQxtfJg&oe=64C37C51" alt="">
                                    </div>
                                    <div class="template-title">Template rồng</div>
                                    <input type="radio">
                                </div>
                            </div>
                            <div class="col-md-3 item-template" data-id="3">
                                <div class="card-template">
                                    <div class="wrap-img">
                                        <img class="w-100" src="https://scontent.fsgn5-8.fna.fbcdn.net/v/t1.15752-9/356926881_991959705174385_3153345915926985896_n.png?_nc_cat=109&ccb=1-7&_nc_sid=ae9488&_nc_ohc=q409eilJE_AAX_K0bbm&_nc_ht=scontent.fsgn5-8.fna&oh=03_AdRYf4x4PKZL3ZjeOcABtLtZD4t3W_7GI0Ij_9z02WlLDQ&oe=64C3854F" alt="">
                                    </div>
                                    <div class="template-title">Template rồng</div>
                                    <input type="radio">
                                </div>
                            </div>
                            <div class="col-md-3 item-template" data-id="4">
                                <div class="card-template">
                                    <div class="wrap-img">
                                        <img class="w-100" src="https://scontent.fsgn5-14.fna.fbcdn.net/v/t1.15752-9/353788295_197863966216782_7709808599390926829_n.png?_nc_cat=106&ccb=1-7&_nc_sid=ae9488&_nc_ohc=ryS9N9DpuiwAX_exj9c&_nc_ht=scontent.fsgn5-14.fna&oh=03_AdR__SpPeA_Y-KK8PL8WVMy-VTgKnN5HDvlCcGmd2x5tOw&oe=64C364B4" alt="">
                                    </div>
                                    <div class="template-title">Template rồng</div>
                                    <input type="radio">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center pt-4">
                                <button class="btn btn-info">Áp dụng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        $('.item-template').click(function(){
            $('.item-template').find('input').prop('checked', false);
            $(this).find('input').prop('checked', true);
        });
    </script>
@endsection

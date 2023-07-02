@extends('admin.main')
@section('content')
    <div class="content-wrapper">
        @include('global.content_head', [
            'title' => 'Cấu hình cây',
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
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group m-auto text-center col-md-6">
                                <label for="title">Tiêu đề gia phả</label>
                                <input class="form-control text-center title" type="text" value="{{$config->title}}">
                            </div>
                        </div>
                        <div class="row pt-4">
                            <div class="col-12 text-center pb-3"><label for="title">Mẫu cây</label></div>
                            <div class="col-md-3 item-template" data-id="1">
                                <div class="card-template">
                                    <div class="wrap-img">
                                        <img class="w-100" src="img/fixed/template_1.jpg" alt="template_1">
                                    </div>
                                    <div class="template-title">Mặc định</div>
                                    <input
                                        type="radio"
                                        @if ($config->template_id == 1)
                                        checked
                                        @endif
                                    >
                                </div>
                            </div>
                            <div class="col-md-3 item-template" data-id="2">
                                <div class="card-template">
                                    <div class="wrap-img">
                                        <img class="w-100" src="img/fixed/template_2.jpg" alt="template_2">
                                    </div>
                                    <div class="template-title">Template 1</div>
                                    <input
                                        type="radio"
                                        @if ($config->template_id == 2)
                                        checked
                                        @endif
                                    >
                                </div>
                            </div>
                            <div class="col-md-3 item-template" data-id="3">
                                <div class="card-template">
                                    <div class="wrap-img">
                                        <img class="w-100" src="img/fixed/template_3.jpg" alt="template_3">
                                    </div>
                                    <div class="template-title">Template 2</div>
                                    <input
                                        type="radio"
                                        @if ($config->template_id == 3)
                                        checked
                                        @endif
                                    >
                                </div>
                            </div>
                            <div class="col-md-3 item-template" data-id="4">
                                <div class="card-template">
                                    <div class="wrap-img">
                                        <img class="w-100" src="https://scontent.fsgn5-14.fna.fbcdn.net/v/t1.15752-9/353788295_197863966216782_7709808599390926829_n.png?_nc_cat=106&ccb=1-7&_nc_sid=ae9488&_nc_ohc=ryS9N9DpuiwAX_exj9c&_nc_ht=scontent.fsgn5-14.fna&oh=03_AdR__SpPeA_Y-KK8PL8WVMy-VTgKnN5HDvlCcGmd2x5tOw&oe=64C364B4" alt="">
                                    </div>
                                    <div class="template-title">Template 3 (chưa sẵn có)</div>
                                    <input
                                        type="radio"
                                        @if ($config->template_id == 4)
                                        checked
                                        @endif
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <form class="col-12 text-center pt-4" action="{{route('setConfig')}}" method="post">
                                @csrf
                                <input type="hidden" name="title" value="{{$config->title}}" id="title">
                                <input type="hidden" name="template_id" value="{{$config->template_id}}" id="template_id">
                                <button class="btn btn-info">Áp dụng</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        let template_id = '{{$config->template_id}}';
        $('.item-template').click(function(){
            $('.item-template').find('input').prop('checked', false);
            $(this).find('input').prop('checked', true);
            $('#template_id').val($(this).attr('data-id'));
        });
        $('.title').change(function(){
            $('#title').val($(this).val());
        });
    </script>
@endsection

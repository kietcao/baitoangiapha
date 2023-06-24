@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <link rel="stylesheet" href="css/detail_member.css">
    @include('global.content_head', [
        'title' => 'Thông tin của ' . $member->fullname
    ])
    <style>
        @media screen and (max-width: 1440px) {
            .wrap-image div {
                left: 0;
            }
        }

        @media screen and (max-width: 1024px) {
            .wrap-image div {
                left: 50%;
                transform: translateX(-50%);
            }

            .wrap-content {
                padding: 0;
                text-align: center;
                padding-top: 30px;
            }

            .wrap-relations {
                justify-content: center;
                flex-wrap: wrap;
            }

            .relation-member-item {
                padding: 15px;
            }
        }

        @media screen and (max-width: 986px) {
            .col-left {
                order: 2;
            }

            .col-right {
                order: 1;
            }

            .relation-member-item {
                padding: 10px;
            }
        }

        @media screen and (max-width: 425px) {
            .relation-member-item {
                padding: 6px;
            }
            .full-name {
                font-size: 30px;
            }
            .role-name {
                font-size: 18px;
            }

            .info-item {
                font-size: 15px;
            }
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="card mb-0 card-info">
                <div class="wrap-background">
                    <div></div>
                    <img src="{{$member->avatar}}" alt="{{$member->avatar}}">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8 col-left">
                            <div class="wrap-content">
                                <div class="role-name">{{$member->role_name}}</div>
                                <div class="full-name">{{$member->fullname}}</div>
                                <div class="info-item">
                                    <b>Ngày sinh:</b>
                                    <span>{{date('d-m-Y', strtotime($member->birthday))}}</span>
                                </div>
                                @if (!empty($member->leaveday))
                                <div class="info-item">
                                    <b>Ngày mất:</b>
                                    <span>{{date('d-m-Y', strtotime($member->leaveday))}}</span>
                                </div>
                                @endif
                                @if (!empty($member->phone))
                                <div class="info-item">
                                    <b>Số điện thoại:</b>
                                    <span>{{$member->phone}}</span>
                                </div>
                                @endif
                                @if (!empty($member->email))
                                <div class="info-item">
                                    <b>Email:</b>
                                    <span>{{$member->email}}</span>
                                </div>
                                @endif
                                <div class="info-item">
                                    <b>Giới tính:</b>
                                    @if ($member->gender == App\Constants\Gender::MALE)
                                    <span>Nam</span>
                                    @else
                                    <span>Nữ</span>
                                    @endif
                                </div>
                                @if (!empty($member->position_index))
                                <div class="info-item">
                                    <b>Thứ tự:</b>
                                    <span>{{$member->position_index}}</span>
                                </div>
                                @endif
                                @if ($parent->count() > 0)
                                <div class="info-item">
                                    <b>Phụ huynh:</b>
                                    <div class="wrap-relations">
                                        @foreach ($parent as $parent)
                                        <div class="relation-member-item">
                                            <div class="relation-member-avatar">
                                                <img src="{{$parent->avatar}}" alt="{{$parent->avatar}}">
                                            </div>
                                            <div class="relation-member-fullname">{{$parent->fullname}}</div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @if ($couple->count() > 0)
                                <div class="info-item">
                                    @if ($member->gender == App\Constants\Gender::MALE)
                                    <b>Vợ:</b>
                                    @else
                                    <b>Chồng:</b>
                                    @endif
                                    <div class="wrap-relations">
                                        @foreach ($couple as $couple)
                                        <div class="relation-member-item">
                                            <div class="relation-member-avatar">
                                                <img src="{{$couple->avatar}}" alt="{{$couple->avatar}}">
                                            </div>
                                            <div class="relation-member-fullname">{{$couple->fullname}}</div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @if ($child->count() > 0)
                                <div class="info-item">
                                    <b>Con cái:</b>
                                    <div class="wrap-relations">
                                        @foreach ($child as $child)
                                        <div class="relation-member-item">
                                            <div class="relation-member-avatar">
                                                <img src="{{$child->avatar}}" alt="{{$child->avatar}}">
                                            </div>
                                            <div class="relation-member-fullname">{{$child->fullname}}</div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-right">
                            <div class="wrap-image m-auto">
                                <img src="{{$member->avatar}}" alt="{{$member->avatar}}">
                                <div>{{$member->fullname}} - {{$member->age()}} tuổi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (!empty($member->story))
            <div class="row row-story">
                <div class="col-12">
                    <div class="wrap-content-story">
                        <h2>Thông tin tiểu sử</h2>
                        <div class="story">{!!$member->story!!}</div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
</div>
@endsection
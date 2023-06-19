@extends('admin.main')
@section('content')
<div class="content-wrapper">
    @include('global.content_head', [
        'title' => 'Quản lý sự kiện'
    ])
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    {{old('keyword')}}
                    <form class="row" action="{{route('events')}}" method="get" enctype="multipart/form-data">
                        <div class="form-group col-md-3">
                            <label for="">Tên sự kiện</label>
                            <input type="text" class="form-control" name="keyword" value="{{$inputed['keyword'] ?? null}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Từ ngày</label>
                            <input type="text" class="form-control" name="from_date" value="{{$inputed['from_date'] ?? null}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Đến ngày</label>
                            <input type="text" class="form-control" name="to_date" value="{{$inputed['to_date'] ?? null}}">
                        </div>
                        <div class="form-group col-md-1 pt-2">
                            <button type="submit" class="btn btn-info mt-4">Tìm kiếm</button>
                        </div>
                        <div class="form-group col-md-2 pt-2 text-right">
                            <a href="{{route('create_event_view')}}" class="btn btn-success mt-4">Tạo sự kiện</a>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="bg-info">
                            <th>#ID</th>
                            <th>Tên sự kiện</th>
                            <th>Ngày diễn ra</th>
                            <th>Số thành viên</th>
                            <th>Thao tác</th>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td>{{$event->id}}</td>
                                <td>{{$event->title}}</td>
                                <td>{{date('d-m-Y', strtotime($event->date))}}</td>
                                <td>{{$event->eventsMembers->count()}}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning">Sửa</button>
                                    <form action="" class="d-inline-block" method="post">
                                        @csrf
                                        <button class="btn btn-sm btn-danger">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pt-md-4 d-flex justify-content-center">{{$events->appends($inputed)->links()}}</div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $( "[name=from_date]" ).datepicker({
            dayNamesMin: [ "T2", "T3", "T4", "T5", "T6", "T7", "CN" ],
            monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            dateFormat: "yy-mm-dd",
        });
        $( "[name=to_date]" ).datepicker({
            dayNamesMin: [ "T2", "T3", "T4", "T5", "T6", "T7", "CN" ],
            monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            dateFormat: "yy-mm-dd",
        });
    </script>
</div>
@endsection
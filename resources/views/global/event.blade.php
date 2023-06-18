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
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="">Tên sự kiện</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Từ ngày</label>
                            <input type="date" class="form-control" name="from_date">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Đến ngày</label>
                            <input type="date" class="form-control" name="to_date">
                        </div>
                        <div class="form-group col-md-1 pt-2">
                            <button class="btn btn-info mt-4">Tìm kiếm</button>
                        </div>
                        <div class="form-group col-md-2 pt-2 text-right">
                            <a href="asd" class="btn btn-success mt-4">Tạo sự kiện</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="bg-info">
                            <th>#ID</th>
                            <th>Tên sự kiện</th>
                            <th>Ngày diễn ra</th>
                            <th>Ngày tạo</th>
                            <th>Số thành viên</th>
                            <th>Thao tác</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Đám giỗ</td>
                                <td>12-05-2022</td>
                                <td>12-05-2022</td>
                                <td>100</td>
                                <td>
                                    <button class="btn btn-sm btn-warning">Sửa</button>
                                    <button class="btn btn-sm btn-danger">Xóa</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
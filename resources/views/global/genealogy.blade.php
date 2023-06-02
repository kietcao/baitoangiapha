@extends('admin.main')
@section('content')
    <style>
        .modal {
            overflow-y: auto !important;
        }

        .modal::-webkit-scrollbar {
            width: 0px;
        }

        .option-button {
            width: 100%;
            border: none;
            outline: none;
            height: 100px;
            background-position: center center;
            background-size: cover;
            overflow: hidden;
            padding: 0;
            border: 3px solid rgb(0 0 0 / 68%);
        }

        .option-button:hover{
            border: 3px solid rgb(0, 127, 217);
        }

        .option-button-wrapper:nth-child(1) .option-button{
            background-image: url('img/fixed/add_member.jpg')
        }

        .option-button-wrapper:nth-child(2) .option-button{
            background-image: url('img/fixed/edit_member.jpg')
        }

        .option-button-wrapper:nth-child(3) .option-button{
            background-image: url('img/fixed/detail_member.jpg')
        }

        .option-button-wrapper:nth-child(4) .option-button{
            background-image: url('img/fixed/delete_member.jpg')
        }

        .option-button div {
            width: 100%;
            height: 100%;
            font-size: 20px;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgb(0 0 0 / 68%);
        }
    </style>
    <div class="content-wrapper">
        @include('global.content_head', [
            'title' => 'Genealogy',
        ])
        <section class="content">
            <div class="container-fluid">
                <div style="width:100%; height:750px;" id="tree"><a href="{{route('add_first_member_view')}}" class="btn btn-info">Thêm thành viên mới</a></div>
            </div>
            {{-- Modal Option Member --}}
            <div class="modal fade" id="option" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document" style="max-width: 900px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tuỳ chọn</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 col-md-3 option-button-wrapper">
                                    <button class="option-button" id="add-member-view">
                                        <div><span>Thêm thành viên</span></div>
                                    </button>
                                </div>
                                <div class="col-12 col-md-3 option-button-wrapper">
                                    <button class="option-button" id="edit-member-view">
                                        <div><span>Sửa thành viên</span></div>
                                    </button>
                                </div>
                                <div class="col-12 col-md-3 option-button-wrapper">
                                    <button class="option-button" id="detail-member">
                                        <div><span>Chi tiết thành viên</span></div>
                                    </button>
                                </div>
                                <div class="col-12 col-md-3 option-button-wrapper">
                                    <button class="option-button">
                                        <div><span>Xoá thành viên</span></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="vendor/familytree/familytree.js"></script>
    <script>
        let currentMemberId = null;

        $( "[name=birthday]" ).datepicker({
            dayNamesMin: [ "T2", "T3", "T4", "T5", "T6", "T7", "CN" ],
            monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            dateFormat: "yy-mm-dd",
        });

        let data = @json($members);
        let treeConfig = {
            nodeBinding: {
                field_0: "fullname",
                field_1: "birthday",
                field_2: "leaveday",
                img_0: "avatar"
            },
            nodes: data,
            enableSearch: true,
            nodeMouseClick: false,
            // nodeMenu: {
            //     edit: {
            //         text: "Edit Now",
            //         onClick: callHandler
            //     }
            // },
            template: 'myTemplate'
        }

        if ($(window).width() <= 500) {
            treeConfig.template = 'john';
        }

        if (data.length > 0) {
            var family = new FamilyTree(document.getElementById("tree"), treeConfig);
        }
        
        FamilyTree.templates.myTemplate = Object.assign({}, FamilyTree.templates.tommy);
        // FamilyTree.templates.myTemplate.field_0 = '<text style="font-size: 16px; font-weight: bold;" fill="white" x="65" y="60" text-anchor="middle">{val}</text>';
        // FamilyTree.templates.myTemplate.field_1 = '<text style="font-size: 13px;" fill="#4d4d4d" x="82" y="90" text-anchor="middle">Ngày sinh: {val}</text>';
        //FamilyTree.templates.myTemplate.field_2 = '<text style="font-size: 13px;" fill="#4d4d4d" x="82" y="107" text-anchor="middle">Ngày mất: {val}</text>';
        FamilyTree.templates.myTemplate.field_0 = `<text data-width="230" style="font-size: 14px;font-weight:bold;" fill="#ffffff" x="10" y="65" text-anchor="start">{val}</text>`;
        FamilyTree.templates.myTemplate.field_1 = `<text data-width="150" style="font-size: 12px;" fill="#000000ab" x="11" y="90" text-anchor="start">Ngày sinh: {val}</text>`;
        FamilyTree.templates.myTemplate.field_2 = `<text data-width="150" style="font-size: 12px;" fill="#000000ab" x="11" y="107" text-anchor="start">Ngày mất: {val}</text>`;
        family.on('click', function(sender, args) {
            var data = sender.get(args.node.id);
            var id = data.id;
            currentMemberId = data.id;
            $('#option').modal('show');
        });

        $('#add-member-view').click(function(){
            location.href = `add-family-member/${currentMemberId}`;
        });
        $('#edit-member-view').click(function(){
            location.href = `edit-family-member/${currentMemberId}`;
        });
        $('#detail-member').click(function(){
            location.href = `member/${currentMemberId}`;
        })
    </script>
@endsection

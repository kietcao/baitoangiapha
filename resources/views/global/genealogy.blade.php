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

        g,
        g * {
            cursor: pointer;
        }

        rect {
            fill: white;
            rx: 10;
            ry: 10;
            stroke: rgba(0, 0, 0, 0.048);
            filter: drop-shadow(2px 4px 6px rgba(0, 0, 0, 0.067));
            transition: .3s;
        }

        g:hover rect {
            filter: drop-shadow(2px 4px 6px rgba(0, 0, 0, 0.278));
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
                                <form action="" method="post" class="col-12 col-md-3 option-button-wrapper" id="form-delete-member">
                                    @csrf
                                    <button class="option-button" id="delete-member">
                                        <div><span>Xoá thành viên</span></div>
                                    </button>
                                </form>
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
        FamilyTree.templates.myTemplate.size = [200, 230];
        FamilyTree.templates.myTemplate.field_0 = `<text data-width="200" style="font-size: 14px;font-weight:bold; text-transform: uppercase;" fill="black" x="100" y="137" text-anchor="middle">{val}</text>`;
        FamilyTree.templates.myTemplate.field_1 = `<text data-width="200" style="font-size: 12px;" fill="#000000ab" x="11" y="167" text-anchor="start">Ngày sinh: {val}</text>`;
        FamilyTree.templates.myTemplate.field_2 = `<text data-width="200" style="font-size: 12px;" fill="#000000ab" x="11" y="185" text-anchor="start">Ngày mất: {val}</text>`;
        FamilyTree.templates.myTemplate.img_0 =
        '<clipPath id="ulaImg">'
        + '<circle cx="100" cy="50" r="40"></circle>'
        + '</clipPath>'
        + '<image preserveAspectRatio="xMidYMid slice" clip-path="url(#ulaImg)" xlink:href="{val}" x="60" y="10" width="80" height="80">'
        + '</image>';

        family.on('click', function(sender, args) {
            var data = sender.get(args.node.id);
            var id = data.id;
            currentMemberId = data.id;
            $('#option').modal('show');
            $('#form-delete-member').attr('action', `member/${currentMemberId}/delete`);
            checkValidForDelete(currentMemberId);
        });

        $('#add-member-view').click(function(){
            location.href = `add-family-member/${currentMemberId}`;
        });
        $('#edit-member-view').click(function(){
            location.href = `edit-family-member/${currentMemberId}`;
        });
        $('#detail-member').click(function(){
            location.href = `member/${currentMemberId}`;
        });

        function checkValidForDelete(currentMemberId)
        {
            // Is couple + has child OR only has child OR is has couple + has parent => don't delete
            let findIndex = data.findIndex(function(item){
                return item.id == currentMemberId;
            });
            let member = data[findIndex];

            // Check has bride or crumb
            let isCouple = member.pids.length > 0 ? true : false;

            // Check has child
            let isHasChild = false;
            let countChild = 0;
            data.forEach(function (current, index) {
                if (member.gender == {{App\Constants\Gender::MALE}}) {
                    let currentFatherId = current.fid;
                    if (currentFatherId == currentMemberId) {
                        countChild++;
                    }
                } else {
                    let currentMotherId = current.mid;
                    if (currentMotherId == currentMemberId) {
                        countChild++;
                    }
                }
            });
            isHasChild = countChild > 0 ? true : false;

            // Check is has parent
            let isHasParent = member.mid != null || member.fid != null ? true : false;

            //Show button delete person
            isHasChild && isCouple || isHasChild || isCouple && isHasParent
                ? $('#delete-member').css({'opacity' : '0.2'}).prop('disabled', true)
                : $('#delete-member').css({'opacity' : '1'}).prop('disabled', false);
        }
    </script>
@endsection

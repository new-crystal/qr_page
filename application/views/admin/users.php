<script type="text/javascript" src="/assets/js/admin/lecture_history.js"></script>
<style>
    table th {
        padding: 0;
        font-size: 1.2rem;
    }
</style>
<!-- Main content -->
<div class="content-wrapper">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">학회등록인원</span></h4>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">

        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">등록 인원</h5>
                <div class="heading-elements">
                    <form action="/admin/excel_download" method="post">
                        <button class="btn btn-primary pull-right"><i class="icon-download4"></i> &nbspExcel
                            Download</button>
                    </form>
                    <form action="/admin/deposit_check" method="post" id="depositForm">
                        <button class="btn btn-primary pull-right"><i class="icon-checkmark"></i> 입금확인</button>
                    </form>
                    <form action="/admin/non_deposit_check" method="post" id="non_depositForm">
                        <button class="btn btn-danger pull-right"><i class="icon-checkmark"></i> 미결제처리</button>
                    </form>
                    <!-- <form action="/admin/qr_layout_post" method="post" id="nametagForm">
                        <button class="btn btn-primary pull-right"><i class="icon-printer2"></i> 네임택 출력</button>
                    </form> -->
                    <a class="btn btn-primary pull-right" href="/admin/add_user"><i class="icon-add"></i> 등록</a>
                    <!--
                                <a class="btn btn-primary pull-right" href="/admin/qr_layout_all?type=좌장"><i class="icon-printer2"></i> 좌장</a>
                                <a class="btn btn-primary pull-right" href="/admin/qr_layout_all?type=연자"><i class="icon-printer2"></i> 연자</a>
                                <a class="btn btn-primary pull-right" href="/admin/qr_layout_all?type=패널"><i class="icon-printer2"></i> 패널</a>
                                <a class="btn btn-primary pull-right" href="/admin/qr_layout_all?type=president"><i class="icon-printer2"></i> president</a>
                                <a class="btn btn-primary pull-right" href="/admin/qr_layout_all?type=임원"><i class="icon-printer2"></i> 임원</a>
                                <a class="btn btn-primary pull-right" href="/admin/qr_layout_all?type=일반참가자"><i class="icon-printer2"></i> 일반</a>
                                <a class="btn btn-primary pull-right" href="/admin/qr_layout_all?type=후원사"><i class="icon-printer2"></i> 후원</a>
-->
                </div>
            </div>

            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <!--									<th style="text-align: center;"><input type="checkbox" id="allChk" value="입금완료th"></th>-->
                        <!-- <th></th>
                        <th>회원여부</th>
                        <th>접수번호</th>
                        <th>구분1</th>
                        <th>구분2</th>
                        <th style="min-width: 100px">면허번호</th>
                        <th>이름</th>
                        <th>전화번호</th>
                        <th>이메일</th>
                        <th>소속</th>
                        <th>등록비</th>
                        <th>입금자명</th>
                        <th>입금여부</th>
                        <th>QR 생성여부</th>
                        <th>입장시간</th>
                        <th>퇴장시간</th>
                        <th>메모</th> -->

                        <th></th>
                        <th style="min-width: 90px">회원여부</th>
                        <th>등록시간</th>
                        <th>접수번호</th>
                        <th style="min-width: 100px">참석자유형</th>
                        <th>참석자구분</th>
                        <th>이름</th>
                        <th>소속</th>
                        <th>이메일</th>
                        <th>전화번호</th>
                        <th>영수증출력</th>
                        <th>메일전송</th>
                        <th>등록비</th>
                        <th>입금여부</th>
                        <th>메모</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $item) {
                        echo '<tr>';
                        echo '<td style="text-align: center;"><input type="checkbox" name="depositChk" class="depositChk" value="' .  $item['registration_no'] . '"></td>';
                        echo '<td>' . $item['type3'] . '</td>';
                        echo '<td>' . substr($item['time'], 0, 10) . '</td>';
                        echo '<td>' . $item['registration_no'] . '</td>';
                        echo '<td>' . $item['type'] . '</td>';
                        echo '<td>' . $item['type2'] . '</td>';
                        echo '<td class="user_d"><a href="/admin/user_detail?n=' . $item['phone'] . '">' . $item['nick_name'] . '</a></td>';
                        echo '<td>' . $item['org'] . '</td>';
                        echo '<td>' . $item['email'] . '</td>';
                        echo '<td>' . $item['phone'] . '</td>';
                        echo '<td>';
                        echo '<a><div class="btn btn-non-success qr_btn" >영수증</div></a>';
                        echo '</td>';
                        echo '<td>';
                        echo '<a><div class="btn btn-warning qr_btn" >메일발송</div></a>';
                        echo '</td>';
                        echo '<td style="text-align: center;">' . number_format($item['fee']) . '</td>';
                        if ($item['deposit'] == "미결제") {
                            echo '<td style="color:red;">';
                        } else {
                            echo '<td style="color:blue;">';
                        }
                        echo '' . $item['deposit'] . '</td>';
                        echo '</td>';
                        if ($item['memo'] != "") {
                            echo '<td>';
                            echo '<button class="btn qr_btn memo bg-indigo-800" onclick="onClickMemo(' . $item['phone'] . ')">메모</button>';
                        } else {
                            echo '<td>';
                            echo '<button class="btn qr_btn memo border-indigo-800 text-indigo-800" style="background:#fff" onclick="onClickMemo(' . $item['phone'] . ')">메모</button>';
                        }
                        echo '</td>';

                        // echo $item['deposit'] . '</td>';
                        // if ($item['qr_chk'] == "N") {
                        //     echo '<td style="color:red;">';
                        //     echo '<a href="/admin/qr_generate?n=' . $item['phone'] . '"><div class="btn btn-danger qr_btn" >QR 생성</div></a>';
                        //     echo '</td>';
                        // } else {
                        //     echo '<td style="color:red;">';
                        //     echo '<a href="/admin/qr_layout?n=' . $item['phone'] . '"><div class="btn btn-success" >QR 보기</div></a>';
                        //     echo '</td>';
                        // }


                        // echo '<td>' . $item['mintime'] . '</td>';
                        // echo '<td>' . $item['maxtime'] . '</td>';
                        // echo '<td>' . $item['memo'] . '</td>';
                        echo '</tr>';
                    }
                    ?>

                </tbody>
            </table>
        </div>
        <!-- /basic datatable -->
        <div class="footer text-muted">
            © 2022. <a href="#">온라인 학술대회</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">(주)인투온</a>
        </div>
    </div>
    <!-- /content area -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->
<script>
    //        $('#allChk').click(function(){
    //            if($('input:checkbox[id="allChk"]').prop('checked')){
    //                $('input[type=checkbox]').prop('checked',true);
    //            }else{
    //                $('input[type=checkbox]').prop('checked',false);
    //            }
    //        })

    function onClickMemo(phone) {
        const url = (phone.toString().charAt(0) === "0") ?
            `/admin/memo?n=0${phone}` :
            `/admin/memo?n=${phone}`;
        console.log(url)
        window.open(url, "Certificate", "width=500, height=300, top=30, left=30");
    }




    $('.depositChk').click(function() {
        var formName = $('#depositForm');
        var formName2 = $('#nametagForm');
        var formName3 = $('#non_depositForm');
        var userId = $(this).val();
        var checkHtml = '<input type="hidden" class="userId user' + userId + '" name="userId[]" value="' + userId +
            '" id="">'
        if ($(this).prop('checked')) {
            formName.append(checkHtml);
            formName2.append(checkHtml);
            formName3.append(checkHtml);
        } else {
            $('.user' + userId).remove();
        }
    })
</script>
</body>
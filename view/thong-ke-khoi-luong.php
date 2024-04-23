<?php

$content = '
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Khối lượng giảng dạy</h1>
    
</div>
<div class="col">
<span class="badge rounded-pill text-bg-danger mb-3"> <a href="" class="text-decoration-none text-light"> Trang chủ </a></span>
<span class="badge rounded-pill text-bg-light mb-3"> <strong> <i class="bi bi-caret-right-fill"></i> </strong> </span>
<span class="badge rounded-pill text-bg-info mb-3">  Thống kê khối lượng </span>
</div>


<div class="card mb-4">
    <div class="card-body">

    <div class="form-group row"> 
    </div>
    <div class="form-group row ">
    <label for="maHocKy" class="col-sm-1 col-form-label"><strong>Học kỳ</strong></label>
    <div class="col-sm-3">
        <select class="form-control"  id="maHocKy" name="maHocKy">';

$content .= '
</select>
</div>

<div class="col-auto ml-auto">
<button class="btn btn-outline-light" style="background-color: #712CF9"  id="thucHanhButton"><strong>Thực hành</strong></button>
<button class="btn btn-outline-light"  style="background-color: #712CF9" id="lyThuyetThucHanhButton"><strong>Lý thuyết thực hành</strong></button>
<button class="btn btn-outline-light"  style="background-color: #712CF9" id="doAnButton"><strong>Đồ án</strong></button>
</div>

</div>

<!-- Phần thực hành -->
<div id="thucHanhLayout" style="display: none;">
    <div class="table-responsive">
    <table id="thucHanhTable" class="table table-bordered">
        <thead class="">
        <tr>
            <th rowspan="3"  class="text-center align-middle "  style="font-size: 12px;">STT</th>
            <th rowspan="3"  class="text-center align-middle" style="font-size: 12px;">CÁC MÔN THÍ NGHIỆM THỰC HÀNH</th>
            <th colspan="5" rowspan="2"  class="text-center align-middle"  style="font-size: 12px;">SỐ SINH VIÊN HỌC THÍ NGHIỆM - THỰC HÀNH</th>
            <th rowspan="3"  class="text-center align-middle "  style="font-size: 12px;">SỐ CA <br> THỰC <br> HÀNH </th>
            <th colspan="7"  class="text-center align-middle"  style="font-size: 12px;">GIÁO VIÊN HƯỚNG DẪN</th>
        </tr>
        <tr>
            <th colspan="3"  class="text-center align-middle"  style="font-size: 12px;">GIÁO VIÊN THỨ NHẤT (TG/CH)</th>
            <th colspan="4"  class="text-center align-middle"  style="font-size: 12px;">GIÁO VIÊN THỨ HAI (TG/CH)</th>
        </tr>
        <tr>
            <th  class="text-center align-middle"  style="font-size: 12px;">NGÀNH <br> LỚP</th>
            <th  class="text-center align-middle"  style="font-size: 12px;">SL</th>
            <th  class="text-center align-middle"  style="font-size: 12px;">SỐ CA <br> 1 SV</th>
            <th  class="text-center align-middle"  style="font-size: 12px;">SỐ SV <br> 1 CA</th>
            <th  class="text-center align-middle"  style="font-size: 12px;">SỐ <br> NHÓM</th>
            
            <th colspan="2"  class="text-center align-middle"  style="font-size: 12px;">Họ Tên</th>
            <th  class="text-center align-middle"  style="font-size: 12px;">Số Tiết</th>
           
            <th colspan="2"  class="text-center align-middle"  style="font-size: 12px;">Họ Tên</th>
            <th  class="text-center align-middle"  style="font-size: 12px;">Số Tiết</th>
            <th  class="text-center align-middle"  style="font-size: 12px;">Số Ca</th>
        </tr>
    </thead>
    
      <tbody>
 </tbody>
        </table>
    </div>
    </div>

    <!-- Phần lý thuyết thực hành -->
    <div id="lyThuyetThucHanhLayout" style="display: none;">
        <!-- HTML cho bảng lý thuyết thực hành -->
        <div class="table-responsive">
            <table id="lyThuyetThucHanhTable" class="table table-bordered">
                <!-- Phần tiêu đề của bảng -->
                <thead>
                <tr>
                <th rowspan="3"  class="text-center align-middle "  style="font-size: 12px;">STT</th>
                <th rowspan="3"  class="text-center align-middle" style="font-size: 12px;">CÁC MÔN LÝ THUYẾT HỌC TẠI PHÒNG MÁY</th>
                <th colspan="5" rowspan="2"  class="text-center align-middle"  style="font-size: 12px;">SỐ SINH VIÊN HỌC</th>
               
                <th colspan="6"   class="text-center align-middle"  style="font-size: 12px;">GIÁO VIÊN HƯỚNG DẪN</th>
                <th rowspan="2" colspan="2"  class="text-center align-middle "  style="font-size: 12px;">CA <br> NGÀY / TỐI</th>
            </tr>
            <tr>
                <th colspan="3"  class="text-center align-middle"  style="font-size: 12px;">GIÁO VIÊN THỨ NHẤT (TG/CH)</th>
                <th colspan="3"  class="text-center align-middle"  style="font-size: 12px;">GIÁO VIÊN THỨ HAI (TG/CH)</th>
            </tr>
            <tr>
                <th  class="text-center align-middle"  style="font-size: 12px;">NGÀNH LỚP</th>
                <th  class="text-center align-middle"  style="font-size: 12px;">SỐ LƯỢNG</th>
                <th  class="text-center align-middle"  style="font-size: 12px;">Số CA 1 SV</th>
                <th  class="text-center align-middle"  style="font-size: 12px;">Số SV 1 CA</th>
                <th  class="text-center align-middle"  style="font-size: 12px;">Số <br> NHÓM</th>
                
                <th colspan="2"  class="text-center align-middle"  style="font-size: 12px;">Họ Tên</th>
                <th  class="text-center align-middle"  style="font-size: 12px;">Số Tiết</th>
               
                <th colspan="2"  class="text-center align-middle"  style="font-size: 12px;">Họ Tên</th>
                <th  class="text-center align-middle"  style="font-size: 12px;">Số Tiết</th>

                <th class="text-center align-middle" style="font-size: 12px;">NGÀY</th>
                <th class="text-center align-middle" style="font-size: 12px;">TỐI</th>
               
            </tr>
                </thead>
                <!-- Phần dữ liệu của bảng -->
                <tbody>
                    <!-- Các dòng dữ liệu của bảng lý thuyết thực hành -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Phần đồ án -->
    <div id="doAnLayout" style="display: none;">
        <!-- HTML cho bảng đồ án -->
        <div class="table-responsive">
            <table id="doAnTable" class="table table-bordered">
                <!-- Phần tiêu đề của bảng -->
                <thead>
        <tr>
            <th rowspan="3"  class="text-center align-middle "  style="font-size: 12px;">STT</th>
            <th rowspan="3"  class="text-center align-middle" style="font-size: 12px;">CÁC MÔN ĐỒ ÁN + BÀI TẬP LỚN</th>
            <th colspan="5" rowspan="2"  class="text-center align-middle"  style="font-size: 12px;">SỐ SINH VIÊN HỌC THÍ NGHIỆM - THỰC HÀNH</th>
            <th rowspan="3"  class="text-center align-middle "  style="font-size: 12px;">SỐ CA THỰC HÀNH </th>
            <th colspan="7"  class="text-center align-middle"  style="font-size: 12px;">GIÁO VIÊN HƯỚNG DẪN</th>
        </tr>
        <tr>
            <th colspan="2"  class="text-center align-middle"  style="font-size: 12px;">GIÁO VIÊN THỨ NHẤT (TG/CH)</th>
            <th colspan="3"  class="text-center align-middle"  style="font-size: 12px;">GIÁO VIÊN THỨ HAI (TG/CH)</th>
        </tr>
        <tr>
            <th  class="text-center align-middle"  style="font-size: 12px;">NGÀNH LỚP</th>
            <th  class="text-center align-middle"  style="font-size: 12px;">SL</th>
            <th  class="text-center align-middle"  style="font-size: 12px;">Số CA 1 SV</th>
            <th  class="text-center align-middle"  style="font-size: 12px;">Số SV 1 CA</th>
            <th  class="text-center align-middle"  style="font-size: 12px;">Số CA NHÓM</th>
            
            <th colspan="2"  class="text-center align-middle"  style="font-size: 12px;">Họ Tên</th>
           
            <th colspan="2"  class="text-center align-middle"  style="font-size: 12px;">Họ Tên</th>
            <th  class="text-center align-middle"  style="font-size: 12px;">Số Ca</th>
        </tr>
    </thead>
                <!-- Phần dữ liệu của bảng -->
                <tbody>
                    <!-- Các dòng dữ liệu của bảng đồ án -->
                </tbody>
            </table>
        </div>
    </div>

</div>
</div>
';

$content .= '
<script>
$(document).ready(function() {
    
    loadHocKyList();

    function loadHocKyList() {
       
        $.ajax({
            url: "../controller/thongkecontroller.php?action=getListHocKy",
            type: "GET",
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    var html = "<option value=\'\'>Chọn học kỳ</option>"; // Thêm option mặc định
                    data.data.forEach(function(item) {
                       if(item.ten_hocky == 1){
                            hocKyRoman = "I";
                          }else if(item.ten_hocky == 2){
                            hocKyRoman = "II";
                            }else if(item.ten_hocky == 3){
                                hocKyRoman = "III";
                            }

                        html += \'<option value="\' + item.ma_hocky + \'">Học kỳ: \' + hocKyRoman  + \' Năm học: \' + item.nam_hoc + \'-\' + (parseInt(item.nam_hoc) + 1) + \'</option>\';
                       
                    });

                    $("#maHocKy").html(html); // Đặt HTML mới cho select box
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log lỗi nếu có
            }
        });
    }

}); 
</script>


';

require_once __DIR__ . '/../Helper/ConfigHelper.php';
include VIEW_PATH . 'admin/layout-admin.php';

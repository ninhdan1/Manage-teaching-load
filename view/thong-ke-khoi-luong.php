<?php

$content = '

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Khối lượng giảng dạy</h1>
    
</div>
<div class="col">
<span class="badge rounded-pill text-bg-danger mb-3"> <a href="/view/admin/layout-admin.php" class="text-decoration-none text-light"> Trang chủ </a></span>
<span class="badge rounded-pill text-bg-light mb-3"> <strong> <i class="bi bi-caret-right-fill"></i> </strong> </span>
<span class="badge rounded-pill text-bg-info mb-3">  Thống kê khối lượng </span>
</div>


<div class="card mb-4">
    <div class="card-body">


    <div class="form-group row ">
    <label for="maHocKy"><strong>Học kì</strong></label>
    <div class="col-sm-4">

  
        <select class="form-select mt-2"  id="maHocKy" name="maHocKy">
        ';


$content .= '
</select>


</div>
<div class="col-auto ml-auto">

<button class="btn btn-outline-light " style="background-color: #712CF9"  id="thucHanhButton"><strong>Thực hành</strong></button>
<button class="btn btn-outline-light"  style="background-color: #712CF9" id="lyThuyetThucHanhButton"><strong>Lý thuyết phòng máy</strong></button>
<button class="btn btn-outline-light"  style="background-color: #712CF9" id="doAnButton"><strong>Đồ án</strong></button>
<button class="btn btn-dark " id="thongKeTongHopButton"><strong>Kết quả tổng hợp</strong></button>
</div>

</div>

<div class="form-group row ">

<div class="col-sm-6">
<label for="maGiangVien"><strong>Giảng viên</strong></label>
<div class="form-floating">
<select class="form-select  mt-2" id="maGiangVien"  name="maGiangVien" multiple>
<option value="" selected>Chọn giảng viên</option>
</select> 

</div>

</div>


<div class="col-sm-6">
<label for="maMonHoc"><strong>Môn học</strong></label>
<div class="form-floating">
<select class="form-select  mt-2"" id="maMonHoc"  name="maMonHoc" multiple>


</select>

</div>
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
            <th colspan="5"  class="text-center align-middle"  style="font-size: 12px;">GIÁO VIÊN HƯỚNG DẪN</th>
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


    <!-- Phần thống kê tổng hợp -->
    <div id="thongKeTongHopLayout" >
        <!-- HTML cho bảng thống kê tổng hợp -->
        <div class="table-responsive">
            <table id="thongKeTongHopTable" class="table table-bordered">
                <!-- Phần tiêu đề của bảng -->
                <thead>
                <tr>
                <th rowspan="3"  class="text-center align-middle "  style="font-size: 12px;">STT</th>
                <th rowspan="3"  class="text-center align-middle" style="font-size: 12px;">CÁC MÔN HỌC</th>
                <th colspan="5" rowspan="2"  class="text-center align-middle"  style="font-size: 12px;">SỐ SINH VIÊN HỌC</th>
                <th rowspan="3"  class="text-center align-middle "  style="font-size: 12px;">SỐ CA <br> THỰC <br> HÀNH </th>
                <th colspan="3"  class="text-center align-middle"  style="font-size: 12px;">GIÁO VIÊN HƯỚNG DẪN</th>
                <th colspan="2" rowspan="2"  class="text-center align-middle"  style="font-size: 12px;">THÔNG TIN MÔN HỌC</th>
            </tr>
            <tr>
                <th colspan="3"  class="text-center align-middle"  style="font-size: 12px;">GIÁO VIÊN (TG/CH)</th>
               
            </tr>
            <tr>
                <th  class="text-center align-middle"  style="font-size: 12px;">NGÀNH <br> LỚP</th>
                <th  class="text-center align-middle"  style="font-size: 12px;">SL</th>
                <th  class="text-center align-middle"  style="font-size: 12px;">SỐ CA <br> 1 SV</th>
                <th  class="text-center align-middle"  style="font-size: 12px;">SỐ SV <br> 1 CA</th>
                <th  class="text-center align-middle"  style="font-size: 12px;">SỐ <br> NHÓM</th>
                
                <th colspan="2"  class="text-center align-middle"  style="font-size: 12px;">Họ Tên</th>
                <th  class="text-center align-middle"  style="font-size: 12px;">Số Tiết</th>
               
                <th colspan="1"  class="text-center align-middle"  style="font-size: 12px;">LOẠI MÔN HỌC</th>
                <th  colspan="1" class="text-center align-middle"  style="font-size: 12px;">HỌC KÌ MÔN HỌC</th>
    
            </tr>
                </thead>
                <!-- Phần dữ liệu của bảng -->
                <tbody>
                    <!-- Các dòng dữ liệu của bảng thống kê tổng hợp -->
                </tbody>
            </table>

</div>
</div>
';

$content .= '
<script>
$(document).ready(function() {
    
    loadHocKyList();
    
    loadGiangVienListFirst();
    loadMonHocListFirst();

    function loadHocKyList() {
       
        $.ajax({
            url: "../controller/thongkecontroller.php?action=getListHocKy",
            type: "GET",
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {

                    data.data.sort((a, b) => b.ma_hocky - a.ma_hocky);
                    var html = ""; // Thêm option mặc định
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
                   

                    $("#maHocKy").select2({
                        
                        theme:"bootstrap-5",
                       
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log lỗi nếu có
            }
        });
    }

   


    function loadGiangVienListFirst(){
       
        $.ajax({
            url: "../controller/thongkecontroller.php?action=getListGiangVienExistHocKyMAX",
            type: "GET",
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    var html = "<option value=\'\'>Chọn giảng viên</option>"; // Thêm option mặc định
                    data.data.forEach(function(item) {
                        html += \'<option value="\' + item.ma_gv + \'">\' + item.ho_lot_gv + \' \'  + item.ten_gv + \'</option>\';
                    });

                    $("#maGiangVien").html(html); // Đặt HTML mới cho select box
                    $("#maGiangVien").select2({
                        theme: "bootstrap-5",
                        placeholder: "Chọn giảng viên",
                        closeOnSelect: false,
                        
                    } );
                   
                    
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log lỗi nếu có
            }

        });


    }

    function loadMonHocListFirst(){
        $.ajax({
            url: "../controller/thongkecontroller.php?action=getListMonHocExitstHocKyMAX",
            type: "GET",
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    var html = "<option value=\'\'>Chọn môn học</option>"; // Thêm option mặc định
                    data.data.forEach(function(item) {
                        html += \'<option value="\' + item.ma_monhoc + \'">\' + item.ten_monhoc + \'</option>\';
                    });

                    $("#maMonHoc").html(html); // Đặt HTML mới cho select box
                    $("#maMonHoc").select2({
                        theme: "bootstrap-5",
                        placeholder: "Chọn môn học",
                        closeOnSelect: false,
                       
                      
   
                    } );
                   
                }
            },

        });


    }

   

   
  
 
}); 


</script>



';


require_once __DIR__ . '/../Helper/ConfigHelper.php';
include VIEW_PATH . 'admin/layout-admin.php';
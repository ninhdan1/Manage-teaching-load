<?php

$content = '
<div class="modal fade" id="confirmModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Bạn có chắc chắn muốn xác nhận không?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Nếu như xác nhận, bạn sẽ không thể chỉnh sửa lại thông tin khối lượng giảng dạy này!
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" id="confirmUpdateBtn" class="btn btn-primary">Xác nhận</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="yeuCauChinhSua" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="yeuCauChinhSuaLabel">Yêu cầu chỉnh sửa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form class="was-validated" id="postYeuCauForm">
            <div class="mb-3">
              <label for="tieude" class="col-form-label">Tiêu đề:</label>
              <input type="text" class="form-control" id="tieude" required>
              <div class="valid-feedback">
      Looks good!
    </div>

            </div>
            <div class="mb-3">
              <label for="noidung" class="col-form-label">Nội dung:</label>
              <textarea class="form-control" id="noidung" rows="6"></textarea>
            </div>
          </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            <button type="submit" class="btn btn-primary" form="postYeuCauForm">Gửi yêu cầu</button>
            </div>
        </div>
    </div>
</div>



<div class="d-sm-flex align-items-center justify-content-between mb-4  ">
    <h1 class="h3 mb-0 text-gray-800">Khối lượng giảng dạy cá nhân</h1>
    <h1 class="h3 mb-0 text-gray-800" id="hotengiangvien"></h1>
</div>
<div class="col">
<span class="badge rounded-pill text-bg-danger mb-3"> <a href="/view/thong-ke-canhan.php" class="text-decoration-none text-light"> Trang chủ </a></span>
<span class="badge rounded-pill text-bg-light mb-3"> <strong> <i class="bi bi-caret-right-fill"></i><i class="bi bi-caret-right-fill"></i><i class="bi bi-caret-right-fill"></i>  </strong> </span>
</div>



<div class="card mb-4">
    <div class="card-body">


    <div class="form-group row">
    <div class="col-sm-4">
    <div class="form-group ">
    <button type="button" class="btn btn-outline-light mr-2 mt-4"  style="background-color: #712CF9" id="btnXacNhanUpdate">Xác nhận</button>
    <button type="button" class="btn btn-info mt-4" id="btnYeuCauChinhSua">Yêu cầu chỉnh sửa</button>
   
    <div class="row align-items-center mt-3"> <!-- Sử dụng lớp row và align-items-center để căn giữa các phần tử -->
    <label for="maHocKyUser" class="col-sm-3 col-form-label"><strong>Học kì</strong></label> <!-- Đặt kích thước cột là 3 -->
    <div class="col-sm-9"> <!-- Sử dụng cột với kích thước còn lại là 9 -->
        <select class="form-select" id="maHocKyUser" name="maHocKyUser"></select>
    </div>
</div>
    </div>
    </div>
    <div class="col-sm-5 ml-auto"> <!-- Sử dụng một cột với kích thước 6 cho phần tử mới -->
        <div class="form-group">
            <label for="" class="col-sm-12 col-form-label"><strong>Tổng kết</strong></label>
            <div class="col-sm-12">
               <table class="table " border="0">
                     <tr>
                          <th> <span class="badge text-bg-warning">Tổng số tiết</span> </th>
                          <td id="tongsotiet"> </td>
                          <th> <span class="badge text-bg-warning">Tổng sinh viên</span> </th>
                          <td id="tongsinhvien"></td>
                         
                     </tr>
                     <tr>
                        <th><span class="badge text-bg-warning"> Tổng môn học</span> </th>
                        <td id="tongmonhoc"></td>
                        <th ><span class="badge text-bg-warning"> Tổng lớp </span></th>
                        <td id="tonglop"> </td>
                    
                    </tr>
                    <tr>
                        <th ><span class="badge text-bg-warning">  Tổng đồ án </span> </th>
                        <td id="tongdoan"> <strong></strong> </td>
                        <th > <span id="isActive"> </span></th>
                        <td> </td>
                   
                     </tr>
                   
               
               </table>
            </div>
        </div>
    </div>
</div>

   





<div id="thongKeCaNhanLayout" >
<!-- HTML cho bảng thống kê tổng hợp -->
<div class="table-responsive">
    <table id="thongKeCaNhanTable" class="table table-bordered">
        <!-- Phần tiêu đề của bảng -->
        <thead>
        <tr>
        <th rowspan="2"  class="text-center align-middle "  style="font-size: 12px;">STT</th>
        <th rowspan="2"  class="text-center align-middle" style="font-size: 12px;">CÁC MÔN HỌC</th>
        <th colspan="5" rowspan="1"  class="text-center align-middle"  style="font-size: 12px;">SỐ SINH VIÊN HỌC</th>
        <th rowspan="2"  class="text-center align-middle "  style="font-size: 12px;">SỐ CA <br> THỰC <br> HÀNH </th>
        <th colspan="1" rowspan="2"  class="text-center align-middle"  style="font-size: 12px;">SỐ TIẾT</th>
        <th colspan="2" rowspan="1"  class="text-center align-middle"  style="font-size: 12px;">THÔNG TIN MÔN HỌC</th>
    </tr>

    <tr>
        <th  class="text-center align-middle"  style="font-size: 12px;">NGÀNH <br> LỚP</th>
        <th  class="text-center align-middle"  style="font-size: 12px;">SL</th>
        <th  class="text-center align-middle"  style="font-size: 12px;">SỐ CA <br> 1 SV</th>
        <th  class="text-center align-middle"  style="font-size: 12px;">SỐ SV <br> 1 CA</th>
        <th  class="text-center align-middle"  style="font-size: 12px;">SỐ <br> NHÓM</th>
        
      
       
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

</div>

<script src="../js/datatables/datatables-thongke-canhan.js"></script>
';

require_once __DIR__ . '/../Helper/ConfigHelper.php';
include VIEW_PATH . 'user/layout-user.php';

<?php

$content = '


<!-- Modal So Sánh Theo Học Kỳ -->
<div class="modal fade" id="SoSanhHocKyModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document"> <!-- Thêm class modal-lg để tăng kích thước modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">So sánh khối lượng giảng dạy theo học kì - <span id="selectedGiangVien"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
           
                <form id="soSanhHocKyForm" class="was-validated">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="ma_hocky1" class="col-form-label">Chọn học kỳ thứ 1:</label>
                                <select class="form-select" id="ma_hocky1"></select>
                            </div>
                        </div>
                        <div class="col-md-5"> 
                            <div class="mb-3">
                                <label for="ma_hocky2" class="col-form-label">Chọn học kỳ thứ 2:</label>
                                <select class="form-select" id="ma_hocky2""></select>
                            </div>
                        </div>

                    <div class="col-md-2 mt-4"> 
                    <div class="mb-3  align-items-center" style=" margin-top: 14px; ">
                    <label class="col-form-label"></label>
                           
                            <button type="button" class="btn btn-outline-warning" id="btnKetQua" disabled ><strong>Kết quả</strong></button>
                        </div>
                    </div>
                    
                    </div>
                </form> 
               
            </div>

            <div class="table-responsive">
<table id="soSanhHocKyTable" class="table">
    <thead >
        <tr>
            <th class="text-center">Nội dung</th>
            <th class="text-center">Học kì thứ 1</th>
            <th class="text-center" >Học kì thứ 2</th>
            <th class="text-center" ">Kết quả (%)</th>
        </tr>
    </thead>
    <tbody>
<tr>
    <td class="text-left "><strong>Số tiết</strong></td>
    <td class="text-center" id="tongTiet1" ></td>
    <td class="text-center" id="tongTiet2" ></td>

    <td class="text-center" id="ketQuaTiet" ></td>

</tr>
<tr>
    <td class="text-left "><strong>Số môn</strong></td>
    <td class="text-center" id="tongMon1" ></td>
    <td class="text-center" id="tongMon2" ></td>

    <td class="text-center" id="ketQuaMon" ></td>

</tr>
<tr>
    <td class="text-left "><strong>Số lớp</strong></td>
    <td class="text-center" id="tongLop1" ></td>
    <td class="text-center" id="tongLop2" ></td>

    <td class="text-center" id="ketQuaLop" ></td>

</tr>
<tr>
    <td class="text-left "><strong>Số sinh viên</strong></td>
    <td class="text-center" id="tongSinhVien1" ></td>
    <td class="text-center" id="tongSinhVien2" ></td>

    <td class="text-center" id="ketQuaSinhVien" ></td>


</tr>
<tr>
    <td class="text-left "><strong>Số đồ án - bài tập lớn</strong></td>
    <td class="text-center" id="tongDoAn1" ></td>
    <td class="text-center" id="tongDoAn2" ></td>

    <td class="text-center" id="ketQuaDoAn" ></td>

</tr>
   

    
    </tbody>
</table>

</div>
<div class="row m-2 mt-1">
    <div class="col ml-3">
        <h6 class="mb-0 text-danger"><b>TỔNG KẾT SO SÁNH</b></h6>
    </div>
    <div class="col mr-3 text-end">
        <span id="tongKetResult" class="mb-0"></span>
    </div>
</div>

            <div class="modal-footer mt-2">
           
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><strong>Đóng</strong></button>
               
            </div>
        </div>
    </div>
</div>


<!-- Modal So Sánh Theo Giảng Viên -->
<div class="modal fade" id="SoSanhGiangVienModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document"> <!-- Thêm class modal-lg để tăng kích thước modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">So sánh khối lượng giảng dạy theo giảng viên - <span id="selectedGiangVien1"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
           
                <form id="soSanhGiangVienForm" class="was-validated">
                    <div class="row">
                       
                        <div class="col-md-5"> 
                            <div class="mb-3">
                                <label for="ma_giangvien" class="col-form-label">Chọn giảng viên:</label>
                                <select class="form-select" id="ma_giangvien"></select>
                            </div>
                        </div>

                        <div class="col-md-5">
                        <div class="mb-3">
                            <label for="ma_hockygiangvien" class="col-form-label">Chọn học kỳ:</label>
                            <select class="form-select" id="ma_hockygiangvien" disabled>
                                <option value="" selected>Chọn học kỳ</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 mt-4"> 
                    <div class="mb-3  align-items-center" style=" margin-top: 14px; ">
                    <label class="col-form-label"></label>
                           
                            <button type="button" class="btn btn-outline-warning" id="btnKetQuaGiangVien" disabled ><strong>Kết quả</strong></button>
                        </div>
                    </div>
                    
                    </div>
                </form> 
               
            </div>

            <div class="table-responsive">
<table id="soSanhGiangVienTable" class="table">
    <thead >
        <tr>
            <th class="text-center">Nội dung</th>
            <th class="text-center">Giảng viên thứ 1</th>
            <th class="text-center" >Giảng viên thứ 2</th>
            <th class="text-center" ">Kết quả (%)</th>
        </tr>
    </thead>
    <tbody>
<tr>
    <td class="text-left "><strong>Số tiết</strong></td>
    <td class="text-center" id="tongTietGV1" ></td>
    <td class="text-center" id="tongTietGV2" ></td>

    <td class="text-center" id="ketQuaTietGV" ></td>

</tr>
<tr>
    <td class="text-left "><strong>Số môn</strong></td>
    <td class="text-center" id="tongMonGV1" ></td>
    <td class="text-center" id="tongMonGV2" ></td>

    <td class="text-center" id="ketQuaMonGV" ></td>

</tr>
<tr>
    <td class="text-left "><strong>Số lớp</strong></td>
    <td class="text-center" id="tongLopGV1" ></td>
    <td class="text-center" id="tongLopGV2" ></td>

    <td class="text-center" id="ketQuaLopGV" ></td>

</tr>
<tr>
    <td class="text-left "><strong>Số sinh viên</strong></td>
    <td class="text-center" id="tongSinhVienGV1" ></td>
    <td class="text-center" id="tongSinhVienGV2" ></td>

    <td class="text-center" id="ketQuaSinhVienGV" ></td>


</tr>
<tr>
    <td class="text-left "><strong>Số đồ án - bài tập lớn</strong></td>
    <td class="text-center" id="tongDoAnGV1" ></td>
    <td class="text-center" id="tongDoAnGV2" ></td>

    <td class="text-center" id="ketQuaDoAnGV" ></td>

</tr>
   

    
    </tbody>
</table>

</div>
<div class="row m-2 mt-1">
    <div class="col ml-3">
        <h6 class="mb-0 text-danger"><b>TỔNG KẾT SO SÁNH</b></h6>
    </div>
    <div class="col mr-3 text-end">
        <span id="tongKetResultGV" class="mb-0"></span>
    </div>
</div>

            <div class="modal-footer mt-2">
           
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><strong>Đóng</strong></button>
               
            </div>
        </div>
    </div>
</div>



<!-- Table Giảng viên-->

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Khối lượng giảng dạy</h1>
    
</div>
<div class="col">
<span class="badge rounded-pill text-bg-danger mb-3"> <a href="/view/admin/layout-admin.php" class="text-decoration-none text-light"> Trang chủ </a></span>
<span class="badge rounded-pill text-bg-light mb-3"> <strong> <i class="bi bi-caret-right-fill"></i> </strong> </span>
<span class="badge rounded-pill text-bg-info mb-3"> So sánh khối lượng </span>
</div>


<div class="card  mb-4">

<div class="card-body">

<div class="d-grid gap-2 d-md-block mb-5">
    <button id="btnSoSanhHocKy"  style="background-color: #712CF9" class="btn btn-outline-light float-md-end mr-2 mt-2 mb-2" type="button">So sánh theo học kì</button>
    <button id="btnSoSanhGiangVien"  style="background-color: #712CF9" class="btn btn-outline-light float-md-end mr-2 mt-2 mb-2" type="button">So sánh theo giảng viên</button>
</div>

    <div class="table-responsive">
        <table id="giangvienTable" class="table table-hover">
            <thead >
                <tr>
                    <th class="text-center">STT</th>
                    <th class="text-center">Mã giảng viên</th>
                    <th class="text-center" >Họ giảng viên</th>
                    <th class="text-center" ">Tên giảng viên</th>
                </tr>
            </thead>
            <tbody>
            
            </tbody>
        </table>

    </div>
</div>
</div>



';

require_once __DIR__ . '/../Helper/ConfigHelper.php';
include VIEW_PATH . 'admin/layout-admin.php';

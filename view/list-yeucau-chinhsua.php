<?php


$content = '

<div class="modal fade" id="DetailYeuCauModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="DetailYeuCauLabel">Chi tiết yêu cầu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="DetailYeuCauForm">
            <div class="mb-3">
              <label for="tieude" class="col-form-label">Tiêu đề:</label>
              <input type="text" class="form-control" id="tieude" readonly>
             
            </div>

            <div class="mb-3 row">
            <div class="col">
                <label for="nguoiyeucau" class="col-form-label">Thông tin người yêu cầu:</label>
                <input type="text" class="form-control" id="nguoiyeucau" readonly>
            </div>
            <div class="col">
                <label for="thoigiantao" class="col-form-label">Thời gian tạo:</label>
                <input type="text" class="form-control" id="thoigiantao" readonly>
            </div>
        </div>
            <div class="mb-3">
            
              <label for="noidung" class="col-form-label">Nội dung:</label>
              <textarea class="form-control" id="noidung" rows="6" readonly></textarea>
            </div>
          </form>
            </div>
            <div class="modal-footer">
           
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>



<div class="d-sm-flex align-items-center justify-content-between mb-4  ">
<h1 class="h3 mb-0 text-gray-800">Thông báo</h1>

</div>
<div class="col">
<span class="badge rounded-pill text-bg-danger mb-3"> <a href="/view/user/layout-user.php" class="text-decoration-none text-light"> Trang chủ </a></span>
<span class="badge rounded-pill text-bg-light mb-3"> <strong> <i class="bi bi-caret-right-fill"></i> </strong> </span>
<span class="badge rounded-pill text-bg-info mb-3">  Yêu cầu chỉnh sửa</span>
</div>


<div class="card  mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table id="yeuCauChinhSuaTable" class="table table-hover">
            <thead >
                <tr>
                    <th class="text-center">Mã yêu cầu</th>
                    <th class="text-center">Mã người yêu cầu</th>
                    <th class="text-left">Họ tên</th>
                    <th class="text-left">Tiêu đề</th>
                    <th class="text-left">Thời gian tạo</th>
                </tr>
            </thead>
            <tbody>

            </tbody>

            </table>
        </div>
    </div>
</div>


<script src="../js/datatables/datatables-danhsachyeucau.js"></script>

';



require_once __DIR__ . '/../Helper/ConfigHelper.php';
include VIEW_PATH . 'admin/layout-admin.php';

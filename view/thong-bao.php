<?php

$content = '

<div class="modal fade" id="ThongBaoModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="ThongBaoLabel">Thông báo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form class="was-validated" id="ThongBaoForm">
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
            <button type="submit" class="btn btn-primary" form="ThongBaoForm">Gửi đi</button>
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
<span class="badge rounded-pill text-bg-info mb-3">  Gửi thông báo</span>
</div>



    
<div class="card mb-4">
<div class="d-grid gap-2 d-md-block mt-2">
    <button id="btnThongBao"  style="background-color: #712CF9" class="btn btn-outline-light float-md-end mr-2 mt-2 mb-2" type="button">Nhập thông báo</button>
</div>
    <div class="card-body">
    <div class="table-responsive">
    <table id="giangVienThongBaoTable" class="table">
      
        <tbody>
        
        </tbody>
    </table>

</div>
    </div>
</div>

<script src="../js/datatables/datatable-thongbao.js"></script>

';

require_once __DIR__ . '/../Helper/ConfigHelper.php';
include VIEW_PATH . 'admin/layout-admin.php';

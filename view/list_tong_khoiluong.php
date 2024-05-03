<?php


$content = '
<div class="d-sm-flex align-items-center justify-content-between mb-4  ">
    <h1 class="h3 mb-0 text-gray-800">Khối lượng giảng dạy</h1>
    
</div>
<div class="col">
<span class="badge rounded-pill text-bg-danger mb-3"> <a href="/view/user/layout-user.php" class="text-decoration-none text-light"> Trang chủ </a></span>
<span class="badge rounded-pill text-bg-light mb-3"> <strong> <i class="bi bi-caret-right-fill"></i> </strong> </span>
<span class="badge rounded-pill text-bg-info mb-3">  Tổng khối lượng </span>
</div>


<div class="card  mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table id="tongKhoiLuongTable" class="table">
            <thead >
                <tr>
                    <th class="text-left">Học kì</th>
                    <th  class="text-left">Giảng viên</th>
                    <th class="text-center">Tổng số tiết</th>
                    <th class="text-center">Tổng môn học</th>
                    <th class="text-center">Tổng số lớp</th>
                    <th class="text-center">Tổng số sinh viên</th>
                    <th class="text-center">Tổng số đồ án</th>
                    <th class="text-center">Trạng thái</th>
                </tr>
            </thead>
            <tbody>

            </tbody>

            </table>
        </div>
    </div>
</div>


<script src="../js/datatables/datatables-tongkhongluong.js"></script>


';

require_once __DIR__ . '/../Helper/ConfigHelper.php';
include VIEW_PATH . 'admin/layout-admin.php';

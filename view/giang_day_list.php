<?php


$content = '
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> Danh sách giảng viên</h6>
    </div>
    <div class="card-body">
<table id="myTable" class="table table-striped">
    <thead>
        <tr>
            <th>Mã</th>
            <th>Tên phòng</th>
            <th>Mã môn học</th>
            <th>Mã lớp học</th>
            <th>Mã giảng viên</th>
            <th>Ngày bắt đầu</th>
        </tr>
    </thead>
    <tbody>';

if (isset($data)) {
    foreach ($data as $item) {
        $content .= '
        <tr>
            <td>' . $item['ma_lichday'] . '</td>
            <td>' . $item['ten_phong'] . '</td>
            <td>' . $item['ma_monhoc'] . '</td>
            <td>' . $item['ma_lophoc'] . '</td>
            <td>' . $item['ma_gv'] . '</td>
            <td>' . $item['ngay_batdau'] . '</td>
        </tr>';
    }
} else {
    $content .= '
    <tr>
        <td colspan="6">Không có dữ liệu</td>
    </tr>';
}

$content .= '
    </tbody>
</table>
</div>
</div>
';

// Include file layout-admin.php
include '../view/admin/layout-admin.php';

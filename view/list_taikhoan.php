<?php

require_once __DIR__ . '/../DB/DBConnect.php';
require_once __DIR__ . '/../model/User.php';

$conn = (new DBConnect())->getConnection();
$user = new User($conn);
$table = "tai_khoan";
$columns = "*";
$users = $user->selectUser($table, $columns);

// $condition = "role = 'user'";
// $users = $user->selectUser($table, $columns, $condition);

$content = '
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tài khoản</h1>
    
</div>
<div class="col">
<span class="badge rounded-pill text-bg-danger mb-3"> <a href="/view/admin/layout-admin.php" class="text-decoration-none text-light"> Trang chủ </a></span>
<span class="badge rounded-pill text-bg-light mb-3"> <strong> <i class="bi bi-caret-right-fill"></i> </strong> </span>
<span class="badge rounded-pill text-bg-info mb-3"> Quản lý tài khoản </span>
</div>


<div class="card  mb-4">

<div class="card-body">
<div class="d-grid gap-2 d-md-block mb-2">
<a class="btn btn-primary" href="them_taikhoan.php" role="button">Thêm tài khoản</a>
   
</div>
<div class="table-responsive">
<table class="table" id="taiKhoanTable">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên tài khoản</th>
            <th scope="col">Mật khẩu</th>
            <th scope="col"></th>
            <th scope="col">Quyền</th>
            <th scope="col">Hoạt động</th>
            <th scope="col">Hành động</th>
        </tr>
    </thead>
    <tbody>';
foreach ($users as $key) {
    $content .= '<tr>
                    <th scope="row">' . $key['id'] . '</th>
                    <td>' . $key['username'] . '</td>
                    <td class="password-cell" data-password="' . $key['password'] . '">' . str_repeat("*", strlen($key['password'])) . '</td>
                    <td><i class="fa fa-eye show-password m-2" style="cursor: pointer;"></i></td>
                    <td>' . ($key['role'] == 'admin' ? '<i class="fas fa-user-shield" style="color: blue;"></i> Admin' : '<i class="fas fa-user" style="color: orange;"></i> User') . '</td>
                    <td>' . ($key['is_active'] == 1 ? '<i class="fas fa-check-circle" style="color: green;"></i> Hoạt động' : '<i class="fas fa-times-circle" style="color: red;"></i> Không hoạt động') . '</td>
                    <td>
                        <a class="btn btn-outline-light" style="background-color: #712CF9" href="../view/sua_taikhoan.php?id=' . $key['id'] . '" role="button">Sửa</a>
                        <a class="btn btn-danger" href="../controller/UserController.php?action=delete&id=' . $key['id'] . '" role="button">Xóa</a>
                    </td>
                </tr>';
}
$content .= '</tbody>
</table>
</div>

</div>
</div>
<script src="../js/openpassword.js"></script>';


include '../view/admin/layout-admin.php';

<?php

require_once __DIR__ . '/../DB/DBConnect.php';
require_once __DIR__ . '/../model/User.php';
$conn = (new DBConnect())->getConnection();
$user = new User($conn);
$id = $_GET['id'];
$table = "tai_khoan";
$columns = "*";
$condition = "id = ?";
$user = $user->selectUserID($table, $columns, $condition, [$id]);


$content = '
<link rel="stylesheet" href="../../css/them_sua.css">
<a href="../view/list_taikhoan.php" class="btn btn-secondary"
style="position: relative; top: 0px; float: right; margin-left: 10px;">Trở lại</a>
<div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cập nhật tài khoản</h1>
    
</div>
</div>
    <div id="password-form">
        <form action="../controller/UserController.php?action=update" method="post">
            <label for="username">Nhập tài khoản</label>
            <input type="hidden" name="id" value="' . $user['id'] . '">
            <input type="text" name="username" id="username" value="' . $user['username'] . '">
            <p class="error-p">';
if (isset($_SESSION["error_username"])) {
    $content .= $_SESSION["error_username"];
    unset($_SESSION["error_username"]);
}
$content .= '</p><br>
            <label for="password">Nhập mật khẩu</label>
            <input type="password" name="password" id="password" value="' . $user['password'] . '">
            <p class="error-p">';
if (isset($_SESSION["error_password"])) {
    $content .= $_SESSION["error_password"];
    unset($_SESSION["error_password"]);
}

$sqlCountAdmin = "SELECT COUNT(*) as admin_count FROM $table WHERE role = 'admin'";
$stmtCountAdmin = $conn->prepare($sqlCountAdmin);
$stmtCountAdmin->execute();
$adminCount = $stmtCountAdmin->fetchColumn();

$content .= '</p><br>';
if ($adminCount == 1 && $user['role'] == 'admin') {
    $content .= '<label for="role">Chọn quyền</label>
    <select name="role" id="role" disabled>
        <option value="admin" ' . ($user['role'] == 'admin' ? 'selected' : '') . '>Admin</option>
        <option value="user" ' . ($user['role'] == 'user' ? 'selected' : '') . '>User</option>
    </select>
    <p class="error-p">Không thể sửa tài khoản admin cuối cùng.</p>';
} else {
    $content .= '<label for="role">Chọn quyền</label>
    <select name="role" id="role">
        <option value="admin" ' . ($user['role'] == 'admin' ? 'selected' : '') . '>Admin</option>
        <option value="user" ' . ($user['role'] == 'user' ? 'selected' : '') . '>User</option>
    </select>';
}

$content .= ' <br>
            <label for="">Trạng thái hoạt động</label>
            <select name="status" id="status">
                <option value="1" ' . ($user['is_active'] == 1 ? 'selected' : '') . '>Hoạt động</option>
                <option value="0" ' . ($user['is_active'] == 0 ? 'selected' : '') . '>Không hoạt động</option>
            </select><br>
            <input type="hidden" name="giangvien" value="' . $user['ma_gv'] . '">
            <label for="giangvien">Giảng viên</label>
            <select name="giangvien_disabled" id="giangvien">';
$conn = (new DBConnect())->getConnection();
$userModel = new User($conn);
$teacherID = $user['ma_gv'];
$teachers = $userModel->getTeacherNoUserUpdate1($teacherID);
foreach ($teachers as $teacher) {
    $selected = ($teacher['ma_gv'] == $user['ma_gv']) ? "selected" : "";
    $content .= '<option value="' . $teacher['ma_gv'] . '" ' . $selected . '>' . $teacher['ho_lot_gv'] . ' ' . $teacher['ten_gv'] . '</option>';
}
$content .= '<option value="" ' . (empty($user['ma_gv']) ? 'selected' : "") . '>Giảng viên chưa xác định</option>
            </select><br>
            <button type="submit" name="submit" class="btn btn-primary" id="loginButton">Cập nhật</button>
        </form>
    </div>

    <script src="../js/login.js"></script>

    <script>
window.onload = function() {
    var roleSelect = document.getElementById(\'role\');
    var statusSelect = document.getElementById(\'status\');

    // Function to toggle the disabled attribute of the status select
    function toggleStatusSelect() {
        if (roleSelect.value === \'admin\') {
            statusSelect.disabled = true;
        } else {
            statusSelect.disabled = false;
        }
    }

    // Call the function initially to set the initial state
    toggleStatusSelect();

    // Add onchange event listener to the role select
    roleSelect.onchange = function() {
        toggleStatusSelect(); // Toggle status select based on role change
    };
};
</script>
';
require_once __DIR__ . '/../Helper/ConfigHelper.php';
include VIEW_PATH . 'admin/layout-admin.php';

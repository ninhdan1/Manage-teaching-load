<?php
require_once "../DB/DBConnect.php";
require_once "../model/User.php";
session_start();
class UserController
{
  private $model;
  private $conn;
  public function __construct()
  {
    $this->conn = (new DBConnect())->getConnection();
    $this->model = new User($this->conn);
  }
  public function login()
  {
    $this->checkLoginInfo();
    $this->getUser();
  }

  //Kiem tra TK va MK
  private function checkLoginInfo()
  {
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    if ($username == "") {
      $_SESSION["thongbao"] = "Tài khoản hoặc mật khẩu không đúng";
      header("Location: ../index.php");
      exit();
    }
    if ($password == "") {
      $_SESSION["thongbao"] = "Tài khoản hoặc mật khẩu không đúng";
      header("Location: ../index.php");
      exit();
    }
    if (strlen($username) < 10  && strlen($username) > 15) {
      $_SESSION["thongbao"] = "Tài khoản hoặc mật khẩu không đúng";
      header("Location: ../index.php");
      exit();
    }
    if (strlen($password) >= 10  && strlen($password) <= 15) {
      if (preg_match('/[A-Z]/', $password) && preg_match('/[^\w]/', $password)) {
        return true;
      } else {
        $_SESSION["thongbao"] = "Tài khoản hoặc mật khẩu không đúng";
        header("Location: ../index.php");
        exit();
      }
    } else {
      $_SESSION["thongbao"] = "Tài khoản hoặc mật khẩu không đúng";
      header("Location: ../index.php");
      exit();
    }
  }

  //Lay thong tin user
  private function getUser()
  {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = md5($password);
    $user = $this->model->selectUserID('tai_khoan', '*', 'username = ? AND password = ?', [$username, $password]);
    if ($user) {
      if ($user['is_active'] == 0) {
        $_SESSION["thongbao"] = "Tài khoản đã bị khóa";
        header("Location: ../view/login.php");
        exit();
      }

      if ($user['role'] == 'admin') {
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['login'] = true;
        header("Location: ../view/admin/list_taikhoan.php");
        exit();
      } elseif ($user['role'] == 'user') {
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['login'] = true;
        header("Location: ../view/user/layout-user.php");
        exit();
      }
    } else {
      $_SESSION['thongbao'] = 'Tài khoản hoặc mật khẩu không đúng';
      header("Location: ../view/login.php");
      exit();
    }
  }
  public function changePassword()
  {
    $id = $_POST['id'];
    $newPassword = $_POST['newPassword'];
    $oldPassword = $_POST['oldPassword'];
    $re_new_password = $_POST['re_new_password'];

    if ($newPassword == "" || $oldPassword == "" || $re_new_password == "") {
      $message = "Vui lòng nhập đầy đủ thông tin";
    } elseif (strlen($oldPassword) < 10 || strlen($oldPassword) > 30) {
      $message = "Mật khẩu cũ không đúng";
    } elseif (strlen($newPassword) < 10 || strlen($newPassword) > 30) {
      $message = "Mật khẩu mới không đúng";
    } elseif (strlen($re_new_password) < 10 || strlen($re_new_password) > 30) {
      $message = "Mật khẩu nhập lại không đúng";
    } elseif (!preg_match('/[A-Z]/', $newPassword) || !preg_match('/[^\w]/', $newPassword)) {
      $message = "Mật khẩu mới phải có ít nhất một chữ hoa và một ký tự đặc biệt";
    } elseif ($newPassword == $oldPassword) {
      $message = "Mật khẩu mới không được trùng với mật khẩu cũ";
    } elseif ($newPassword != $re_new_password) {
      $message = "Mật khẩu nhập lại không đúng";
    }
    if (isset($message)) {
      $_SESSION["thongbao"] = $message;
      header("Location: ../view/change-password.php");
      exit();
    } else {
      $table = 'tai_khoan';
      $data = [
        'password' => md5($newPassword),
      ];
      $condition = 'id = ?';
      $result = $this->model->update($table, $data, $condition, $id);
      if ($result) {
        header("Location: ../../index.php");
        exit();
      } else {
        $_SESSION["thongbao"] = "Mật khẩu cũ không đúng";
        header("Location: ../view/change-password.php");
        exit();
      }
    }
  }
  public function delete()
  {
    $id = $_GET['id'];
    $table = 'tai_khoan';
    $condition = 'id = ?';
    $result = $this->model->deleteUser($table, $condition, [$id]);
    if ($result) {
      header("Location: /view/list_taikhoan.php");
      exit();
    } else {
      $_SESSION["thongbao"] = "Xóa không thành công";
      header("Location: /view/admin/list_taikhoan.php");
      exit();
    }
  }
  public function insert()
  {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = $this->xoaKhoangTrang($username);
    $password = $this->xoaKhoangTrang($password);
    $this->kiemTraTaiKhoanTrung("../view/them_taikhoan.php");
    $role = $_POST['role'];
    $status = $_POST['status'];
    $ma_gv = ($_POST['giangvien'] !== "") ? $_POST['giangvien'] : null;

    $data = [
      'username' => $username,
      'password' => md5($password),
      'role' => $role,
      'is_active' => $status,
      'ma_gv' => $ma_gv
    ];
    $table = 'tai_khoan';
    $result = $this->model->insertUser($table, $data);
    if ($result) {
      header("Location: /view/list_taikhoan.php");
      exit();
    } else {
      header("Location: /view/them_taikhoan.php");
      exit();
    }
  }
  public function checkInsert()
  {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (isset($_POST['submit'])) {
      if (empty($_POST['username'])) {
        $_SESSION["error_username"] = "Vui lòng nhập tài khoản";
        header("Location: ../view/them_taikhoan.php");
        exit();
      }
      if (strlen($username) < 10 || strlen($username) > 15) {
        $_SESSION["error_username"] = "Tài khoản phải có từ 10 đến 15 ký tự";
        header("Location: ../view/them_taikhoan.php");
        exit();
      }

      if (empty($_POST['password'])) {
        $_SESSION["error_password"] = "Vui lòng nhập mật khẩu";
        header("Location: ../view/them_taikhoan.php");
        exit();
      }
      if (strlen($password) < 10 || strlen($password) > 15) {
        $_SESSION["error_password"] = "Mật khẩu phải có từ 10 đến 15 ký tự";
        header("Location: ../view/them_taikhoan.php");
        exit();
      }

      if (!preg_match('/[A-Z]/', $password) || !preg_match('/[^\w]/', $password)) {
        $_SESSION["error_password"] = "Mật khẩu phải chứa ít nhất một chữ hoa và một ký tự đặc biệt";
        header("Location: ../view/them_taikhoan.php");
        exit();
      }
    }
  }
  public function update()
  {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = $this->xoaKhoangTrang($username);
    $password = $this->xoaKhoangTrang($password);
    $table = 'tai_khoan';
    $condition = 'id = ?';
    $this->kiemTraTaiKhoanTrung("../view/sua_taikhoan.php?id=" . $id);
    $user_check = $this->model->selectUserID($table, '*', $condition, [$id]);
    if ($user_check['password'] == $password) {
      $role = $_POST['role'];
      $status = $_POST['status'];
      $ma_gv = isset($_POST['giangvien_disabled']) ? $_POST['giangvien_disabled'] : null;
      if (empty($ma_gv)) {
        $ma_gv = null;
      }

      $table = 'tai_khoan';
      $condition = 'id = ?';
      $password = $password;
      $data = [
        'username' => $username,
        'password' => $password,
        'role' => $role,
        'is_active' => $status,
        'ma_gv' => $ma_gv
      ];
      $result = $this->model->update($table, $data, $condition, $id);
      if ($result) {
        header("Location: /view/list_taikhoan.php");
        exit();
      } else {
        header("Location: /view/list_taikhoan.php");
        exit();
      }
    } else {
      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        if (empty($_POST['password'])) {
          $_SESSION["error_password"] = "Vui lòng nhập mật khẩu";
          header("Location: ../view/sua_taikhoan.php?id=" . $id);
          exit();
        }
        if (strlen($password) < 10 || strlen($password) > 15) {
          $_SESSION["error_password"] = "Mật khẩu phải có từ 10 đến 15 ký tự";
          header("Location: ../view/sua_taikhoan.php?id=" . $id);
          exit();
        }
        if (!preg_match('/[A-Z]/', $password) || !preg_match('/[^\w]/', $password)) {
          $_SESSION["error_password"] = "Mật khẩu phải chứa ít nhất một chữ hoa và một ký tự đặc biệt";
          header("Location: ../view/sua_taikhoan.php?id=" . $id);
          exit();
        }
      }
      $role = $_POST['role'];
      $status = $_POST['status'];

      $ma_gv = isset($_POST['giangvien_disabled']) ? $_POST['giangvien_disabled'] : null;
      if (empty($ma_gv)) {
        $ma_gv = null;
      }

      $table = 'tai_khoan';
      $condition = 'id = ?';
      $password = md5($password);
      $data = [
        'username' => $username,
        'password' => $password,
        'role' => $role,
        'is_active' => $status,
        'ma_gv' => $ma_gv
      ];
      $result = $this->model->update($table, $data, $condition, $id);
      if ($result) {
        header("Location: /view/list_taikhoan.php");
        exit();
      } else {
        header("Location: /view/list_taikhoan.php");
        exit();
      }
    }
  }
  public function checkUpdate()
  {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id = $_POST['id'];
    if (isset($_POST['submit'])) {
      if (empty($_POST['username'])) {
        $_SESSION["error_username"] = "Vui lòng nhập tài khoản";
        header("Location: ../view/list_taikhoan.php?id=" . $id);
        exit();
      }
      if (strlen($username) < 10 || strlen($username) > 15) {
        $_SESSION["error_username"] = "Tài khoản phải có từ 10 đến 15 ký tự";
        header("Location: ../view/list_taikhoan.php?id=" . $id);
        exit();
      }
    }
  }
  public function kiemTraTaiKhoanTrung($redirectUrl)
  {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $username = $_POST['username'];
    $username = $this->xoaKhoangTrang($username);
    $checkUser = $this->model->selectUserID('tai_khoan', '*', 'username = ? AND id != ?', [$username, $id]);
    if ($checkUser) {
      $_SESSION["error_username"] = " Tài khoản đã được đăng ký";
      header("Location: " . $redirectUrl);
      exit();
    }
  }
  public function xoaKhoangTrang($str)
  {
    $str = trim($str);
    $str = preg_replace('/\s+/', '', trim($str));
    return $str;
  }
}
$userController = new UserController();
$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
  case 'login':
    $userController->login();
    break;
  case 'changePassword':
    $userController->changePassword();
    break;
  case 'delete':
    $userController->delete();
    break;
  case 'insert':
    $userController->checkInsert();
    $userController->insert();
    break;
  case 'update':
    $userController->checkUpdate();
    $userController->update();
    break;
}

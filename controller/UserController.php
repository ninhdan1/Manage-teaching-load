<?php
require_once "../DB/DBConnect.php";
require_once "../model/User.php";
session_start();
class UserController
{
  public function login()
  {
    $this->checkLoginInfo();
    $user = $this->getUser();
    $this->roleUser($user);
  }

  //Kiem tra TK va MK
  private function checkLoginInfo()
  {
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    if ($username == "") {
      $_SESSION["thongbao"] = "Tài khoản và mật khẩu không đúng";
      header("Location: ../index.php");
      exit();
    }
    if ($password == "") {
      $_SESSION["thongbao"] = "Tài khoản và mật khẩu không đúng";
      header("Location: ../index.php");
      exit();
    }
    if (strlen($username) <= 10  || strlen($username) >= 15) {
      $_SESSION["thongbao"] = "Tài khoản và mật khẩu không đúng";
      header("Location: ../index.php");
      exit();
    }
    if (strlen($password) >= 10  && strlen($password) <= 15) {
      if (preg_match('/[A-Z]/', $password) && preg_match('/[^\w]/', $password)) {
        return true;
      } else {
        $_SESSION["thongbao"] = "Tài khoản và mật khẩu không đúng";
        header("Location: ../index.php");
        exit();
      }
    } else {
      $_SESSION["thongbao"] = "Tài khoản và mật khẩu không đúng";
      header("Location: ../index.php");
      exit();
    }
  }

  //Lay thong tin user
  private function getUser()
  {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = new User((new DBConnect())->getConnection());
    return $user->getUser($username, $password);
  }

  //Chuyen trang theo role
  private function roleUser($user)
  {
    if ($user && $user['role'] == 'admin') {
      $_SESSION['id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['login'] = true;
      header("Location: ../view/admin/layout-admin.php");
      exit();
    } elseif ($user && $user['role'] == 'user') {
      $_SESSION['id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['login'] = true;
      header("Location: ../view/user/layout-user.php");
      exit();
    } else {
      $_SESSION['thongbao'] = 'Tài khoản hoặc mật khẩu không đúng';
      header("Location: ../view/login.php");
    }
  }
  public function changePassword()
  {
    $username = $_POST['username'];
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
      header("Location: /view/admin/change-password.php");
      exit();
    } else {
      $user = new User((new DBConnect())->getConnection());
      $result = $user->changePasswordModel($username, $newPassword, $oldPassword);
      if ($result) {
        header("Location: ../../index.php");
        exit();
      } else {
        $_SESSION["thongbao"] = "Mật khẩu cũ không đúng";
        header("Location: /view/admin/change-password.php");
        exit();
      }
    }
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
}

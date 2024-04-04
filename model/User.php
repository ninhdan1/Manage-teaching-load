<?php
require_once "../DB/DBConnect.php";
class User
{
  private $conn;
  public function __construct($conn) {
    $this->conn = $conn;
  }
  public function getUser($user, $pass)
  {
    $stmt = $this->conn->prepare("SELECT * FROM tai_khoan WHERE username = :user");
    $stmt->execute(array('user' => $user));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user && md5($pass) == $user['password'])
    {
     return $user;
    }
    return false;
  }
  public function changePasswordModel($username,$newPassword,$oldPassword){
    $stmt = $this->conn->prepare("SELECT * FROM tai_khoan WHERE username = :user");
    $stmt->execute(array('user' => $username));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user && md5($oldPassword) == $user['password'])
    {
      $stmt = $this->conn->prepare("UPDATE tai_khoan SET password = :newPassword WHERE username = :user");
      $stmt->execute(array('newPassword' => md5($newPassword), 'user' => $username));
      return true;
    }
    return false;
  }
}

// $dbConnect = new DBConnect();
// $user = new User($dbConnect->getConnection());
// $user->getUser('trong_phat@gmail.com', '123456789');
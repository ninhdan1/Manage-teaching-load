<?php 
require_once '../DB/DBConnect.php';
class GiangVien
{
  private $conn;
  public function __construct($conn)
  {
    $this->conn = $conn;
  }
  public function getDSGV_model(){
    $stmt = $this->conn->prepare("SELECT * FROM giang_vien");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
?>
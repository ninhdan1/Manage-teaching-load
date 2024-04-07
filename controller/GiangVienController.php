<?php
require_once '../model/GiangVien.php'; 
class GiangVienController{
  private $teacherModel;
  public function getDSGV(){
    $gv = new GiangVien((new DBConnect())->getConnection());
    return $gv->getDSGV_model();
  }
}
?>
$gv = new GiangVienController();
$gv->getDSGV();
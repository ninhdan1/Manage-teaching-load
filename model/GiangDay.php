<?php

require_once __DIR__ . '/../Helper/ConfigHelper.php';

require_once MODEL_PATH . 'SQLQueries.php';


class GiangDay
{
  private $conn;

  public function __construct($conn)
  {
    $this->conn = $conn;
  }

  public function getDSGD_Model()
  {
    $query = "SELECT lop_monhoc.*, giang_vien.ho_lot_gv, giang_vien.ten_gv, hoc_ky.ten_hocky, hoc_ky.nam_hoc, mon_hoc.ten_monhoc
              FROM lop_monhoc 
              INNER JOIN giang_vien ON lop_monhoc.ma_gv = giang_vien.ma_gv 
              INNER JOIN hoc_ky ON lop_monhoc.ma_hk = hoc_ky.ma_hocky 
              INNER JOIN mon_hoc ON lop_monhoc.ma_monhoc = mon_hoc.ma_monhoc";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function getDetailByID($id)
  {
    $query = "SELECT lop_monhoc.*, giang_vien.ho_lot_gv, giang_vien.ten_gv, hoc_ky.ten_hocky, hoc_ky.nam_hoc, mon_hoc.ten_monhoc
              FROM lop_monhoc 
              INNER JOIN giang_vien ON lop_monhoc.ma_gv = giang_vien.ma_gv 
              INNER JOIN hoc_ky ON lop_monhoc.ma_hk = hoc_ky.ma_hocky 
              INNER JOIN mon_hoc ON lop_monhoc.ma_monhoc = mon_hoc.ma_monhoc
              WHERE lop_monhoc.id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  public function updateSiSoByID($id, $siSo)
  {
    try {
      // Thực hiện câu lệnh SQL cập nhật
      $sql = "UPDATE lop_monhoc SET si_solop = ? WHERE id = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([$siSo, $id]);
      return $stmt->rowCount();
    } catch (PDOException $e) {
      // Ghi log hoặc xử lý lỗi ở đây
      echo "Lỗi cơ sở dữ liệu: " . $e->getMessage();
      return false; // Trả về false để thông báo lỗi cho controller
    }
  }
}

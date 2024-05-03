<?php

require_once __DIR__ . '/../Helper/ConfigHelper.php';

require_once MODEL_PATH . 'SQLQueries.php';

class Dashboard
{
    private $conn;
    private $SQLQueries;
    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->SQLQueries = new SQLQueries($this->conn);
    }

    public function countGiangVien()
    {
        $query = "SELECT COUNT(*) as count FROM giang_vien";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function countMonHoc()
    {
        $query = "SELECT COUNT(*) as count FROM mon_hoc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function countLopHoc()
    {
        $query = "SELECT COUNT(*) as count FROM lop";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function countSinhVien()
    {
        $query = "SELECT SUM(si_so) as count FROM lop";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function countHocKy()
    {
        $query = "SELECT COUNT(*) as count FROM hoc_ky";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function countTaiKhoan()
    {
        $query = "SELECT COUNT(*) as count FROM tai_khoan";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function listThongKeMoiNhat()
    {
        $query = "SELECT kg.*, gv.ten_gv AS ten_giang_vien, gv.ho_lot_gv AS ho_giang_vien , hk.ten_hocky AS ten_hoc_ky, hk.nam_hoc AS nam_hoc
                  FROM khoiluong_giangday kg
                  JOIN giang_vien gv ON kg.ma_gv = gv.ma_gv
                  JOIN hoc_ky hk ON kg.ma_hocky = hk.ma_hocky
                  WHERE kg.ma_hocky = (SELECT MAX(ma_hocky) FROM khoiluong_giangday)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function countXacNhan()
    {
        $query = "SELECT COUNT(*) as count FROM khoiluong_giangday WHERE xac_nhan = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function countYeuCauChinhSua()
    {
        $query = "SELECT COUNT(*) as count FROM bao_cao";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

  
}

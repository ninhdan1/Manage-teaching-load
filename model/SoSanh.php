<?php

require_once __DIR__ . '/../Helper/ConfigHelper.php';
require_once MODEL_PATH . 'SQLQueries.php';

class SoSanh
{
    private $conn;
    private $SQLQueries;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->SQLQueries = new SQLQueries($this->conn);
    }

    public function getListHocKyByGiangVien($maGiangVien)
    {
        $sql = "SELECT * FROM hoc_ky WHERE ma_hocky IN (SELECT ma_hocky FROM khoiluong_giangday WHERE ma_gv = ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$maGiangVien]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getDetailTongKhoiLuongGiangDayByHocKy($maHocKy, $maGiangVien)
    {
        return $this->SQLQueries->selectData('khoiluong_giangday', '*', 'ma_hocky = ? AND ma_gv = ?', [$maHocKy, $maGiangVien]);
    }

    public function getListHocKyBy2GiangVien($maGiangVien1, $maGiangVien2)
    {
        // $sql = "SELECT * FROM hoc_ky WHERE ma_hocky IN (SELECT ma_hocky FROM khoiluong_giangday WHERE ma_gv = ?) AND ma_hocky IN (SELECT ma_hocky FROM khoiluong_giangday WHERE ma_gv = ?)";
        $sql = "SELECT * FROM hoc_ky 
        WHERE ma_hocky IN (
            SELECT khg1.ma_hocky 
            FROM khoiluong_giangday khg1 
            JOIN khoiluong_giangday khg2 
            ON khg1.ma_hocky = khg2.ma_hocky 
            WHERE khg1.ma_gv = ? AND khg2.ma_gv = ?
        )";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$maGiangVien1, $maGiangVien2]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getListGiangVienNoExist($maGiangVien)
    {
        $sql = "SELECT * FROM giang_vien WHERE ma_gv != ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$maGiangVien]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getTongKhoiLuongMaHocKyMax($maGiangVien)
    {
        $sql = "SELECT * FROM khoiluong_giangday WHERE ma_gv = ? ORDER BY ma_hocky DESC LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$maGiangVien]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateXacNhanKhoiLuong($maGiangVien, $maHocKy, $xacNhan)
    {
        // Kiểm tra xác nhận hiện tại của bản ghi
        $sqlSelect = "SELECT xac_nhan FROM khoiluong_giangday WHERE ma_gv = ? AND ma_hocky = ?";
        $stmtSelect = $this->conn->prepare($sqlSelect);
        $stmtSelect->execute([$maGiangVien, $maHocKy]);
        $currentXacNhan = $stmtSelect->fetchColumn();

        // Nếu xác nhận hiện tại là 0, thì mới cho phép cập nhật
        if ($currentXacNhan == 0) {
            // Thực hiện câu lệnh UPDATE
            $sqlUpdate = "UPDATE khoiluong_giangday SET xac_nhan = ? WHERE ma_gv = ? AND ma_hocky = ?";
            $stmtUpdate = $this->conn->prepare($sqlUpdate);
            $stmtUpdate->execute([$xacNhan, $maGiangVien, $maHocKy]);
            // Trả về số bản ghi được cập nhật
            return $stmtUpdate->rowCount();
        } else {
            // Nếu xác nhận hiện tại không phải là 0, không cho phép cập nhật
            return 0;
        }
    }

    public function getListTongKhoiLuongGiangDay()
    {
        $sql = "SELECT kg.*, gv.*, hk.* FROM khoiluong_giangday kg 
                INNER JOIN giang_vien gv ON kg.ma_gv = gv.ma_gv
                INNER JOIN hoc_ky hk ON kg.ma_hocky = hk.ma_hocky";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}

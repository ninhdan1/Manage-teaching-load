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
}

<?php

require_once __DIR__ . '/../Helper/ConfigHelper.php';
require_once MODEL_PATH . 'SoSanh.php';
require_once HELPER_PATH . 'ResponseHelper.php';
require_once DB_PATH . 'DBConnect.php';

class SoSanhController
{
    private $conn;
    private $SoSanh;
    private $ResponseHelper;

    public function __construct()
    {
        $this->conn = (new DBConnect())->getConnection();
        $this->SoSanh = new SoSanh($this->conn);
        $this->ResponseHelper = new ResponseHelper();
    }

    public function getListHocKyByGiangVien($maGiangVien)
    {
        $result = $this->SoSanh->getListHocKyByGiangVien($maGiangVien);
        return $this->ResponseHelper->response(true, 'Lấy danh sách học kỳ thành công', $result);
    }

    public function getDetailTongKhoiLuongGiangDayByHocKy($maHocKy, $maGiangVien)
    {
        $result = $this->SoSanh->getDetailTongKhoiLuongGiangDayByHocKy($maHocKy, $maGiangVien);
        return $this->ResponseHelper->response(true, 'Lấy thông tin khối lượng giảng dạy thành công', $result);
    }


    public function getListHocKyBy2GiangVien($maGiangVien1, $maGiangVien2)
    {
        $result = $this->SoSanh->getListHocKyBy2GiangVien($maGiangVien1, $maGiangVien2);
        return $this->ResponseHelper->response(true, 'Lấy danh sách học kỳ thành công', $result);
    }
}

if (isset($_GET['action'])) {
    $action = $_GET['action'] ?? null;
    $controller = new SoSanhController();

    switch ($action) {
        case 'getListHocKyByGiangVien':

            $maGiangVien = $_GET['ma_gv'] ?? null;

            $controller->getListHocKyByGiangVien($maGiangVien);
            break;
        case 'getDetailTongKhoiLuongGiangDayByHocKy':
            $maHocKy = $_GET['ma_hocky'] ?? null;
            $maGiangVien = $_GET['ma_gv'] ?? null;

            $controller->getDetailTongKhoiLuongGiangDayByHocKy($maHocKy, $maGiangVien);
            break;
        case 'getListHocKyBy2GiangVien':
            $maGiangVien1 = $_GET['ma_gv1'] ?? null;
            $maGiangVien2 = $_GET['ma_gv2'] ?? null;

            $controller->getListHocKyBy2GiangVien($maGiangVien1, $maGiangVien2);
            break;
        default:
            echo "Action không tồn tại!";
            break;
    }
}

<?php

require_once __DIR__ . '/../Helper/ConfigHelper.php';

require_once MODEL_PATH . 'ThongKe.php';
require_once DB_PATH . 'DBConnect.php';
require_once  HELPER_PATH . 'ResponseHelper.php';



class ThongKeController
{
    private $conn;
    private $ThongKe;
    private $responseHelper;

    public function __construct()
    {
        $this->conn = (new DBConnect())->getConnection();
        $this->ThongKe = new ThongKe($this->conn);
        $this->responseHelper = new ResponseHelper();
    }

    public function getListGiangDayByHocKyAndLoaiMonHoc($maHocKy, $loaiMonHoc)
    {

        $data = $this->ThongKe->getListGiangDayByHocKy($maHocKy, $loaiMonHoc);

        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $data);
    }

    public function getListHocKy()
    {
        $data = $this->ThongKe->getListHocKy();

        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $data);
    }
}

if (isset($_GET['action'])) {
    $action = $_GET['action'] ?? null;
    $tk = new ThongKeController();

    switch ($action) {
        case 'getListGiangDayByHocKyAndLoaiMonHoc':
            $maHocKy = $_GET['maHocKy'] ?? null;
            $loaiMonHoc = $_GET['loaiMonHoc'] ?? null;
            $tk->getListGiangDayByHocKyAndLoaiMonHoc($maHocKy, $loaiMonHoc);
            break;
        case 'getListHocKy':
            $tk->getListHocKy();
            break;
        default:
            echo "Action không tồn tại!";
            break;
    }
}

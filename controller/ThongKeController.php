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

    public function getListGiangDayByHocKyAndLoaiMonHoc($maHocKy, $loaiMonHoc, $maMonHoc, $maGiangVien)
    {

        $data = $this->ThongKe->getListGiangDayByHocKy($maHocKy, $loaiMonHoc, $maMonHoc, $maGiangVien);

        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $data);
    }

    public function getListHocKy()
    {
        $data = $this->ThongKe->getListHocKy();

        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $data);
    }

    public function getHocKyNewest()
    {
        $data = $this->ThongKe->getHocKyNewest();

        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $data);
    }

    public function getListGiangVienExistHocKy($maHocKy)
    {
        $data = $this->ThongKe->getListGiangVienExistsHocKy($maHocKy);

        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $data);
    }

    public function getListMonHocExistHocKy($maHocKy)
    {
        $data = $this->ThongKe->getListMonHocExistsHocKy($maHocKy);

        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $data);
    }

    public function getListGiangVienExistHocKyMAX()
    {
        $data = $this->ThongKe->getListGiangVienExitstHocKyMAX();

        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $data);
    }

    public function getListMonHocExitstHocKyMAX()
    {
        $data = $this->ThongKe->getListMonHocExitstHocKyMAX();

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
            $maMonHoc = $_GET['maMonHoc'] ?? null;
            $maGiangVien = $_GET['maGiangVien'] ?? null;
            $tk->getListGiangDayByHocKyAndLoaiMonHoc($maHocKy, $loaiMonHoc, $maMonHoc, $maGiangVien);
            break;
        case 'getListHocKy':
            $tk->getListHocKy();
            break;
        case 'getHocKyNewest':
            $tk->getHocKyNewest();
            break;
        case 'getListGiangVienExistHocKy':
            $maHocKy = $_GET['maHocKy'] ?? null;
            $tk->getListGiangVienExistHocKy($maHocKy);
            break;
        case 'getListMonHocExistHocKy':
            $maHocKy = $_GET['maHocKy'] ?? null;
            $tk->getListMonHocExistHocKy($maHocKy);
            break;
        case 'getListGiangVienExistHocKyMAX':
            $tk->getListGiangVienExistHocKyMAX();
            break;
        case 'getListMonHocExitstHocKyMAX':
            $tk->getListMonHocExitstHocKyMAX();
            break;
        default:
            echo "Action không tồn tại!";
            break;
    }
}

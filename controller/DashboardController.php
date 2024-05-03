<?php

require_once __DIR__ . '/../helper/ConfigHelper.php';

require_once MODEL_PATH . 'Dashboard.php';
require_once DB_PATH . 'DBConnect.php';
require_once HELPER_PATH . 'ResponseHelper.php';

class DashboardController
{
    private $model;
    private $conn;
    private $responseHelper;
    public function __construct()
    {
        $this->conn = (new DBConnect())->getConnection(); // Tạo kết nối mới

        $this->model = new Dashboard($this->conn);
        $this->responseHelper = new ResponseHelper();
    }

    public function countGiangVien()
    {
        $countGiangVien = $this->model->countGiangVien();

        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $countGiangVien);
    }

    public function countLop()
    {
        $countLopHoc = $this->model->countLopHoc();

        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $countLopHoc);
    }

    public function countSinhVien()
    {
        $countSinhVien = $this->model->countSinhVien();

        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $countSinhVien);
    }


    public function countMonHoc()
    {
        $countMonHoc = $this->model->countMonHoc();

        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $countMonHoc);
    }

    public function countHocKy()
    {
        $countHocKy = $this->model->countHocKy();

        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $countHocKy);
    }

    public function countTaiKhoan()
    {
        $countTaiKhoan = $this->model->countTaiKhoan();

        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $countTaiKhoan);
    }

    public function listThongKeMoiNhat()
    {
        $data = $this->model->listThongKeMoiNhat();
        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $data);
    }

    public function countXacNhan()
    {
        $data = $this->model->countXacNhan();
        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $data);
    }

    public function countYeuCauChinhSua()
    {
        $data = $this->model->countYeuCauChinhSua();
        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $data);
    }
}

if (isset($_GET['action'])) {
    $action = $_GET['action'] ?? null;
    $controller = new DashboardController();

    switch ($action) {
        case 'countGiangVien':
            $controller->countGiangVien();
            break;
        case 'countMonHoc':
            $controller->countMonHoc();
            break;
        case 'countLop':
            $controller->countLop();
            break;
        case 'countSinhVien':
            $controller->countSinhVien();
            break;
        case 'countHocKy':
            $controller->countHocKy();
            break;
        case 'countTaiKhoan':
            $controller->countTaiKhoan();
            break;
        case 'listThongKeMoiNhat':
            $controller->listThongKeMoiNhat();
            break;
        case 'countXacNhan':
            $controller->countXacNhan();
            break;
        case 'countYeuCauChinhSua':
            $controller->countYeuCauChinhSua();
            break;
        default:
            echo "Action không tồn tại!";
            break;
    }
}

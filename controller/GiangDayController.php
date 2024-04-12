<?php

require_once  '../model/GiangDay.php';
require_once  '../DB/DBConnect.php';

class GiangDayController
{

    private $model;
    private $conn;
    public function __construct()
    {
        $this->conn = (new DBConnect())->getConnection(); // Tạo kết nối mới

        $this->model = new GiangDay($this->conn);
    }

    public function index()
    {
        $data = $this->model->getDSGD_Model();

        require_once '../view/giang_day_list.php';
    }

    public function getDetailByID($maLopMonHoc)
    {
        $detailData  = $this->model->getDetailByID($maLopMonHoc);
        if (is_array($detailData)) {
            header('Content-Type: application/json');
            echo json_encode($detailData);
        } else {
            echo "Không thể lấy dữ liệu chi tiết!";
        }
    }


    public function updateSiSo()
    {
        $maLopMonHoc = $_POST['ma_lopmonhoc'];
        $siSo = $_POST['si_solop'];

        $result = $this->model->updateSiSoByID($maLopMonHoc, $siSo);

        if ($result) {
            echo "Cập nhật thành công!";
        } else {
            echo "Cập nhật thất bại!";
        }
    }
}


// Kiểm tra xem action được gọi là gì và gọi phương thức tương ứng
if (isset($_GET['action'])) {
    $action = $_GET['action'] ?? null;
    $gd = new GiangDayController();

    switch ($action) {
        case 'index':
            $gd->index();

            break;
        case 'detail':
            $maLopMonHoc = $_GET['ma_lopmonhoc'];
            $gd->getDetailByID($maLopMonHoc);
            break;
        case 'updateSiSo':
            $gd->updateSiSo();
            break;
        default:
            echo "Hành động không hợp lệ!";
            break;
    }
} else {
    echo "Không tìm thấy hành động!";
}

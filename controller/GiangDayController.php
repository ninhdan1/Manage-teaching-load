<?php

require_once __DIR__ . '/../helper/ConfigHelper.php';

require_once MODEL_PATH . 'GiangDay.php';
require_once DB_PATH . 'DBConnect.php';


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

    public function getDetailByID($id)
    {
        $detailData  = $this->model->getDetailByID($id);
        if (is_array($detailData)) {
            header('Content-Type: application/json');
            echo json_encode($detailData);
        } else {
            echo "Không thể lấy dữ liệu chi tiết!";
        }
    }


    public function updateSiSo()
    {
        $id = $_POST['id'];
        $siSo = $_POST['si_solop'];

        $result = $this->model->updateSiSoByID($id, $siSo);

        if ($result) {
            echo "Cập nhật thành công!";
        } else {
            echo "Cập nhật thất bại!";
        }
    }
}



if (isset($_GET['action'])) {
    $action = $_GET['action'] ?? null;
    $gd = new GiangDayController();

    switch ($action) {
        case 'index':
            $gd->index();

            break;
        case 'detail':
            $id = $_GET['id'];
            $gd->getDetailByID($id);
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

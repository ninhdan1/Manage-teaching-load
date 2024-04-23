<?php
require_once '../model/GiangVien.php';
require_once '../DB/DBConnect.php';
require '../Helper/ResponseHelper.php';

class GiangVienController
{
    private $conn;
    private $model;
    private $responseHelper;

    public function __construct()
    {
        $this->conn = (new DBConnect())->getConnection();
        $this->model = new GiangVien($this->conn);
        $this->responseHelper = new ResponseHelper();
    }

    public function index()
    {
        $data = $this->model->getListGiangVien();
        if ($data == null) {
            return $this->responseHelper->Response(false, "Không có dữ liệu!", null);
        }
        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $data);
    }
}

if (isset($_GET['action'])) {
    $action = $_GET['action'] ?? null;
    $controller = new GiangVienController();

    switch ($action) {
        case 'index':
            $controller->index();
            break;
        default:
            echo "Action không tồn tại!";
            break;
    }
}

<?php

require_once __DIR__ . '/../helper/ConfigHelper.php';

require_once MODEL_PATH . 'Message.php';
require_once DB_PATH . 'DBConnect.php';
require_once HELPER_PATH . 'ResponseHelper.php';



class MessageController
{

    private $model;
    private $conn;
    private $responseHelper;
    public function __construct()
    {
        $this->conn = (new DBConnect())->getConnection(); // Tạo kết nối mới

        $this->model = new Message($this->conn);
        $this->responseHelper = new ResponseHelper();
    }

    public function getListYeuCauChinhSua()
    {
        $data = $this->model->getListYeuCauChinhSua();
        if ($data == null) {
            return $this->responseHelper->Response(false, "Không có dữ liệu!", null);
        }
        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $data);
    }

    public function getDetailByIDBaoCao($ma_baocao)
    {
        $data = $this->model->getDetailByIDBaoCao($ma_baocao);
        if ($data == null) {
            return $this->responseHelper->Response(false, "Không có dữ liệu!", null);
        }
        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $data);
    }

    public function getListThongBao()
    {
        $data = $this->model->getListThongBao();
        if ($data == null) {
            return $this->responseHelper->Response(false, "Không có dữ liệu!", null);
        }
        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $data);
    }

    public function getDetailThongBaoById($id)
    {
        $data = $this->model->getDetailThongBaoById($id);
        if ($data == null) {
            return $this->responseHelper->Response(false, "Không có dữ liệu!", null);
        }
        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $data);
    }
}


if (isset($_GET['action'])) {
    $action = $_GET['action'] ?? null;
    $tn = new MessageController();

    switch ($action) {
        case 'getListYeuCauChinhSua':
            $tn->getListYeuCauChinhSua();
            break;
        case 'getDetailByIDBaoCao':
            $ma_baocao = $_GET['ma_baocao'] ?? null;
            $tn->getDetailByIDBaoCao($ma_baocao);
            break;
        case 'getListThongBao':
            $tn->getListThongBao();
            break;
        case 'getDetailThongBaoById':
            $id = $_GET['id'] ?? null;
            $tn->getDetailThongBaoById($id);
            break;
        default:
            echo "Action không tồn tại!";
            break;
    }
}

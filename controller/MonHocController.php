<?php

require_once __DIR__ . '/../helper/ConfigHelper.php';

require_once MODEL_PATH . 'MonHoc.php';
require_once DB_PATH . 'DBConnect.php';
require_once HELPER_PATH . 'ResponseHelper.php';


class MonHocController
{
    private $conn;
    private $model;
    private $responseHelper;

    public function __construct()
    {
        $this->conn = (new DBConnect())->getConnection();
        $this->model = new MonHoc($this->conn);
        $this->responseHelper = new ResponseHelper();
    }


    public function index()
    {
        $data = $this->model->getDSMH_Model();

        require_once '../view/mon_hoc_list.php';
    }


    public function getListMonHoc()
    {
        $result = $this->model->getDSMH_Model();
        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $result);
    }

    public function getDetailByID($maMonHoc)
    {
        $detailData  = $this->model->getDetailByID($maMonHoc);

        return $this->responseHelper->Response(true, "Lấy dữ liệu thành công!", $detailData);
    }

    public function update()
    {

        $maMonHoc = $_POST['ma_monhoc'];

        if (empty($_POST['ten_monhoc'])) {

            return $this->responseHelper->Response(false, "Tên môn học không được để trống!", null);
        }

        $ten_monhoc = $_POST['ten_monhoc'];

        $tenMonHocLength = strlen($_POST['ten_monhoc']);
        if ($tenMonHocLength < 3 || $tenMonHocLength > 100) {
            return $this->responseHelper->Response(false, "Độ dài của tên môn học phải từ 3 đến 100 ký tự!", null);
        }

        $ten_monhoc = trim($_POST['ten_monhoc']);
        if (preg_match('/[^\p{L}\p{N}\s]/u', $ten_monhoc)) {
            return $this->responseHelper->Response(false, "Tên môn học chỉ được chứa ký tự chữ cái, số và dấu cách!", null);
        }

        if (ctype_digit(str_replace(' ', '', $ten_monhoc))) {

            return $this->responseHelper->Response(false, "Tên môn học không được chỉ chứa các ký tự số!", null);
        }

        $data = [
            'ten_monhoc' => $_POST['ten_monhoc'],
            'loai_monhoc' => $_POST['loai_monhoc'],
            'hoc_ky_monhoc' => $_POST['hoc_ky_monhoc'],
        ];

        $result = $this->model->updateMonHocByID($maMonHoc, $data);

        if ($result) {
            return $this->responseHelper->Response(true, "Cập nhật dữ liệu thành công!", $data);
        }
    }

    public function insert()
    {
        // Kiểm tra mã môn học rỗng
        if (empty($_POST['ma_monhoc'])) {
            return $this->responseHelper->Response(false, "Mã môn học không được để trống!", null);
        }
        // Kiểm tra tên môn học rỗng
        if (empty($_POST['ten_monhoc'])) {
            return $this->responseHelper->Response(false, "Tên môn học không được để trống!", null);
        }

        $ma_monhoc = trim($_POST['ma_monhoc']);
        if (preg_match('/[^\p{L}\p{N}\s]/u', $ma_monhoc)) {
            return $this->responseHelper->Response(false, "Mã môn học chỉ được chứa ký tự chữ cái, số và dấu cách!", null);
        }

        if (ctype_digit(str_replace(' ', '', $ma_monhoc))) {
            return $this->responseHelper->Response(false, "Mã môn học không được chỉ chứa các ký tự số!", null);
        }

        $ten_monhoc = trim($_POST['ten_monhoc']);
        if (preg_match('/[^\p{L}\p{N}\s]/u', $ten_monhoc)) {
            return $this->responseHelper->Response(false, "Tên môn học chỉ được chứa ký tự chữ cái, số và dấu cách!", null);
        }

        if (ctype_digit(str_replace(' ', '', $ten_monhoc))) {
            return $this->responseHelper->Response(false, "Tên môn học không được chỉ chứa các ký tự số!", null);
        }

        // Kiểm tra độ dài của mã môn học
        $maMonHocLength = strlen($_POST['ma_monhoc']);
        if ($maMonHocLength < 7 || $maMonHocLength > 15) {
            return $this->responseHelper->Response(false, "Độ dài của mã môn học phải từ 7 đến 15 ký tự!", null);
        }

        // Kiểm tra độ dài của tên môn học
        $tenMonHocLength = strlen($_POST['ten_monhoc']);
        if ($tenMonHocLength < 3 || $tenMonHocLength > 100) {
            return $this->responseHelper->Response(false, "Độ dài của tên môn học phải từ 3 đến 100 ký tự!", null);
        }

        if ($this->model->isCheckForDuplicatesMaMonHoc($_POST['ma_monhoc'])) {
            return $this->responseHelper->Response(false, "Môn học đã tồn tại!", null);
        }

        $data = [
            'ma_monhoc' => $_POST['ma_monhoc'],
            'ten_monhoc' => $_POST['ten_monhoc'],
            'loai_monhoc' => $_POST['loai_monhoc'],
            'hoc_ky_monhoc' => $_POST['hoc_ky_monhoc'],
        ];

        $this->model->insertMonHoc($data);
        return $this->responseHelper->Response(true, "Thêm môn học thành công!", $data);
    }
}


if (isset($_GET['action'])) {
    $action = $_GET['action'] ?? null;
    $mh = new MonHocController();

    switch ($action) {
        case 'index':
            $mh->index();
            break;
        case 'getListMonHoc':
            $mh->getListMonHoc();
            break;
        case 'detail':
            $maMonHoc = $_GET['ma_monhoc'];
            $mh->getDetailByID($maMonHoc);
            break;
        case 'update':
            header('Content-Type: application/json');
            $mh->update();
            break;
        case 'insert':
            header('Content-Type: application/json');
            $mh->insert();
            break;
        default:
            echo "Action không tồn tại!";
            break;
    }
}

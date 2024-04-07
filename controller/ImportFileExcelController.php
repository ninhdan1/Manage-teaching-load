<?php

require_once __DIR__. '/../model/ImportFileExcel.php';
require_once __DIR__. '/../model/SQLQueries.php';
require_once __DIR__. '/../DB/DBConnect.php';

class ImportFileExcelController{
    private $model;
    private $conn;
    private $sqlQueries;

    public function __construct() {
        $this->conn = (new DBConnect())->getConnection(); // Tạo kết nối mới
        $this->model = new ImportFileExcel($this->conn); // Truyền kết nối vào ImportFileExcel
        $this->sqlQueries = new SQLQueries($this->conn);
    }

    public function import() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Xử lý import dữ liệu từ file
            $excelFile = $_FILES["fileToUpload"]["tmp_name"];
            $data = $this->model->importData($excelFile);
            $this->addToDatabase($data);
            echo "Import dữ liệu thành công!";
        } else {
            // Hiển thị form import
            require_once __DIR__. '/../view/import-excel.php';
            echo "Import dữ liệu không thành công!";
        }
    }

    public function addToDatabase($data)
    {
        try {
            $this->conn->beginTransaction();

            $hoc_ky_data = [
                'ten_hocky' => $_POST['tenHocKy'],
                'nam_hoc' => $_POST['namHoc'],
            ];
            $ma_hk = $this->insertHocKyAndGetMaHK($hoc_ky_data);

            foreach ($data as $row) {
                $this->insertMonHocIfNotExists($row);
                $this->insertGiangVienIfNotExists($row);
                $this->insertLopIfNotExists($row);
                $this->insertLopMonHocIfNotExists($row, $ma_hk);
            }
            $this->conn->commit();
            echo "Import dữ liệu thành công";

        }catch (PDOException $e) {
            $this->conn->rollBack();
            echo "Lỗi: " . $e->getMessage();
        }
    }

    private function insertHocKyAndGetMaHK($hoc_ky_data)
    {
        // Thêm mới một bản ghi vào bảng 'hoc_ky'
        $ma_hk = $this->sqlQueries->insertData('hoc_ky', $hoc_ky_data);
        // Trả về mã học kỳ mới được sinh tự động
        return $ma_hk;
    }

    private function insertMonHocIfNotExists($row) {
        $result = $this->sqlQueries->selectData('mon_hoc','*','ma_monhoc = ?',[$row[4]]);

        if (!$result) {

            $data = [
              'ma_monhoc' => $row[4],
              'ten_monhoc' => $row[90]
            ];
            $this->sqlQueries->insertData('mon_hoc',$data);
        }
    }

    private function insertGiangVienIfNotExists($row) {
        $result = $this->sqlQueries->selectData('giang_vien', '*', 'ma_gv = ?', [$row[5]]);
        if (!$result) {
            $data = [
                'ma_gv' => $row[5],
                'ho_lot_gv' => $row[91],
                'ten_gv' => $row[92]
            ];
            $this->sqlQueries->insertData('giang_vien', $data);
        }
    }

    private function insertLopIfNotExists($row) {
        $result = $this->sqlQueries->selectData('lop', '*', 'ma_lop = ?', [$row[82]]);

        if (!$result) {
            $data = [
                'ma_lop' => $row[82],
                'si_so' => $row[18]
            ];
            $this->sqlQueries->insertData('lop', $data);
        }
    }

    private function insertLopMonHocIfNotExists($row, $ma_hk)
    {
        $result = $this->sqlQueries->selectData('lop_monhoc', '*', 'ma_lichday = ?',[$row[0]]);
        if(!$result){
            $data = [
                'ma_lichday' => $row[0],
                'thu' => $row[1],
                'tiet_batdau' => $row[2],
                'so_tiet' => $row[3],
                'so_tietmonhoc' => $row[85],
                'si_solop' => $row[81], //
                'ma_lophoc' => $row[86],
                'ten_phong' => $row[6],
                'tiet_hoc' => $row[83],
                'thoigian_hoc' => $row[76],
                'ngay_batdau' => $row[89],
                'ma_monhoc' => $row[4],
                'ma_gv' => $row[5],
                'ma_hk' => $ma_hk,//
                'ma_lop' => $row[82],

            ];

            $this->sqlQueries->insertData('lop_monhoc',$data);
        }

    }

}

$importExcel = new ImportFileExcelController();
$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
    case 'import':
        $importExcel->import();
        break;
}



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
        $hasError = false; 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if ($_FILES["fileToUpload"]["error"] != 0) {
                echo "<script>toastr.error('Có lỗi xảy ra khi tải tệp lên máy chủ!', 'Lỗi');</script>";
                return;
            }

            // Xử lý import dữ liệu từ file
            $excelFile = $_FILES["fileToUpload"]["tmp_name"];
            $data = $this->model->importData($excelFile);
            if ($data === false) {
                echo "<script>toastr.error('Có lỗi xảy ra khi xử lý dữ liệu từ tệp Excel!', 'Lỗi');</script>";
                return;
            }

            $result = $this->addToDatabase($data);
            if ($result === false) {
                echo "<script>toastr.error('Có lỗi xảy ra khi thêm dữ liệu vào cơ sở dữ liệu!', 'Lỗi');</script>";
                return;
            }
            
            if (!$hasError) {
                echo "<script>toastr.success('Import dữ liệu thành công!', { timeOut: 5000 });</script>";
            }
        } else {
            // Hiển thị form import
            require_once __DIR__. '/../view/import-excel.php';
           
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

        }catch (PDOException $e) {
            $this->conn->rollBack();
            echo "Lỗi: " . $e->getMessage();
        }
    }

    private function insertHocKyAndGetMaHK($hoc_ky_data)
    {
        // Kiểm tra xem đã tồn tại học kỳ nào cho năm học này chưa
        $result = $this->sqlQueries->selectData('hoc_ky', 'COUNT(*)', 'ten_hocky IN (?, ?) AND nam_hoc = ?', [$hoc_ky_data['ten_hocky'], $hoc_ky_data['ten_hocky'] == 1 ? 2 : 1, $hoc_ky_data['nam_hoc']]);
        $count = $result[0]['COUNT(*)'];

        // Nếu đã tồn tại học kỳ cho năm học này, không thêm mới và thông báo lỗi
        if ($count > 0) {
            echo "<script>toastr.error('Đã tồn tại học kỳ cho năm học này!', 'Lỗi');</script>";
            return false;
        }

        $ma_hk = $this->sqlQueries->insertData('hoc_ky', $hoc_ky_data);
       
        return $ma_hk;
    }

    private function insertMonHocIfNotExists($row) {
        // Kiểm tra dữ liệu không đầy đủ
        if (empty($row[4]) || empty($row[90])) {
            echo "<script>toastr.error('Dữ liệu không đầy đủ khi thêm môn học!', 'Lỗi');</script>";
            return;
        }

        // Kiểm tra kiểu dữ liệu sai
        if (!is_numeric($row[4])) {
            echo "<script>toastr.error('Sai kiểu dữ liệu cho mã môn học!', 'Lỗi');</script>";
            return;
        }

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
        // Kiểm tra dữ liệu không đầy đủ
        if (empty($row[5]) || empty($row[91]) || empty($row[92])) {
            echo "<script>toastr.error('Dữ liệu không đầy đủ khi thêm giảng viên!', 'Lỗi');</script>";
            return;
        }

        // Kiểm tra kiểu dữ liệu sai
        if (!is_numeric($row[5])) {
            echo "<script>toastr.error('Sai kiểu dữ liệu cho mã giảng viên!', 'Lỗi');</script>";
            return;
        }

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

        // Kiểm tra dữ liệu không đầy đủ
        if (empty($row[82]) || empty($row[18])) {
            echo "<script>toastr.error('Dữ liệu không đầy đủ khi thêm lớp học!', 'Lỗi');</script>";
            return;
        }

        // Kiểm tra kiểu dữ liệu sai
        if (!is_numeric($row[82]) || !is_numeric($row[18])) {
            echo "<script>toastr.error('Sai kiểu dữ liệu cho mã lớp hoặc số lượng sinh viên!', 'Lỗi');</script>";
            return;
        }

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
        // Kiểm tra dữ liệu không đầy đủ
        if (empty($row[0]) || empty($row[1]) || empty($row[2]) || empty($row[3]) || empty($row[85]) || empty($row[81]) || empty($row[86]) || empty($row[6]) || empty($row[83]) || empty($row[76]) || empty($row[89]) || empty($row[4]) || empty($row[5]) || empty($row[82])) {
            echo "<script>toastr.error('Dữ liệu không đầy đủ khi thêm lớp môn học!', 'Lỗi');</script>";
            return;
        }

        // Kiểm tra kiểu dữ liệu sai (đối với các trường là số)
        if (!is_numeric($row[0]) || !is_numeric($row[3]) || !is_numeric($row[85]) || !is_numeric($row[81]) || !is_numeric($row[86]) || !is_numeric($row[83]) || !is_numeric($row[82])) {
            echo "<script>toastr.error('Sai kiểu dữ liệu cho một hoặc nhiều trường dữ liệu của lớp môn học!', 'Lỗi');</script>";
            return;
        }


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



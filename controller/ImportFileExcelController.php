<?php

require_once __DIR__ . '/../helper/ConfigHelper.php';

require_once MODEL_PATH . 'ImportFileExcel.php';
require_once MODEL_PATH . 'SQLQueries.php';
require_once DB_PATH . 'DBConnect.php';

class ImportFileExcelController
{
    private $model;
    private $conn;
    private $sqlQueries;

    public function __construct()
    {
        $this->conn = (new DBConnect())->getConnection();
        $this->model = new ImportFileExcel($this->conn);
        $this->sqlQueries = new SQLQueries($this->conn);
    }

    public function import()
    {

        ini_set("memory_limit", "512M");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if ($_FILES["fileToUpload"]["error"] != 0) {

                echo "Lỗi: Có lỗi xảy ra khi tải tệp lên máy chủ!";
                exit();
            }

            $maxFileSize = 1.9 * 1024 * 1024;
            if ($_FILES["fileToUpload"]["size"] > $maxFileSize) {
                echo "Lỗi: Kích thước tệp quá lớn. Vui lòng tải lên tệp nhỏ hơn 2MB!";
                exit();
            }

            $fileExtension = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
            if ($fileExtension != 'xlsx' && $fileExtension != 'xls') {
                echo "Lỗi: Chỉ chấp nhận tệp Excel có định dạng .xlsx hoặc .xls!";
                exit();
            }

            $excelFile = $_FILES["fileToUpload"]["tmp_name"];
            $data = $this->model->importData($excelFile);
            $result = $this->addToDatabase($data);

            if ($result === false) return;
        } else {

            require_once __DIR__ . '/../view/import-excel.php';
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

            foreach (array_chunk($data, 100) as $chunk) {
                foreach ($chunk as $row) {
                    if (!$this->insertMonHocIfNotExists($row)) exit();

                    if (!$this->insertGiangVienIfNotExists($row)) exit();

                    if (!$this->insertLopIfNotExists($row)) exit();

                    if (!$this->updateOrInsertLopMonHoc($row, $ma_hk)) exit();
                }
            }

            $this->conn->commit();
            echo "success";
        } catch (PDOException $e) {
            $this->conn->rollBack();
            echo "Lỗi: " . $e->getMessage();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    private function insertHocKyAndGetMaHK($hoc_ky_data)
    {
        $result = $this->sqlQueries->selectData('hoc_ky', 'ma_hocky', 'ten_hocky = ? AND nam_hoc = ?', [$hoc_ky_data['ten_hocky'], $hoc_ky_data['nam_hoc']]);

        // Nếu học kỳ đã tồn tại, trả về mã học kỳ
        if (!empty($result)) {
            return $result[0]['ma_hocky'];
        }

        // Nếu không, thực hiện chèn mới và trả về mã học kỳ mới
        return $this->sqlQueries->insertData('hoc_ky', $hoc_ky_data);
    }


    private function updateOrInsertLopMonHoc($row, $ma_hk)
    {
        if (isset($row[0]) && !empty($row[0])) {
            if (empty($row[1]) || empty($row[2]) || empty($row[3]) || empty($row[85]) || empty($row[81]) || empty($row[86]) || empty($row[6]) || empty($row[83]) || empty($row[76]) || empty($row[89]) || empty($row[4]) || empty($row[5]) || empty($row[82])) {
                echo "Lỗi: Dữ liệu lớp môn học không đầy đủ.";
                return false;
            }

            if (!is_numeric($row[0])) {
                echo "Lỗi: 'Mã lớp môn học' phải là một chuỗi số nguyên.";
                return false;
            }

            // Kiểm tra xem mã lớp môn học đã tồn tại hay không
            $result = $this->sqlQueries->selectData('lop_monhoc', '*', 'ma_lopmonhoc = ? AND ma_hk = ?', [$row[0], $ma_hk]);

            if ($result) {
                $data = [
                    'thu' => $row[1],
                    'tiet_batdau' => $row[2],
                    'so_tiet' => $row[3],
                    'so_tietmonhoc' => $row[85],
                    'si_solop' => $row[81],
                    'ma_lophoc' => $row[86],
                    'ten_phong' => $row[6],
                    'tiet_hoc' => $row[83],
                    'thoigian_hoc' => $row[76],
                    'ngay_batdau' => $row[89],
                    'ma_monhoc' => $row[4],
                    'ma_gv' => $row[5],
                    'ma_hk' => $ma_hk,
                    'ma_lop' => $row[82]
                ];

                // Thực hiện UPDATE dữ liệu
                $this->sqlQueries->updateData('lop_monhoc', $data, 'ma_lopmonhoc = ? AND ma_hk = ?', [$row[0], $ma_hk]);
            } else {
                // Nếu chưa tồn tại, thực hiện INSERT
                $data = [
                    'ma_lopmonhoc' => $row[0],
                    'thu' => $row[1],
                    'tiet_batdau' => $row[2],
                    'so_tiet' => $row[3],
                    'so_tietmonhoc' => $row[85],
                    'si_solop' => $row[81],
                    'ma_lophoc' => $row[86],
                    'ten_phong' => $row[6],
                    'tiet_hoc' => $row[83],
                    'thoigian_hoc' => $row[76],
                    'ngay_batdau' => $row[89],
                    'ma_monhoc' => $row[4],
                    'ma_gv' => $row[5],
                    'ma_hk' => $ma_hk,
                    'ma_lop' => $row[82]
                ];

                $this->sqlQueries->insertData('lop_monhoc', $data);

                print($data);
            }
            return true;
        } else {
            echo "Lỗi: 'Mã lớp môn học' không được gửi hoặc bị thiếu.";
            return false;
        }
    }


    private function insertMonHocIfNotExists($row)
    {

        if (isset($row[4]) && !empty($row[4])) {

            if (empty($row[90])) {
                echo "Lỗi: Dữ liệu môn học không đầy đủ.";
                return false;
            }

            if (!is_string($row[4])) {
                echo "Lỗi: 'Mã môn học' phải là một chuỗi.";
                return false;
            }

            $result = $this->sqlQueries->selectData('mon_hoc', '*', 'ma_monhoc = ?', [$row[4]]);
            if (!$result) {
                $data = [
                    'ma_monhoc' => $row[4],
                    'ten_monhoc' => $row[90]
                ];
                $this->sqlQueries->insertData('mon_hoc', $data);
                return true;
            } else {

                return true;
            }
        } else {
            echo "Lỗi: 'mã môn học' không được gửi hoặc bị thiếu.";
            return false;
        }
    }


    private function insertGiangVienIfNotExists($row)
    {
        if (isset($row[5]) && !empty($row[5])) {
            if (empty($row[91]) || empty($row[92])) {
                echo "Lỗi: Dữ liệu giảng viên không đầy đủ.";
                return false;
            }

            if (!is_string($row[5])) {
                echo "Lỗi: 'Mã giảng viên' phải là một chuỗi.";
                return false;
            }

            $result = $this->sqlQueries->selectData('giang_vien', '*', 'ma_gv = ?', [$row[5]]);
            if (!$result) {
                $data = [
                    'ma_gv' => $row[5],
                    'ho_lot_gv' => $row[91],
                    'ten_gv' => $row[92]
                ];
                $this->sqlQueries->insertData('giang_vien', $data);
                return true;
            } else {

                return true;
            }
        } else {
            echo "Lỗi: 'Mã giảng viên' không được gửi hoặc bị thiếu.";
            return false;
        }
    }

    private function insertLopIfNotExists($row)
    {

        if (isset($row[82]) && !empty($row[82])) {
            if (empty($row[18])) {
                echo "Lỗi: Dữ liệu lớp không đầy đủ.";
                return false;
            }

            if (!is_string($row[82])) {
                echo "Lỗi: 'Mã lớp' phải là một chuỗi.";
                return false;
            }

            $result = $this->sqlQueries->selectData('lop', '*', 'ma_lop = ?', [$row[82]]);
            if (!$result) {
                $data = [
                    'ma_lop' => $row[82],
                    'si_so' => $row[18]
                ];
                $this->sqlQueries->insertData('lop', $data);
                return true;
            } else {

                return true;
            }
        } else {
            echo "Lỗi: 'Mã lớp' không được gửi hoặc bị thiếu.";
            return false;
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

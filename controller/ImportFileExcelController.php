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


        if (!empty($result)) {
            return $result[0]['ma_hocky'];
        }


        return $this->sqlQueries->insertData('hoc_ky', $hoc_ky_data);
    }


    private function updateOrInsertLopMonHoc($row, $ma_hk)
    {

        $ma_lopmonhoc_index = 0;
        $thu_index = 1;
        $tiet_batdau_index = 2;
        $so_tiet_index = 3;
        $so_tietmonhoc_index = 85;
        $si_solop_index = 81;
        $ma_lophoc_index = 86;
        $ten_phong_index = 6;
        $tiet_hoc_index = 83;
        $thoigian_hoc_index = 76;
        $ngay_batdau_index = 89;
        $ma_monhoc_index = 4;
        $ma_gv_index = 5;
        $ma_lop_index = 82;

        if (isset($row[$ma_lopmonhoc_index]) && !empty($row[$ma_lopmonhoc_index])) {
            if (
                empty($row[$thu_index]) || empty($row[$tiet_batdau_index])
                || empty($row[$so_tiet_index]) || empty($row[$so_tietmonhoc_index])
                || empty($row[$si_solop_index]) || empty($row[$ma_lophoc_index])
                || empty($row[$ten_phong_index]) || empty($row[$tiet_hoc_index])
                || empty($row[$thoigian_hoc_index]) || empty($row[$ngay_batdau_index])
                || empty($row[$ma_monhoc_index]) || empty($row[$ma_gv_index])
                || empty($row[$ma_lop_index])
            ) {
                echo "Lỗi: Dữ liệu lớp môn học không đầy đủ.";
                return false;
            }

            if (!is_numeric($row[$ma_lopmonhoc_index])) {
                echo "Lỗi: 'Mã lớp môn học' phải là một chuỗi số nguyên.";
                return false;
            }


            $result = $this->sqlQueries->selectData('lop_monhoc', '*', 'ma_lopmonhoc = ? AND ma_hk = ?', [$row[$ma_lopmonhoc_index], $ma_hk]);

            if ($result) {
                $data = [
                    'thu' => $row[$thu_index],
                    'tiet_batdau' => $row[$tiet_batdau_index],
                    'so_tiet' => $row[$so_tiet_index],
                    'so_tietmonhoc' => $row[$so_tietmonhoc_index],
                    'si_solop' => $row[$si_solop_index],
                    'ma_lophoc' => $row[$ma_lophoc_index],
                    'ten_phong' => $row[$ten_phong_index],
                    'tiet_hoc' => $row[$tiet_hoc_index],
                    'thoigian_hoc' => $row[$thoigian_hoc_index],
                    'ngay_batdau' => $row[$ngay_batdau_index],
                    'ma_monhoc' => $row[$ma_monhoc_index],
                    'ma_gv' => $row[$ma_gv_index],
                    'ma_hk' => $ma_hk,
                    'ma_lop' => $row[$ma_lop_index]
                ];


                $this->sqlQueries->updateData('lop_monhoc', $data, 'ma_lopmonhoc = ? AND ma_hk = ?', [$row[$ma_lopmonhoc_index], $ma_hk]);
            } else {

                $data = [
                    'ma_lopmonhoc' => $row[$ma_lopmonhoc_index],
                    'thu' => $row[$thu_index],
                    'tiet_batdau' => $row[$tiet_batdau_index],
                    'so_tiet' => $row[$so_tiet_index],
                    'so_tietmonhoc' => $row[$so_tietmonhoc_index],
                    'si_solop' => $row[$si_solop_index],
                    'ma_lophoc' => $row[$ma_lophoc_index],
                    'ten_phong' => $row[$ten_phong_index],
                    'tiet_hoc' => $row[$tiet_hoc_index],
                    'thoigian_hoc' => $row[$thoigian_hoc_index],
                    'ngay_batdau' => $row[$ngay_batdau_index],
                    'ma_monhoc' => $row[$ma_monhoc_index],
                    'ma_gv' => $row[$ma_gv_index],
                    'ma_hk' => $ma_hk,
                    'ma_lop' => $row[$ma_lop_index]
                ];

                $this->sqlQueries->insertData('lop_monhoc', $data);

                return true;
            }
            return true;
        } else {
            echo "Lỗi: 'Mã lớp môn học' không được gửi hoặc bị thiếu.";
            return false;
        }
    }



    private function insertMonHocIfNotExists($row)
    {

        $ma_monhoc_index = 4;
        $ten_monhoc_index = 90;

        if (isset($row[$ma_monhoc_index]) && !empty($row[$ma_monhoc_index])) {
            if (empty($row[$ten_monhoc_index])) {
                echo "Lỗi: Dữ liệu môn học không đầy đủ.";
                return false;
            }

            if (!is_string($row[$ma_monhoc_index])) {
                echo "Lỗi: 'Mã môn học' phải là một chuỗi.";
                return false;
            }

            $result = $this->sqlQueries->selectData('mon_hoc', '*', 'ma_monhoc = ?', [$row[$ma_monhoc_index]]);
            if (!$result) {
                $data = [
                    'ma_monhoc' => $row[$ma_monhoc_index],
                    'ten_monhoc' => $row[$ten_monhoc_index]
                ];
                $this->sqlQueries->insertData('mon_hoc', $data);
                return true;
            } else {

                return true;
            }
        } else {
            echo "Lỗi: 'Mã môn học' không được gửi hoặc bị thiếu.";
            return false;
        }
    }



    private function insertGiangVienIfNotExists($row)
    {

        $ma_gv_index = 5;
        $ho_lot_gv_index = 91;
        $ten_gv_index = 92;

        if (isset($row[$ma_gv_index]) && !empty($row[$ma_gv_index])) {
            if (empty($row[$ho_lot_gv_index]) || empty($row[$ten_gv_index])) {
                echo "Lỗi: Dữ liệu giảng viên không đầy đủ.";
                return false;
            }

            if (!is_string($row[$ma_gv_index])) {
                echo "Lỗi: 'Mã giảng viên' phải là một chuỗi.";
                return false;
            }

            $result = $this->sqlQueries->selectData('giang_vien', '*', 'ma_gv = ?', [$row[$ma_gv_index]]);
            if (!$result) {
                $data = [
                    'ma_gv' => $row[$ma_gv_index],
                    'ho_lot_gv' => $row[$ho_lot_gv_index],
                    'ten_gv' => $row[$ten_gv_index]
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

        $ma_lop_index = 82;
        $si_so_index = 18;

        if (isset($row[$ma_lop_index]) && !empty($row[$ma_lop_index])) {
            if (empty($row[$si_so_index])) {
                echo "Lỗi: Dữ liệu lớp không đầy đủ.";
                return false;
            }

            if (!is_string($row[$ma_lop_index])) {
                echo "Lỗi: 'Mã lớp' phải là một chuỗi.";
                return false;
            }

            $result = $this->sqlQueries->selectData('lop', '*', 'ma_lop = ?', [$row[$ma_lop_index]]);
            if (!$result) {
                $data = [
                    'ma_lop' => $row[$ma_lop_index],
                    'si_so' => $row[$si_so_index]
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

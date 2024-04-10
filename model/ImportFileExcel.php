<?php

require_once  __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportFileExcel
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function importData($excelFile)
    {
        $data = [];

        // Load file Excel
        $spreadsheet = IOFactory::load($excelFile);
        $sheet = $spreadsheet->getActiveSheet();

        // Lặp qua từng dòng trong file Excel (bắt đầu từ dòng thứ 2)
        foreach ($sheet->getRowIterator(2) as $row) {
            // Lấy dữ liệu từ mỗi ô trong dòng
            $rowData = [];
            foreach ($row->getCellIterator() as $cell) {
                $rowData[] = $cell->getValue();
            }

            // Thêm dữ liệu vào mảng data
            $data[] = $rowData;
        }

        return $data;
    }
}

<?php
require_once __DIR__ . '/../Helper/ConfigHelper.php';

require_once MODEL_PATH . 'SQLQueries.php';

class GiangVien
{

    private $conn;
    private $SQLQueries;
    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->SQLQueries = new SQLQueries($this->conn);
    }

    public function getListGiangVien()
    {
        return $this->SQLQueries->selectAllData('giang_vien');
    }
}

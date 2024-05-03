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

    public function getListGiangVienByRoleUser()
    {
        $query = "SELECT giang_vien.* 
        FROM giang_vien 
        INNER JOIN tai_khoan ON giang_vien.ma_gv = tai_khoan.ma_gv 
        WHERE tai_khoan.role = 'user'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}

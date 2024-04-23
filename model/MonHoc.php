<?php

require_once __DIR__ . '/../Helper/ConfigHelper.php';

require_once MODEL_PATH . 'SQLQueries.php';

class MonHoc
{
    private $conn;
    private $SQLQueries;
    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->SQLQueries = new SQLQueries($this->conn);
    }

    public function getDSMH_Model()
    {
        return $this->SQLQueries->selectAllData('mon_hoc');
    }

    public function isCheckForDuplicatesMaMonHoc($maMonHoc)
    {
        return $this->SQLQueries->selectData('mon_hoc', 'ma_monhoc', 'ma_monhoc = ?', [$maMonHoc]);
    }


    public function insertMonHoc($data)
    {
        return $this->SQLQueries->insertData('mon_hoc', $data);
    }

    public function getDetailByID($maMonHoc)
    {
        return $this->SQLQueries->selectData('mon_hoc', '*', 'ma_monhoc = ?', [$maMonHoc]);
    }

    public function updateMonHocByID($maMonHoc, $data)
    {
        return $this->SQLQueries->updateData('mon_hoc', $data, 'ma_monhoc = ?', [$maMonHoc]);
    }
}

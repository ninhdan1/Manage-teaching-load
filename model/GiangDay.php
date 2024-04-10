<?php

require 'SQLQueries.php';

class GiangDay
{
    private $sqlQueries;
    public function __construct($conn)
    {
         $this->sqlQueries = new SQLQueries($conn);
    }
    public function getDSGV_model()
    {
      return $this->sqlQueries->selectAllData('lop_monhoc');
    }
}
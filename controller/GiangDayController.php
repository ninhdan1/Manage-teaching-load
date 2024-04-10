<?php

require_once  '../model/GiangDay.php';
require_once  '../DB/DBConnect.php';

class GiangDayController
{

    private $model;
    public function __construct()
    {
        $db = new DBConnect();
        $conn = $db->getConnection();
        $this->model = new GiangDay($conn);
    }

    public function index()
    {
        $data = $this->model->getDSGV_model();

        require_once '../view/giang_day_list.php';
    }
}


$gd = new GiangDayController();
$gd->index();

<?php

require_once '../controller/MonHocController.php';

use PHPUnit\Framework\TestCase;

class MonHocTest extends TestCase
{
    public function testInsert()
    {
        $_POST['ma_monhoc'] = 'CS1230665';
        $_POST['ten_monhoc'] = 'Toan';
        $_POST['loai_monhoc'] = 'lt_pm';

        $data = [
            'ma_monhoc' => $_POST['ma_monhoc'],
            'ten_monhoc' =>  $_POST['ten_monhoc'],
            'loai_monhoc' =>  $_POST['loai_monhoc'],
        ];

        $mockDatabase = $this->getMockBuilder(MonHoc::class)
            ->setMethods(['insertMonHoc'])
            ->disableOriginalConstructor()
            ->getMock();
        $expectedResponse = json_encode([
            'success' => true,
            'message' => 'Thêm môn học thành công!',
            'data' => $data
        ]);
        $mockDatabase->method('insertMonHoc')->willReturn(true);

        $monHocController = new MonHocController($mockDatabase);


        $result = $monHocController->insert();
        $this->assertEquals($expectedResponse, $result);
    }

    public function testInsertWithEmptyMaMonHoc()
    {
        $_POST['ma_monhoc'] = '';
        $_POST['ten_monhoc'] = 'Toan';
        $_POST['loai_monhoc'] = 'lt_pm';

        $mockDatabase = $this->getMockBuilder(MonHoc::class)
            ->setMethods(['insertMonHoc'])
            ->disableOriginalConstructor()
            ->getMock();

        $mockDatabase->method('insertMonHoc')->willReturn(true);


        $monHocController = new MonHocController($mockDatabase);
        $expectedResponse = json_encode([
            'success' => false,
            'message' => 'Mã môn học không được để trống!',
            'data' => null
        ]);
        $result = $monHocController->insert();

        $this->assertEquals($expectedResponse, $result);
    }

    public function testInsertWithEmptyTenMonHoc()
    {
        $_POST['ma_monhoc'] = 'CS1230999';
        $_POST['ten_monhoc'] = '';
        $_POST['loai_monhoc'] = 'lt_pm';

        $mockDatabase = $this->getMockBuilder(MonHoc::class)
            ->setMethods(['insertMonHoc'])
            ->disableOriginalConstructor()
            ->getMock();


        $mockDatabase->method('insertMonHoc')->willReturn(true);

        $monHocController = new MonHocController($mockDatabase);

        $expectedResponse = json_encode([
            'success' => false,
            'message' => 'Tên môn học không được để trống!',
            'data' => null
        ]);

        $result = $monHocController->insert();

        $this->assertEquals($expectedResponse, $result);
    }
}

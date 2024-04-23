<?php

require_once __DIR__ . '/../Helper/ConfigHelper.php';

require_once MODEL_PATH . 'SQLQueries.php';


class ThongKe
{
    private $conn;
    private $SQLQueries;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->SQLQueries = new SQLQueries($this->conn);
    }

    public function getListGiangDayByHocKy($maHocKy, $loaiMonHoc)
    {

        // Gọi hàm getMonHocByLoaiMonHoc để lấy mã môn học tương ứng với loại môn học
        $monHoc = $this->getMonHocByLoaiMonHoc($loaiMonHoc);

        // Kiểm tra xem có kết quả trả về từ hàm getMonHocByLoaiMonHoc hay không
        if ($monHoc) {
            // Lấy mã môn học từ kết quả trả về
            $maMonHoc = $monHoc[0]['ma_monhoc'];

            $sql = "SELECT 
            mon_hoc.ma_monhoc, 
            mon_hoc.ten_monhoc, 
            giang_vien.ho_lot_gv, 
            giang_vien.ten_gv, 
            hoc_ky.ten_hocky, 
            hoc_ky.nam_hoc,
            lop_monhoc.so_tietmonhoc,
            lop_monhoc.so_tiet,
            GROUP_CONCAT(lop_monhoc.thu SEPARATOR ' ') AS danh_sach_thu,
            GROUP_CONCAT(lop_monhoc.tiet_batdau SEPARATOR ' ') AS danh_sach_tiet_batdau,
            GROUP_CONCAT(lop_monhoc.so_tiet SEPARATOR ' ') AS danh_sach_so_tiet,
            GROUP_CONCAT(lop_monhoc.so_tietmonhoc SEPARATOR ', ') AS danh_sach_so_tietmonhoc,
            GROUP_CONCAT(lop_monhoc.si_solop SEPARATOR ' ') AS danh_sach_si_solop,
            GROUP_CONCAT(lop_monhoc.ma_lophoc SEPARATOR '\n') AS danh_sach_ma_lophoc,
            GROUP_CONCAT(lop_monhoc.ten_phong SEPARATOR ' ') AS danh_sach_ten_phong,
            GROUP_CONCAT(lop_monhoc.tiet_hoc SEPARATOR ' ') AS danh_sach_tiet_hoc,
            GROUP_CONCAT(lop_monhoc.ma_gv SEPARATOR ' ') AS danh_sach_giang_vien,
            SUM(lop_monhoc.si_solop) AS tong_si_so,
            COUNT(lop_monhoc.ma_lophoc) AS tong_lop
           
        FROM 
            lop_monhoc 
        INNER JOIN 
            giang_vien ON lop_monhoc.ma_gv = giang_vien.ma_gv 
        INNER JOIN 
            hoc_ky ON lop_monhoc.ma_hk = hoc_ky.ma_hocky 
        INNER JOIN 
            mon_hoc ON lop_monhoc.ma_monhoc = mon_hoc.ma_monhoc
        INNER JOIN 
            lop ON lop_monhoc.ma_lop = lop.ma_lop
        WHERE 
            lop_monhoc.ma_hk = ? AND lop_monhoc.ma_monhoc = ?
        GROUP BY 
            mon_hoc.ma_monhoc, 
            mon_hoc.ten_monhoc, 
            giang_vien.ho_lot_gv, 
            giang_vien.ten_gv, 
            hoc_ky.ten_hocky, 
            hoc_ky.nam_hoc;
        ";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$maHocKy, $maMonHoc]);

            // Lấy kết quả và trả về
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            // Trả về null nếu không có kết quả từ hàm getMonHocByLoaiMonHoc
            return null;
        }
    }

    public function getMonHocByLoaiMonHoc($loaiMonHoc)
    {
        return $this->SQLQueries->selectData('mon_hoc', 'ma_monhoc', 'loai_monhoc = ?', [$loaiMonHoc]);
    }


    public function getListHocKy()
    {
        return $this->SQLQueries->selectAllData('hoc_ky');
    }
}

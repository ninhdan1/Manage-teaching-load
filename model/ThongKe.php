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

    public function getListGiangDayByHocKyAndMaGiangVien($maHocKy, $maGiangVien)
    {

        $sql = "SELECT 
             mon_hoc.ma_monhoc, 
             mon_hoc.ten_monhoc, 
             mon_hoc.loai_monhoc,
                mon_hoc.hoc_ky_monhoc,
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
             lop_monhoc.ma_hk = ? AND lop_monhoc.ma_gv = ?
         GROUP BY 
             mon_hoc.ma_monhoc, 
             mon_hoc.ten_monhoc, 
             giang_vien.ho_lot_gv, 
             giang_vien.ten_gv, 
             hoc_ky.ten_hocky, 
             hoc_ky.nam_hoc;
         ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$maHocKy, $maGiangVien]);

        // Lấy kết quả và trả về
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }



    public function getListGiangDayByHocKy($maHocKy, $loaiMonHoc, $maMonHoc, $maGiangVien)
    {
        if (!empty($maMonHoc) && !is_array($maMonHoc)) {
            $maMonHoc = explode(',', $maMonHoc);
        }

        if (!empty($maGiangVien) && !is_array($maGiangVien)) {
            $maGiangVien = explode(',', $maGiangVien);
        }


        $sql = "SELECT 
                mon_hoc.ma_monhoc, 
                mon_hoc.ten_monhoc,
                mon_hoc.loai_monhoc,
                mon_hoc.hoc_ky_monhoc,
                giang_vien.ma_gv, 
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
                lop_monhoc.ma_hk = ?";

        $params = [$maHocKy];

        if (!empty($maMonHoc) || !empty($maGiangVien)) {
            $sql .= " AND (";
        }

        if (!empty($maMonHoc)) {
            $monHocPlaceholders = rtrim(str_repeat('?,', count($maMonHoc)), ',');
            $sql .= "lop_monhoc.ma_monhoc IN ($monHocPlaceholders)";
            $params = array_merge($params, $maMonHoc);

            if (!empty($maGiangVien)) {
                $sql .= " OR ";
            }
        }

        if (!empty($maGiangVien)) {
            $giangVienPlaceholders = rtrim(str_repeat('?,', count($maGiangVien)), ',');
            $sql .= "lop_monhoc.ma_gv IN ($giangVienPlaceholders)";
            $params = array_merge($params, $maGiangVien);
        }

        if (!empty($maMonHoc) || !empty($maGiangVien)) {
            $sql .= ")";
        }

        if (!empty($loaiMonHoc)) {
            $sql .= " AND mon_hoc.loai_monhoc = ?";
            $params[] = $loaiMonHoc;
        }


        $sql .= " GROUP BY 
                mon_hoc.ma_monhoc, 
                mon_hoc.ten_monhoc, 
                giang_vien.ho_lot_gv, 
                giang_vien.ten_gv, 
                hoc_ky.ten_hocky, 
                hoc_ky.nam_hoc;";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        // Lấy kết quả và trả về
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function getMonHocByLoaiMonHoc($loaiMonHoc)
    {
        return $this->SQLQueries->selectData('mon_hoc', 'ma_monhoc', 'loai_monhoc = ?', [$loaiMonHoc]);
    }


    public function getHocKyNewest()
    {
        $sql = "SELECT * FROM hoc_ky WHERE ma_hocky = (SELECT MAX(ma_hocky) FROM hoc_ky)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getHocKyNewestByMaGiangVien($maGiangVien)
    {
        $sql = "SELECT * FROM hoc_ky WHERE ma_hocky = (SELECT MAX(ma_hocky) FROM hoc_ky WHERE ma_hocky = (SELECT ma_hk FROM lop_monhoc WHERE ma_gv = ? ORDER BY ma_hk DESC LIMIT 1))";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$maGiangVien]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getListGiangVienExitstHocKyMAX()
    {
        $sql = "SELECT * FROM giang_vien WHERE ma_gv IN (SELECT ma_gv FROM lop_monhoc WHERE ma_hk = (SELECT MAX(ma_hocky) FROM hoc_ky))";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getListMonHocExitstHocKyMAX()
    {
        $sql = "SELECT * FROM mon_hoc WHERE ma_monhoc IN (SELECT ma_monhoc FROM lop_monhoc WHERE ma_hk = (SELECT MAX(ma_hocky) FROM hoc_ky))";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }



    public function getListHocKy()
    {
        return $this->SQLQueries->selectAllData('hoc_ky');
    }

    public function getListGiangVienExistsHocKy($maHocKy)
    {
        $sql = "SELECT * FROM giang_vien WHERE ma_gv IN (SELECT ma_gv FROM lop_monhoc WHERE ma_hk = ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$maHocKy]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getListMonHocExistsHocKy($maHocKy)
    {
        $sql = "SELECT * FROM mon_hoc WHERE ma_monhoc IN (SELECT ma_monhoc FROM lop_monhoc WHERE ma_hk = ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$maHocKy]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getListHocKyByMaGiangVien($maGiangVien)
    {
        $sql = "SELECT * FROM hoc_ky WHERE ma_hocky IN (SELECT ma_hk FROM lop_monhoc WHERE ma_gv = ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$maGiangVien]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}

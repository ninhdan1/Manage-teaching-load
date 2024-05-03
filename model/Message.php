<?php

require_once __DIR__ . '/../Helper/ConfigHelper.php';

require_once MODEL_PATH . 'SQLQueries.php';

class Message
{
    private $conn;
    private $SQLQueries;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->SQLQueries = new SQLQueries($this->conn);
    }

    public function themYeuCauChinhSua($magv, $tieu_de, $thongtin_chinhsua)
    {
        $sql = "INSERT INTO bao_cao (ma_gv, tieu_de, thongtin_chinhsua) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$magv, $tieu_de, $thongtin_chinhsua]);
        return $stmt->rowCount();
    }

    public function getListYeuCauChinhSua()
    {
        $sql = "SELECT bc.*, gv.* FROM bao_cao bc JOIN giang_vien gv ON bc.ma_gv = gv.ma_gv";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getListYeuCauChinhSuaByMaGiangVien($magv)
    {
        $sql = "SELECT * FROM bao_cao WHERE ma_gv = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$magv]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function sendNotificationToGiangVien($ma_gv_arr, $tieu_de, $noi_dung, $tac_gia)
    {
        $this->conn->beginTransaction();

        try {
            // Thêm thông báo vào bảng `thong_bao`
            $sql_insert_thongbao = "INSERT INTO thong_bao (tieu_de, noi_dung, tac_gia) VALUES (?, ?,?)";
            $stmt_insert_thongbao = $this->conn->prepare($sql_insert_thongbao);
            $stmt_insert_thongbao->execute([$tieu_de, $noi_dung, $tac_gia]);
            $ma_thongbao = $this->conn->lastInsertId();

            // Thêm thông báo tài khoản vào bảng `thongbao_giangvien` cho mỗi mã giảng viên trong mảng
            $sql_insert_giangvien = "INSERT INTO thongbao_giangvien (ma_gv, ma_thongbao) VALUES (?, ?)";
            $stmt_insert_giangvien = $this->conn->prepare($sql_insert_giangvien);
            foreach ($ma_gv_arr as $ma_gv) {
                $stmt_insert_giangvien->execute([$ma_gv, $ma_thongbao]);
            }


            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function getDetailByIDBaoCao($id)
    {
        $sql = "SELECT bc.*, gv.* FROM bao_cao bc JOIN giang_vien gv ON bc.ma_gv = gv.ma_gv WHERE bc.ma_baocao = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function getListThongBao()
    {
        $sql = "SELECT tb.*, gv.* , tbgv.*
        FROM thong_bao tb 
        JOIN thongbao_giangvien tbgv ON tb.ma_thongbao = tbgv.ma_thongbao 
        JOIN giang_vien gv ON tbgv.ma_gv = gv.ma_gv";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getDetailThongBaoById($id)
    {
        $sql = "SELECT tb.*, gv.* , tbgv.*
        FROM thong_bao tb 
        JOIN thongbao_giangvien tbgv ON tb.ma_thongbao = tbgv.ma_thongbao 
        JOIN giang_vien gv ON tbgv.ma_gv = gv.ma_gv Where tbgv.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getListThongBaoByMaGiangVien($magv)
    {
        $sql = "SELECT tb.* , tbgv.*
        FROM thong_bao tb 
        JOIN thongbao_giangvien tbgv ON tb.ma_thongbao = tbgv.ma_thongbao 
        WHERE tbgv.ma_gv = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$magv]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function countThongBaoCaNhan($ma_gv)
    {
        $query = "SELECT COUNT(*) as count FROM thongbao_giangvien WHERE ma_gv = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$ma_gv]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}

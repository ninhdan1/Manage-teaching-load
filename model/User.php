<?php
require_once __DIR__ . '/../DB/DBConnect.php';
class User
{
  private $conn;
  public function __construct($conn)
  {
    $this->conn = $conn;
  }
  public function selectUser($table, $columns, $condition = "", $params = [])
  {
    $sql = "SELECT $columns FROM $table";
    if (!empty($condition)) {
      $sql .= " WHERE $condition";
    }
    $stmt = $this->conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function selectUserID($table, $columns, $condition = "", $params = [])
  {
    $sql = "SELECT $columns FROM $table";
    if (!empty($condition)) {
      $sql .= " WHERE $condition";
    }
    $stmt = $this->conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
  public function insertUser($table, $data)
  {
    $columns = implode(", ", array_keys($data));
    $placeholders = rtrim(str_repeat("?, ", count($data)), ", ");
    $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute(array_values($data));
  }
  public function deleteUser($table, $condition, $params)
  {
    $sql = "DELETE FROM $table WHERE $condition";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute($params);
  }
  public function update($table, $data, $condition, $id)
  {
    $setClause = implode(" = ?, ", array_keys($data)) . " = ?";
    $sql = "UPDATE $table SET $setClause WHERE $condition";
    $values = array_values($data);
    $values[] = $id;
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute($values);
  }

  public function getTeacherNoUserUpdate()
  {
    $sql = "SELECT * FROM giang_vien WHERE ma_gv NOT IN (SELECT ma_gv FROM tai_khoan WHERE ma_gv IS NOT NULL)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getTeacherNoUserUpdate1($teacherId)
  {
    $sql = "SELECT * FROM giang_vien WHERE ma_gv NOT IN (SELECT ma_gv FROM tai_khoan WHERE ma_gv IS NOT NULL) OR ma_gv = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$teacherId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function Data($table)
  {
    $sql = "SELECT * FROM $table";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectListAccount($table, $columns, $condition = "", $params = [])
  {
    $sql = "SELECT $columns FROM $table";
    $sql .= " LEFT JOIN giang_vien ON tai_khoan.ma_gv = giang_vien.ma_gv"; // Thực hiện left join giữa bảng tài khoản và bảng môn học
    if (!empty($condition)) {
      $sql .= " WHERE $condition";
    }
    $stmt = $this->conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getAccountByMagv($magv)
  {
    $sql = "SELECT tai_khoan.*, giang_vien.* 
            FROM tai_khoan 
            JOIN giang_vien ON tai_khoan.ma_gv = giang_vien.ma_gv 
            WHERE tai_khoan.ma_gv = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$magv]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}

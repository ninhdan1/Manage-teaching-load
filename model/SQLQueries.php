<?php
class SQLQueries {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function selectData($table, $columns, $condition = "", $params = []) {
        $sql = "SELECT $columns FROM $table";
        if (!empty($condition)) {
            $sql .= " WHERE $condition";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params); // Truyền mảng $params vào hàm execute()
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

//    public function selectData($table, $columns, $condition = "") {
//        $sql = "SELECT $columns FROM $table";
//        if (!empty($condition)) {
//            $sql .= " WHERE $condition";
//        }
//        $stmt = $this->conn->prepare($sql);
//        $stmt->execute();
//        return $stmt->fetchAll(PDO::FETCH_ASSOC);
//    }

    public function insertData($table, $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = rtrim(str_repeat("?, ", count($data)), ", ");
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array_values($data));
        return $this->conn->lastInsertId();
    }

    public function updateData($table, $data, $condition) {
        $setClause = "";
        foreach ($data as $key => $value) {
            $setClause .= "$key = ?, ";
        }
        $setClause = rtrim($setClause, ", ");
        $sql = "UPDATE $table SET $setClause WHERE $condition";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array_values($data));
        return $stmt->rowCount();
    }

    public function deleteData($table, $condition) {
        $sql = "DELETE FROM $table WHERE $condition";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
?>
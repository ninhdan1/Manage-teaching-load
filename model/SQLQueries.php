<?php
class SQLQueries
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function selectAllData($table)
    {
        $sql = "SELECT * FROM $table";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectData($table, $columns, $condition = "", $params = [])
    {
        $sql = "SELECT $columns FROM $table";
        if (!empty($condition)) {
            $sql .= " WHERE $condition";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params); // Truyền mảng $params vào hàm execute()
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertData($table, $data)
    {
        try {
            // Construct the SQL query
            $columns = implode(", ", array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));
            $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

            // Prepare the statement
            $stmt = $this->conn->prepare($sql);

            // Bind parameters and execute the statement
            foreach ($data as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }
            $stmt->execute();

            // Return the last insert ID
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            // Handle any exceptions (e.g., log the error)
            error_log('Error inserting data: ' . $e->getMessage());
            return false; // Return false to indicate failure
        }
    }

    public function updateData($table, $data, $condition, $params = [])
    {
        $setClause = "";
        $values = [];
        foreach ($data as $key => $value) {
            $setClause .= "$key = ?, ";
            $values[] = $value;
        }
        $setClause = rtrim($setClause, ", ");
        $sql = "UPDATE $table SET $setClause WHERE $condition";
        $stmt = $this->conn->prepare($sql);
        $values = array_merge($values, $params);
        if (count($values) === substr_count($sql, '?')) {
            $stmt->execute($values);
            return $stmt->rowCount();
        } else {
            return "Số lượng giá trị không khớp với số lượng tham số trong truy vấn SQL";
        }
    }




    public function deleteData($table, $condition)
    {
        $sql = "DELETE FROM $table WHERE $condition";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }
}

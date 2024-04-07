<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import File Excel</title>
</head>
<body>
<h1>Import File Excel</h1>
<form action="../controller/ImportFileExcelController.php?action=import" method="post" enctype="multipart/form-data">
    <label for="fileToUpload">Chọn tệp Excel để nhập:</label><br>
    <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
    <label for="tenHocKy">Tên học kỳ:</label><br>
    <select name="tenHocKy" id="tenHocKy">
        <option value="1,3,5,7">1, 3, 5, 7</option>
        <option value="2,4,6,8">2, 4, 6, 8</option>
    </select><br><br>
    <label for="namHoc">Năm học:</label><br>
    <input type="text" name="namHoc" id="namHoc"><br><br>
    <input type="submit" value="Import" name="submit">
</form>
</body>
</html>


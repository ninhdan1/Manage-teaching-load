<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý khối lượng giảng dạy khoa CNTT</title>
  <link rel="stylesheet" href="../css/style.css">
  <script>
    src = '../js/login.js'
  </script>
</head>

<body>
  <div id="title">
    <h2>Quản lý khối lượng giảng dạy của khoa CNTT</h2>
  </div>

  <div id="login-form">
    <img src="/img/login.JPG" alt="login">
    <h2>--- Đăng nhập ---</h2>

    <form action="/controller/UserController.php?action=login" method="post" name="form-login">
      <label for="username">Tài khoản</label><br>
      <input type="text" id="username" name="username" placeholder="Vui lòng nhập tài khoản ..."><br>
      <label for="password">Mật khẩu</label><br>
      <input type="password" id="password" name="password" placeholder="Vui lòng nhập mật khẩu ..."><br>
      <div class="forget-password">
        <a href="#" onclick="alert('Vui lòng liên hệ với phòng ban khoa công nghệ thông tin')">Quên mật khẩu ?</a>
      </div>
      <p>
        <?php
        session_start();
        if (isset($_SESSION["thongbao"])) {
          echo $_SESSION["thongbao"];
          unset($_SESSION["thongbao"]);
        }
        ?>
      </p>
      <input type="submit" id="loginButton" value="Đăng nhập" disabled>
    </form>
    <script src="../js/login.js"></script>
  </div>
</body>


</html>
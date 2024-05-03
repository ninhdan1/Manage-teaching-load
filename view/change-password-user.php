<?php

$content = '
<a class="btn btn-secondary" href="/../view/thong-ke-canhan.php">Quay lại</a>
    <div style="margin-bottom:70px">
                        <div>
                            <div class="pass-text">
                                <p>Đặt lại mật khẩu </p>
                            </div>
                        </div>
                        <div id="password-form">
                            <form action="../../controller/UserController.php?action=changePassword" method="post">
                                <input type="hidden" name="username" value="<?= $_SESSION[\'username\'] ?>">
<label for="old_password">Nhập mật khẩu cũ:<span>*</span></label><br>
<input type="password" name="oldPassword" id="old_password"><br>
<label for="">Nhập mật khẩu mới:<span>*</span></label><br>
<input type="password" name="newPassword" id="new_password"><br>
<label for="">Nhập lại mật khẩu mới:<span>*</span></label><br>
<input type="password" name="re_new_password" id="re_new_password"><br>
<p>
    <?php
                                    if (isset($_SESSION["thongbao"])) {
                                        echo $_SESSION["thongbao"];
                                        unset($_SESSION["thongbao"]);
                                    }
                                    ?>
</p>
<input type="submit" value="Đổi mật khẩu">
</form>
</div>
</div>


';

require_once __DIR__ . '/../Helper/ConfigHelper.php';
include VIEW_PATH . 'user/layout-user.php';

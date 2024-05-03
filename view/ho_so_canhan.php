<?php

$content = '

<div class="mb-5">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Chi tiết hồ sơ</h1>

<a class="btn btn-secondary" href="/../view/thong-ke-canhan.php">Quay lại</a>

</div>

<div class="col">
<span class="badge rounded-pill text-bg-danger mb-3"> <a href="" class="text-decoration-none text-light"> Trang chủ </a></span>
<span class="badge rounded-pill text-bg-light mb-3"> <strong> <i class="bi bi-caret-right-fill"></i> </strong> </span>
<span class="badge rounded-pill text-bg-info mb-3">  Hồ sơ cá nhân</span>
</div>


<div class="row">
    <div class="col-xl-12 col-md-0 mb-4">
        <div class="card  h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center ml-3" >
                    <div class="col-auto">
                        <div class="rounded-circle" style="width: 50px; height: 50px; overflow: hidden; float: left; margin-right: 10px; background-color: #ccc; text-align: center; line-height: 50px;">
                            <img src="../img/7a4e6c7e11c61fc88a35d768c9555807.jpg" alt="Avatar" style="width: 100%; border-radius: 50%;">
                        </div>
                    </div>
                    <div class="col">
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="tenGiangVien"></div>
                    </div>
                    <div class="col-auto">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 mr-3">
                             KHOA CÔNG NGHỆ THÔNG TIN</div>

                </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-12 col-md-0 mb-4">
    <div class="card h-100 py-2">
        <div class="card-body">
            <form>
                <div class="row">
                    <!-- Hàng 1 -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="UserName"><b>Tài khoản</b></label>
                            <input type="text" class="form-control" id="UserName" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <div class="row">
                            <div class="col-md-11">
                                <label for="Password"><b>Mật khẩu</b></label>
                                <input type="password" class="form-control" style="margin-top:-0" id="Password" placeholder="" readonly>
                            </div>
                            <div class="col-md-1" style="margin-top:35px; margin-left:-15px">
                                
                            <div class="form-group">
                                <a href="/../view/change-password-user.php" class="btn btn-outline-warning" id="editPasswordButton">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                        
                            </div>
                            </div>
                        </div>
                           
                            
                            
                        </div>
                    </div>
                    <!-- Hàng 2 -->
                    <div class="col-md-6">
                        <div class="form-group">
                          
                            <label for="magiangvien"><b>Mã giảng viên</b></label>
                            <input type="text" class="form-control" id="magiangvien" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="hotengiangvien"><b>Họ tên giảng viên</b></label>
                        <input type="text" class="form-control" id="hotengiangvien" placeholder="" readonly>
                        </div>
                    </div>
                </div>
              
            </form>
        </div>
    </div>
</div>

</div>

</div>


<script>
$(document).ready(function() {
    UserDetail();

    function UserDetail(){    
        $.ajax({
            url: "../controller/UserController.php?action=getAccountbyMagv",
            type: "GET",
            success: function(response) {
                var data = JSON.parse(response);
                
                var result = data.data[0];

                    $("#tenGiangVien").text(result.ho_lot_gv + \' \' +  result.ten_gv);
                    $("#UserName").val(result.username);
                    $("#Password").val(result.password);
                    $("#hotengiangvien").val(result.ho_lot_gv + \' \' +  result.ten_gv);
                    $("#magiangvien").val(result.ma_gv);
            },
            error: function() {
                alert("Error");
            }
        });
    
    
    }
    

});


</script>



';


require_once __DIR__ . '/../Helper/ConfigHelper.php';
include VIEW_PATH . 'user/layout-user.php';

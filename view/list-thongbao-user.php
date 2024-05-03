<?php



$content = '
<div class="d-sm-flex align-items-center justify-content-between mb-4  ">
<h1 class="h3 mb-0 text-gray-800">Thông báo cá nhân</h1>

</div>
<div class="col">
<span class="badge rounded-pill text-bg-danger mb-3"> <a href="/view/thong-ke-canhan.php" class="text-decoration-none text-light"> Trang chủ </a></span>
<span class="badge rounded-pill text-bg-light mb-3"> <strong> <i class="bi bi-caret-right-fill"></i> </strong> </span>
<span class="badge rounded-pill text-bg-info mb-3">  Thông báo</span>
</div>


<div class="container" style="max-height: 500px;overflow-y: auto;>
    <div class="card mb-4" id="cardContainer">


    </div>

</div>

<script src="../js/load-list-thongbao-user.js"></script>

';

require_once __DIR__ . '/../Helper/ConfigHelper.php';
include VIEW_PATH . 'user/layout-user.php';

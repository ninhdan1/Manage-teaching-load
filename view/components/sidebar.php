<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/view/admin/layout-admin.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">FACULTY MANAGEMENT</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">


    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Heading -->
    <div class="sidebar-heading">
        Home
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="/view/admin/layout-admin.php">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>

    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        Functions
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="bi bi-people"></i>
            <span>Tài khoản</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="/view/list_taikhoan.php">Quản lý tài khoản</a>
            </div>
        </div>
    </li>


    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseImportExcel"
            aria-expanded="true" aria-controls="collapseImportExcel">
            <i class="fas fa-file-import"></i>
            <span>Giảng dạy</span>
        </a>
        <div id="collapseImportExcel" class="collapse" aria-labelledby="headingImportExcel"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản lý giảng dạy</h6>
                <a class="collapse-item" href="/view/import-excel.php">Import file</a>
                <a class="collapse-item" href="/controller/giangdaycontroller.php?action=index">Danh sách giảng dạy</a>
                <a class="collapse-item" href="/controller/monhoccontroller.php?action=index">Quản lý môn học</a>
            </div>
        </div>

    </li>



    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThongKe"
            aria-expanded="true" aria-controls="collapseThongKe">
            <i class="fas fa-chart-bar"></i>
            <span>Khối lượng giảng dạy</span>
        </a>
        <div id="collapseThongKe" class="collapse" aria-labelledby="headingThongKe" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Thống kê và so sánh</h6>
                <a class="collapse-item" href="/view/thong-ke-khoi-luong.php">Thống kê khối
                    lượng</a>
                <a class="collapse-item" href="/view/giang_vien_list.php">So sánh khối lượng</a>
                <a class="collapse-item" href="/view/list_tong_khoiluong.php">Tổng khối lượng</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThongBao"
            aria-expanded="true" aria-controls="collapseThongBao">
            <i class="fas fa-bell"></i>
            <span>Thông báo</span>
        </a>
        <div id="collapseThongBao" class="collapse" aria-labelledby="headingThongBao" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản lý thông báo</h6>
                <a class="collapse-item" href="/view/thong-bao.php">Gửi thông báo</a>
                <a class="collapse-item" href="/view/list-yeucau-chinhsua.php">Yêu cầu chỉnh sửa</a>
                <a class="collapse-item" href="/view/list-thongbao.php">Lịch sử thông báo</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
</ul>
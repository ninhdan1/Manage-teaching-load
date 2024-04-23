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
        Interface
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
                <h6 class="collapse-header">Account Management</h6>
                <a class="collapse-item" href="/view/list_taikhoan.php">Quản lý tài khoản</a>
            </div>
        </div>
    </li>


    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseImportExcel"
            aria-expanded="true" aria-controls="collapseImportExcel">
            <i class="bi bi-upload"></i>
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


    <!-- Nav Item - Utilities Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThongKe"
            aria-expanded="true" aria-controls="collapseThongKe">
            <i class="bi bi-upload"></i>
            <span>Thống kê</span>
        </a>
        <div id="collapseThongKe" class="collapse" aria-labelledby="headingThongKe" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Thông kê và so sánh/h6>
                    <a class="collapse-item"
                        href="/controller/ThongKeController.php?action=getListGiangDayByHocKy">Thống kê khối lượng giảng
                        dạy</a>
                    <a class="collapse-item" href="/controller/giangdaycontroller.php?action=index">Danh sách giảng
                        dạy</a>
                    <a class="collapse-item" href="/controller/monhoccontroller.php?action=index">Quản lý môn học</a>
            </div>
        </div>

    </li> -->


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThongKe"
            aria-expanded="true" aria-controls="collapseThongKe">
            <i class="bi bi-person-circle"></i>
            <span>Khối lượng giảng dạy</span>
        </a>
        <div id="collapseThongKe" class="collapse" aria-labelledby="headingThongKe" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Thống kê và so sánh</h6>
                <a class="collapse-item" href="/view/thong-ke-khoi-luong.php">Thống kê khối
                    lượng</a>
                <a class="collapse-item" href="/view/giang_vien_list.php">So sánh khối lượng</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="bi bi-person-circle"></i>
            <span>Giảng Viên</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="qly_gv.php">Giảng Viên</a>
                <a class="collapse-item" href="ds_gv.php">Danh sách GV</a>
            </div>
        </div>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Home
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <span>Dashboard</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="../../forgot-password.php">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.php">404 Page</a>
                <a class="collapse-item" href="blank.php">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="charts.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li> -->

    <!-- Nav Item - Tables -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="tables.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li> -->

    <!-- Divider -->
    <!-- <hr class="sidebar-divider d-none d-md-block"> -->



</ul>
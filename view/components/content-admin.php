 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">👋 Hi, <?= $_SESSION['username'] ?>!</h1>
     <div class="row no-gutters align-items-center">
         <div class="col mr-2 ml-2">
             <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                 Website quản lý khối lượng giảng dạy của giảng viên khoa công nghệ
                 thông tin
             </div>

         </div>
     </div>

 </div>


 <!-- Content Row -->
 <div class="row">


     <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-danger shadow h-100 py-2">
             <div class="card-body">
                 <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                             Tổng giảng viên</div>
                         <div class="h5 mb-0 font-weight-bold text-gray-800" id="countGiangVien"></div>

                     </div>
                     <div class="col-auto">
                         <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>

                     </div>
                 </div>
             </div>
         </div>
     </div>


     <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-success shadow h-100 py-2">
             <div class="card-body">
                 <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> Tổng môn học
                         </div>
                         <div class="h5 mb-0 font-weight-bold text-gray-800" id="countMonHoc"></div>
                     </div>
                     <div class="col-auto">
                         <i class="fas fa-book fa-2x text-gray-300"></i>
                     </div>
                 </div>
             </div>
         </div>
     </div>


     <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-info shadow h-100 py-2">
             <div class="card-body">
                 <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tổng số lớp
                         </div>

                         <div class="h5 mb-0 font-weight-bold text-gray-800" id="countLop"></div>

                     </div>
                     <div class="col-auto">
                         <i class="fas fa-chalkboard fa-2x text-gray-300"></i>

                     </div>
                 </div>
             </div>
         </div>
     </div>


     <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-warning shadow h-100 py-2">
             <div class="card-body">
                 <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                             Tổng sinh viên</div>
                         <div class="h5 mb-0 font-weight-bold text-gray-800" id="countSinhVien"></div>
                     </div>
                     <div class="col-auto">
                         <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>


 <div class="row">

     <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-dark shadow h-100 py-2">
             <div class="card-body">
                 <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                             Tổng số học kì</div>
                         <div class="h5 mb-0 font-weight-bold text-gray-800" id="countHocKy"></div>

                     </div>
                     <div class="col-auto">
                         <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>



                     </div>
                 </div>
             </div>
         </div>
     </div>


     <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-primary shadow h-100 py-2">
             <div class="card-body">
                 <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Tổng tài khoản
                         </div>
                         <div class="h5 mb-0 font-weight-bold text-gray-800" id="countTaiKhoan"></div>
                     </div>
                     <div class="col-auto">
                         <i class="fas fa-user fa-2x text-gray-300"></i>

                     </div>
                 </div>
             </div>
         </div>
     </div>


     <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-Secondary shadow h-100 py-2">
             <div class="card-body">
                 <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-Secondary text-uppercase mb-1">Tổng khối lượng đã xác
                             nhận
                         </div>

                         <div class="h5 mb-0 font-weight-bold text-gray-800" id="countXacNhan"></div>

                     </div>
                     <div class="col-auto">
                         <i class="fas fa-check fa-2x text-gray-300"></i>
                     </div>
                 </div>
             </div>
         </div>
     </div>


     <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-danger shadow h-100 py-2">
             <div class="card-body">
                 <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                             Tổng yêu cầu chỉnh sửa</div>
                         <div class="h5 mb-0 font-weight-bold text-gray-800" id="countYeuCauChinhSua"></div>
                     </div>
                     <div class="col-auto">
                         <i class="fas fa-edit fa-2x text-gray-300"></i>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <!-- Content Row -->

 <div class="row">

     <!-- Area Chart -->
     <div class="col-xl-8 col-lg-7">
         <div class="card shadow mb-4">
             <!-- Card Header - Dropdown -->
             <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Thống kê mới nhất</h6>

             </div>
             <!-- Card Body -->
             <div class="card-body">
                 <table class="table" id="tableThongKeNew">
                     <thead>
                         <tr>
                             <th>Tên giảng viên</th>
                             <th>Tổng số tiết</th>
                             <th>Tổng lớp</th>
                             <th>Tổng môn học</th>
                             <th>Tổng sinh viên</th>
                             <th>Tổng đồ án</th>
                         </tr>
                     </thead>
                     <tbody>

                     </tbody>
                 </table>
             </div>
         </div>
     </div>

     <!-- Pie Chart -->
     <div class="col-xl-4 col-lg-5">
         <div class="card shadow mb-4">
             <!-- Card Header - Dropdown -->
             <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Danh sách giảng viên</h6>

             </div>
             <div class="card-body" style="height: 150px; overflow: hidden;">
                 <div id="teacherList" style="margin-top: 0;"></div>
             </div>
             <!-- Card Body -->
             <!-- <div class="card-body" id="card-body-giangvien">


             </div> -->
         </div>
         <div class="card shadow mb-4">
             <!-- Card Header - Dropdown -->
             <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Danh sách môn học</h6>

             </div>
             <div class="card-body" style="height: 100px; overflow: hidden;">
                 <div id="monHocList" style="margin-top: 0;"></div>
             </div>
             <!-- Card Body -->
             <!-- <div class="card-body" id="card-body-giangvien">


             </div> -->
         </div>

     </div>
 </div>




 <script>
     $(document).ready(function() {
         countGiangVien();
         countMonHoc();
         countLop();
         countSinhVien();
         countHocKy();
         countTaiKhoan();
         countXacNhan();
         countYeuCauChinhSua();
         listThongKeMoiNhat();
         listGiangVien();
         listMonHoc();


     });

     function countGiangVien() {
         $.ajax({
             url: "/../controller/DashboardController.php?action=countGiangVien",
             type: "GET",
             success: function(response) {
                 var result = JSON.parse(response);

                 $("#countGiangVien").html(result.data.count);
             },
             error: function(xhr, status, error) {
                 console.error(error);
             },
         });
     }

     function countMonHoc() {
         $.ajax({
             url: "/../controller/DashboardController.php?action=countMonHoc",
             type: "GET",
             success: function(response) {
                 var result = JSON.parse(response);

                 $("#countMonHoc").html(result.data.count);
             },
             error: function(xhr, status, error) {
                 console.error(error);
             },
         });
     }

     function countLop() {
         $.ajax({
             url: "/../controller/DashboardController.php?action=countLop",
             type: "GET",
             success: function(response) {
                 var result = JSON.parse(response);

                 $("#countLop").html(result.data.count);
             },
             error: function(xhr, status, error) {
                 console.error(error);
             },
         });
     }

     function countSinhVien() {
         $.ajax({
             url: "/../controller/DashboardController.php?action=countSinhVien",
             type: "GET",
             success: function(response) {
                 var result = JSON.parse(response);

                 $("#countSinhVien").html(result.data.count);
             },
             error: function(xhr, status, error) {
                 console.error(error);
             },
         });
     }


     function countHocKy() {
         $.ajax({
             url: "/../controller/DashboardController.php?action=countHocKy",
             type: "GET",
             success: function(response) {
                 var result = JSON.parse(response);

                 $("#countHocKy").html(result.data.count);
             },
             error: function(xhr, status, error) {
                 console.error(error);
             },
         });
     }

     function countTaiKhoan() {
         $.ajax({
             url: "/../controller/DashboardController.php?action=countTaiKhoan",
             type: "GET",
             success: function(response) {
                 var result = JSON.parse(response);

                 $("#countTaiKhoan").html(result.data.count);
             },
             error: function(xhr, status, error) {
                 console.error(error);
             },
         });
     }

     function countXacNhan() {
         $.ajax({
             url: "/../controller/DashboardController.php?action=countXacNhan",
             type: "GET",
             success: function(response) {
                 var result = JSON.parse(response);

                 $("#countXacNhan").html(result.data.count);
             },
             error: function(xhr, status, error) {
                 console.error(error);
             },
         });
     }

     function countYeuCauChinhSua() {
         $.ajax({
             url: "/../controller/DashboardController.php?action=countYeuCauChinhSua",
             type: "GET",
             success: function(response) {
                 var result = JSON.parse(response);

                 $("#countYeuCauChinhSua").html(result.data.count);
             },
             error: function(xhr, status, error) {
                 console.error(error);
             },
         });
     }


     function listThongKeMoiNhat() {
         $.ajax({
             url: "/../controller/DashboardController.php?action=listThongKeMoiNhat",
             type: "GET",
             success: function(response) {
                 var data = JSON.parse(response);

                 var html = "";
                 data.data.forEach(function(item) {
                     html += "<tr>";
                     html += "<td>" + item.ho_giang_vien + ' ' + item.ten_giang_vien +
                         "</td>";
                     html += "<td>" + item.so_tietday + "</td>";
                     html += "<td>" + item.so_lopday + "</td>";
                     html += "<td>" + item.so_monday + "</td>";
                     html += "<td>" + item.so_sinhvienday + "</td>";
                     html += "<td>" + item.so_doan + "</td>";
                     html += "</tr>";
                 });
                 $("#tableThongKeNew").DataTable().destroy();
                 $("#tableThongKeNew tbody").html(html);
                 initializeDataTable("tableThongKeNew");




             },
             error: function(xhr, status, error) {
                 console.error(error);
             },
         });
     }

     function listGiangVien() {
         $.ajax({
             url: "/../controller/giangvienController.php?action=index",
             type: "GET",
             success: function(response) {
                 var data = JSON.parse(response);
                 var html = "";

                 data.data.forEach(function(teacher) {
                     html += "<p style='text-align: center;'><strong>" + teacher.ma_gv +
                         ' </strong> - ' +
                         teacher
                         .ho_lot_gv + ' ' +
                         teacher.ten_gv +
                         "</p>"; // Thay 'name' bằng tên trường chứa tên giảng viên trong JSON

                 });
                 // Thêm HTML vào container
                 $("#teacherList").html(html);

                 // Tính toán chiều cao của nội dung
                 var contentHeight = $("#teacherList").height();

                 // Lặp vô hạn để di chuyển nội dung lên
                 setInterval(function() {
                     $("#teacherList").animate({
                         marginTop: "-=20px"
                     }, 500, function() {
                         if (Math.abs(parseInt($(this).css('margin-top'))) >= contentHeight) {
                             $(this).css('margin-top', 0);
                         }
                     });
                 }, 2000);
             },
             error: function(xhr, status, error) {
                 console.error(error);
             },
         });
     }


     function listMonHoc() {
         $.ajax({
             url: "/../controller/monhocController.php?action=getListMonHoc",
             type: "GET",
             success: function(response) {
                 var data = JSON.parse(response);
                 var html = "";

                 data.data.forEach(function(monhoc) {
                     var hocKy = monhoc.hoc_ky_monhoc ? monhoc.hoc_ky_monhoc : '';
                     html += "<p style='text-align: center;'><strong>" + monhoc.ma_monhoc +
                         ' </strong> - ' +
                         monhoc
                         .ten_monhoc + ' - HK: ' +
                         hocKy +
                         "</p>"; // Thay 'name' bằng tên trường chứa tên giảng viên trong JSON

                 });
                 // Thêm HTML vào container
                 $("#monHocList").html(html);

                 // Tính toán chiều cao của nội dung
                 var contentHeight = $("#monHocList").height();

                 // Lặp vô hạn để di chuyển nội dung lên
                 setInterval(function() {
                     $("#monHocList").animate({
                         marginTop: "-=20px"
                     }, 500, function() {
                         if (Math.abs(parseInt($(this).css('margin-top'))) >= contentHeight) {
                             $(this).css('margin-top', 0);
                         }
                     });
                 }, 0);
             },
             error: function(xhr, status, error) {
                 console.error(error);
             },
         });
     }



     function initializeDataTable(tableId) {
         $("#" + tableId).DataTable({
             pageLength: 5,
             lengthChange: false,
             searching: false, // Tắt tính năng tìm kiếm
             language: {
                 lengthMenu: "Hiển thị _MENU_ dòng dữ liệu trên một trang",
                 info: "Hiển thị _START_ trong tổng số _TOTAL_ dòng dữ liệu",
                 infoEmpty: "Dữ liệu rỗng",
                 emptyTable: "Không có dữ liệu nào",
                 processing: "Đang xử lý...",
                 search: "<strong>Tìm kiếm</strong>",
                 loadingRecords: "Đang tải...",
                 zeroRecords: "Không tìm thấy dữ liệu",
                 infoFiltered: "(được lọc từ tổng số _MAX_ dòng dữ liệu)",
                 sSearchPlaceholder: "Nhập từ khóa...",
             },

             ordering: false,
             columnDefs: [{
                 orderable: false,
                 targets: 0
             }],
         });
     }
 </script>




 <!-- /.container-fluid -->
<?php


$content = '

<!-- Modal xác nhận -->
<div class="modal fade" id="confirmModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Xác nhận cập nhật</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn cập nhật dữ liệu này không?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" id="confirmUpdateBtn" class="btn btn-primary">Xác nhận</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit -->
<div class="modal fade" id="EditModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cập nhật môn học</h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="updateForm" class="was-validated">

          <div class="mb-3">
         
            <label for="ma_monhoc" class="col-form-label">Mã môn học:</label>
            <input type="text" class="form-control" id="ma_monhoc" readonly>
          </div>
          <div class="mb-3"  has-validation">
          <label for="ten_monhoc" class="col-form-label">Tên môn học:</label>
          <input type="text" class="form-control" id="ten_monhoc" required>
          <div class="invalid-feedback">
          Tên môn học không được để trống!
      </div>
        </div>
        <div class="mb-3">
        <label for="loai_monhoc" class="col-form-label">Loại môn học:</label>
        <select class="form-select" id="loai_monhoc">
            <option value="lt_pm">Lý thuyết tại phòng thực hành</option>
            <option value="pm">Thực hành</option>
            <option value="doan">Đồ án - Bài tập lớp</option>
            <option value="" >Chưa xác định</option>
        </select>
    </div>

    <div class="mb-3">
    <label for="hoc_ky_monhoc" class="col-form-label">Học kỳ môn học:</label>
    <select class="form-select" id="hoc_ky_monhoc">
        <option value="">Chưa xác định</option>
        <option value="1">HK01</option>
        <option value="2">HK02</option>
        <option value="3">HK03</option>
        <option value="4">HK04</option>
        <option value="5">HK05</option>
        <option value="6">HK06</option>
        <option value="7">HK07</option>
        <option value="8">HK08</option>
    </select>
</div>
        
         
        </form> 
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><strong>Đóng</strong></button>
    <button type="submit" class="btn btn-warning"  form="updateForm"><strong>Xác nhận</strong></button>
    <!-- Thêm các nút chức năng khác nếu cần -->
</div>
</div>
</div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="AddModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm môn học mới</h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="AddForm" class="was-validated">

          <div class="mb-3" has-validation">
         
            <label for="ma_monhoc_add" class="col-form-label">Mã môn học:</label>
            <input type="text" class="form-control" id="ma_monhoc_add" required>
            <div class="invalid-feedback">
            Mã môn học không được để trống!
      </div>
          </div>
          <div class="mb-3" has-validation">
          <label for="ten_monhoc_add" class="col-form-label">Tên môn học:</label>
          <input type="text" class="form-control" id="ten_monhoc_add" required>
          <div class="invalid-feedback">
          Tên môn học không được để trống!
      </div>
        </div>
        <div class="mb-3">
        <label for="loai_monhoc_add" class="col-form-label">Loại môn học:</label>
        <select class="form-select" id="loai_monhoc_add">
            <option value="null">Chưa xác định</option>
            <option value="lt_pm">Lý thuyết tại phòng thực hành</option>
            <option value="pm">Thực hành</option>
            <option value="doan">Đồ án - Bài tập lớp</option> 
        </select>
    </div>

    <div class="mb-3">
    <label for="hoc_ky_monhoc_add" class="col-form-label">Học kỳ môn học:</label>
    <select class="form-select" id="hoc_ky_monhoc_add">
        <option value="null">Chưa xác định</option>
        <option value="1">HK01</option>
        <option value="2">HK02</option>
        <option value="3">HK03</option>
        <option value="4">HK04</option>
        <option value="5">HK05</option>
        <option value="6">HK06</option>
        <option value="7">HK07</option>
        <option value="8">HK08</option>
    </select>
</div>
        
         
        </form> 
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Đóng</button>
    <button type="submit" class="btn btn-primary"  form="AddForm">Xác nhận</button>
</div>
</div>
</div>
</div>


<!-- Table môn học-->

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Giảng dạy</h1>
    
</div>
<div class="col">
<span class="badge rounded-pill text-bg-danger mb-3"> <a href="/view/admin/layout-admin.php" class="text-decoration-none text-light"> Trang chủ </a></span>
<span class="badge rounded-pill text-bg-light mb-3"> <strong> <i class="bi bi-caret-right-fill"></i> </strong> </span>
<span class="badge rounded-pill text-bg-info mb-3">  Quản lý môn học </span>
</div>


<div class="card  mb-4">

<div class="card-body">

<div class="d-grid gap-2 d-md-block mb-5">
    <button id="btnAddMonHoc" class="btn btn-primary float-md-end" type="button">Thêm môn học mới</button>
</div>

    <div class="table-responsive">
        <table id="monhocTable" class="table table-hover">
            <thead >
                <tr class="table">
                    <th class="text-center">Mã môn học</th>
                    <th class="text-center">Tên môn học</th>
                    <th class="text-center">Loại môn học</th>
                    <th class="text-center">Học kỳ môn học</th>
                </tr>
            </thead>
            <tbody>';

if (isset($data)) {
    $loai_monhoc_mapping = [
        'lt_pm' => "Lý thuyết tại phòng thực hành",
        'pm' => "Thực hành",
        'doan' => "Đồ án - Bài tập lớp",
    ];
    $badge_color_mapping = [
        'lt_pm' => "danger",
        'pm' => "success",
        'doan' => "warning",
        'default' => "secondary"



    ];
    $hoc_ky_monhoc_mapping = [
        '1' => 'HK01',
        '2' => 'HK02',
        '3' => 'HK03',
        '4' => 'HK04',
        '5' => 'HK05',
        '6' => 'HK06',
        '7' => 'HK07',
        '8' => 'HK08',
    ];

    $badge_color_hk_mapping = [
        '1' => 'info',
        '2' => 'danger',
        '3' => 'info',
        '4' => 'danger',
        '5' => 'info',
        '6' => 'danger',
        '7' => 'info',
        '8' => 'danger',
        'default' => 'secondary'
    ];


    foreach ($data as $item) {
        $loai_monhoc = isset($loai_monhoc_mapping[$item['loai_monhoc']]) ? $loai_monhoc_mapping[$item['loai_monhoc']] : "Chưa xác định";
        $badge_color = isset($badge_color_mapping[$item['loai_monhoc']]) ? $badge_color_mapping[$item['loai_monhoc']] : $badge_color_mapping['default'];
        $hoc_ky_monhoc = isset($hoc_ky_monhoc_mapping[$item['hoc_ky_monhoc']]) ? $hoc_ky_monhoc_mapping[$item['hoc_ky_monhoc']] : "Chưa xác định";
        $badge_color_hk = isset($badge_color_hk_mapping[$item['hoc_ky_monhoc']]) ? $badge_color_hk_mapping[$item['hoc_ky_monhoc']] : $badge_color_hk_mapping['default'];
        $content .= '
                            <tr onclick="showModal(\'' . $item['ma_monhoc'] . '\')">
                                <td class="text-center font-weight-bold ">' . $item['ma_monhoc'] . '</td>
                                <td class="text-center">' . $item['ten_monhoc'] . '</td>
                                <td class="text-center"><span class="badge bg-' . $badge_color . '">' . $loai_monhoc . '</span></td>
                                <td class="text-center"><span class="badge bg-' . $badge_color_hk . '">' . $hoc_ky_monhoc . '</span></td>
                            </tr>';
    }
} else {
    $content .= '
                <tr>
                    <td class="text-center" colspan="6">Không có dữ liệu</td>
                </tr>';
}

$content .= '
            </tbody>
        </table>

    </div>
</div>
</div>


<script src="/js/modal/modal-update-monhoc.js"></script>

<script>
$(document).ready(function() {

    $("#updateForm").submit(function(e) {
        e.preventDefault(); 
        var maMonHoc = $("#ma_monhoc").val();
        var tenMonHoc = $("#ten_monhoc").val();
        var loaiMonHoc = $("#loai_monhoc").val();
        var hocKyMonHoc = $("#hoc_ky_monhoc").val();

        $("#EditModal").modal("hide");


        $("#confirmModal").modal("show");


        $("#confirmUpdateBtn").off("click").on("click", function() {
            // Gửi AJAX request
            $.ajax({
                url: "../controller/MonHocController.php?action=update",
                type: "POST",
                data: { ma_monhoc: maMonHoc, ten_monhoc: tenMonHoc, loai_monhoc: loaiMonHoc, hoc_ky_monhoc: hocKyMonHoc},
                success: function(response) {
                    if (response.success) {

                    $("#confirmModal").modal("hide");
                    $("#EditModal").modal("hide");

               
                    toastr.success(response.message, { timeOut: 1000 });

                    
                    setTimeout(function() {
                        location.reload();
                      }, 300);

                } else {
                    toastr.error(response.message, { timeOut: 3000 });
                }

                },
                error: function(xhr, status, error) {
                    toastr.error(\'Lỗi khi cập nhật dữ liệu: \' + xhr.responseText, { timeOut: 3000 });
                }
            });
        });
    });

    $("#confirmModal").on("hidden.bs.modal", function() {
      $("#EditModal").modal("show");
  });


    $("#btnAddMonHoc").click(function() {
      $("#AddModal").modal("show");
      });
  
      $("#AddForm").submit(function(e) {
          e.preventDefault(); 
          var maMonHoc = $("#ma_monhoc_add").val();
          var tenMonHoc = $("#ten_monhoc_add").val();
          var loaiMonHoc = $("#loai_monhoc_add").val();
          var hocKyMonHoc = $("#hoc_ky_monhoc_add").val();
          
  
              $.ajax({         
                  url: "../controller/MonHocController.php?action=insert",
                  type: "POST",
                  data: { ma_monhoc: maMonHoc, ten_monhoc: tenMonHoc, loai_monhoc: loaiMonHoc, hoc_ky_monhoc: hocKyMonHoc},
                  success: function(response) {
                   
                    if (response.success) {

                        toastr.success(response.message, { timeOut: 1000 });
                        $("#ma_monhoc_add").val(\'\');
                        $("#ten_monhoc_add").val(\'\');
                        $("#loai_monhoc_add").val(\'null\');
                        $("#hoc_ky_monhoc_add").val(\'null\');
                    } else {
                        toastr.error(response.message, { timeOut: 3000 });
                    }
                    
                  },
                  error: function(xhr, status, error) {
                      toastr.error(\'Lỗi khi thêm mới dữ liệu: \' + xhr.responseText, { timeOut: 3000 });
                  }
          });
      });

      $("#AddModal").on("hidden.bs.modal", function() {
        location.reload();
    }); 
  });
  
</script>


';

require_once __DIR__ . '/../Helper/ConfigHelper.php';
include VIEW_PATH . 'admin/layout-admin.php';

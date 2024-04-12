<?php

$content = '

<!-- Modal xác nhận -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
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



<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Chi tiết giảng dạy</h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="updateForm" class="was-validated">
      <div class="row">
      <div class="col-md-6">
          <div class="mb-3">
         
            <label for="ma_lopmonhoc" class="col-form-label">Mã lớp môn học:</label>
            <input type="text" class="form-control" id="ma_lopmonhoc" readonly>
          </div>
          <div class="mb-3">
          <label for="thu" class="col-form-label">Thứ:</label>
          <input type="text" class="form-control" id="thu" readonly>
        </div>
        <div class="mb-3">
            <label for="tiet_batdau" class="col-form-label">Tiết bắt đầu:</label>
            <input type="text" class="form-control" id="tiet_batdau" readonly>
        </div>
        <div class="mb-3">
        <label for="ma_gv" class="col-form-label">Mã giảng viên:</label>
        <input type="text" class="form-control" id="ma_gv" readonly>
      </div>

        <div class="mb-3">
        <label for="ma_monhoc" class="col-form-label">Mã môn học:</label>
        <input type="text" class="form-control" id="ma_monhoc" readonly>
      </div>
        <div class="mb-3">
            <label for="so_tiet" class="col-form-label">Số tiết:</label>
            <input type="text" class="form-control" id="so_tiet" readonly>
        </div>

        <div class="mb-3">
            <label for="so_tietmonhoc" class="col-form-label">Số tiết môn học:</label>
            <input type="text" class="form-control" id="so_tietmonhoc" readonly>
        </div>

          <div class="mb-3">
            <label for="ten_phong" class="col-form-label">Tên phòng:</label>
            <input type="text" class="form-control" id="ten_phong" readonly>
          </div>
         
          </div>

          <div class="col-md-6">
          <div class="mb-3 has-validation">
          <label for="si_solop" class="col-form-label">Sĩ số lớp:</label>
          <input type="number" class="form-control" id="si_solop" pattern="[0-9]+" title="Vui lòng nhập số nguyên dương">
          <div class="invalid-feedback">
          Sĩ số lớp không được để trống và phải là số nguyên dương!
      </div>
        </div>
          <div class="mb-3">
            <label for="ma_lophoc" class="col-form-label">Mã lớp học:</label>
            <input type="text" class="form-control" id="ma_lophoc" readonly>
          </div>

          <div class="mb-3">
            <label for="ngay_batdau" class="col-form-label">Ngày bắt đầu:</label>
            <input type="text" class="form-control" id="ngay_batdau" readonly>
          </div>
          <div class="mb-3">
          <label for="thoigian_hoc" class="col-form-label">Thời gian học:</label>
          <input type="text" class="form-control" id="thoigian_hoc" readonly>
        </div>
          <div class="mb-3">
            <label for="tiet_hoc" class="col-form-label">Tiết học:</label>
            <input type="text" class="form-control" id="tiet_hoc" readonly>
          </div>
          <div class="mb-3">
            <label for="ma_hk" class="col-form-label">Học kì:</label>
            <input type="text" class="form-control" id="ma_hk" readonly>
          </div>
          <div class="mb-3">
          <label for="ma_lop" class="col-form-label">Lớp:</label>
          <input type="text" class="form-control" id="ma_lop" readonly>
        </div>
        </div>
        </div>
        </form> 
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Đóng</button>
    <button type="submit" class="btn btn-warning"  form="updateForm">Cập nhật</button>
    <!-- Thêm các nút chức năng khác nếu cần -->
</div>
</div>
</div>
</div>




<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> Danh sách giảng dạy</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">

            <table id="giangdayTable" class="table table-borderless table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Mã</th>
                        <th class="text-center">Tên phòng</th>
                        <th class="text-center">Sĩ số</th>
                        <th class="text-center">Mã môn học</th>
                        <th class="text-center">Mã lớp học</th>
                        <th class="text-center">Mã giảng viên</th>
                        <th class="text-center">Ngày bắt đầu</th>
                        <th class="text-center">Tiết học</th>
                        <th class="text-center">Học kì</th>

                    </tr>
                </thead>
                <tbody>';

if (isset($data)) {
  foreach ($data as $item) {
    $content .= '
                    <tr onclick="showModal(' . $item['ma_lopmonhoc'] . ')">
                        <td class="text-center font-weight-bold ">' . $item['ma_lopmonhoc'] . '</td>
                        <td class="text-center">' . $item['ten_phong'] . '</td>
                        <td class="text-center">' . $item['si_solop'] . '</td>
                        <td class="text-center">' . $item['ten_monhoc'] . '</td>
                        <td class="text-center">' . $item['ma_lophoc'] . '</td>
                        <td class="text-center">' . $item['ho_lot_gv'] . ' ' . $item['ten_gv'] . '</td>
                        <td class="text-center">' . $item['ngay_batdau'] . '</td>
                        <td class="text-center">' . $item['tiet_hoc'] . '</td>
                        <td class="text-center">' . $item['ten_hocky'] . ' - ' . $item['nam_hoc'] . '</td>
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


<script src="/js/modal/modal-detail-giangday.js"></script>

<script>
$(document).ready(function() {
    $(".editButton").click(function() {
        // Hiển thị modal cập nhật
        $("#EditModal").modal("show");
    });

    $("#updateForm").submit(function(e) {
        e.preventDefault(); 
        var maLopMonHoc = $("#ma_lopmonhoc").val();
        var siSo = $("#si_solop").val();

        // Ẩn modal cập nhật
        $("#EditModal").modal("hide");

        // Hiển thị modal xác nhận
        $("#confirmModal").modal("show");

        // Xử lý sự kiện khi nút xác nhận trong modal xác nhận được click
        $("#confirmUpdateBtn").click(function() {
            // Gửi AJAX request
            $.ajax({
                url: "../controller/GiangDayController.php?action=updateSiSo",
                type: "POST",
                data: { ma_lopmonhoc: maLopMonHoc, si_solop: siSo },
                success: function(response) {
                    // Ẩn modal xác nhận
                    $("#confirmModal").modal("hide");
                    $("#EditModal").modal("hide");

                    // Hiển thị thông báo thành công
                    toastr.success(\'Cập nhật dữ liệu thành công!\', { timeOut: 1000 });


                    // Load lại dữ liệu trên trang
                    setTimeout(function() {
                      // Làm mới trang để cập nhật dữ liệu mới
                      location.reload();
                    }, 300);
                    

                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi nếu cần
                    console.error(error);
                }
            });
        });
    });

    $("#confirmModal").on("hidden.bs.modal", function() {
      $("#EditModal").modal("show");
  });
});
</script>

';


// Include file layout-admin.php
include '../view/admin/layout-admin.php';

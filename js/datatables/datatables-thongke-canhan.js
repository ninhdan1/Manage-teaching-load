$(document).ready(function () {
  loadHocKyCaNhan();
  loadThongKeFirst();
  loadTongThongKeFirst();
  UserDetail();

  $("#maHocKyUser").change(function () {
    var maHocKy = $(this).val();
    thongKeCaNhan(maHocKy);
    khoiLuongTongCaNhan(maHocKy);
  });

  $("#btnXacNhanUpdate").click(function () {
    $("#confirmModal").modal("show");
  });

  $("#confirmUpdateBtn").click(function () {
    var maHocKy = $("#maHocKyUser").val();
    xacNhanKhoiLuong(maHocKy, 1);
    $("#confirmModal").modal("hide");
    setTimeout(function () {
      location.reload();
    }, 300);
  });

  $("#btnYeuCauChinhSua").click(function () {
    $("#yeuCauChinhSua").modal("show");
  });

  $("#postYeuCauForm").submit(function (e) {
    e.preventDefault();
    yeuCauChinhSuaKhoiLuong();
    $("#yeuCauChinhSua").modal("hide");
    setTimeout(function () {
      location.reload();
    }, 300);
  });
});

function UserDetail() {
  $.ajax({
    url: "../controller/UserController.php?action=getAccountbyMagv",
    type: "GET",
    success: function (response) {
      var data = JSON.parse(response);

      $("#hotengiangvien").html(
        "👋 Hi, " + data.data[0].ho_lot_gv + " " + data.data[0].ten_gv + "!"
      );
    },
  });
}

function yeuCauChinhSuaKhoiLuong() {
  $.ajax({
    url: "../controller/usercontroller.php?action=themYeuCauChinhSua",
    type: "POST",
    data: {
      tieu_de: $("#tieude").val(),
      thongtin_chinhsua: $("#noidung").val(),
    },

    success: function (response) {
      var data = JSON.parse(response);
      if (data.success) {
        toastr.success("Yêu cầu chỉnh sửa đã được gửi");
      } else {
        toastr.error("Gửi yêu cầu thất bại");
      }
    },
  });
}

function xacNhanKhoiLuong(mahocky, xacnhan) {
  $.ajax({
    url:
      "../controller/usercontroller.php?action=updateXacNhanKhoiLuong&maHocKy=" +
      mahocky +
      "&xacnhan=" +
      xacnhan,
    type: "POST",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.success) {
        toastr.success("Xác nhận khối lượng giảng dạy thành công");
      } else {
        toastr.error("Xác nhận khối lượng giảng dạy thất bại");
      }
    },
  });
}

function loadTongThongKeFirst() {
  $.ajax({
    url: "../controller/usercontroller.php?action=getTongKhoiLuongMaHocKyMax",
    type: "GET",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.success) {
        var result = data.data[0];
        $("#tongsotiet").text(result.so_tietday);
        $("#tongsinhvien").text(result.so_sinhvienday);
        $("#tongmonhoc").text(result.so_monday);
        $("#tonglop").text(result.so_lopday);
        $("#tongdoan").text(result.so_doan);
        if (result.xac_nhan === "0") {
          $("#isActive")
            .text("Chưa xác nhận")
            .addClass("badge badge-Secondary");
        } else {
          $("#isActive").text("Đã xác nhận").addClass("badge badge-success");
          $("#btnXacNhanUpdate").prop("disabled", true);
        }
      }
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function khoiLuongTongCaNhan($maHocKy) {
  $.ajax({
    url:
      "../controller/usercontroller.php?action=getDetailTongKhoiLuongGiangDayByHocKy&maHocKy=" +
      $maHocKy,
    type: "GET",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.success) {
        var result = data.data[0];

        $("#tongsotiet").text(result.so_tietday);
        $("#tongsinhvien").text(result.so_sinhvienday);
        $("#tongmonhoc").text(result.so_monday);
        $("#tonglop").text(result.so_lopday);
        $("#tongdoan").text(result.so_doan);
        if (result.xac_nhan === "0") {
          $("#isActive")
            .text("Chưa xác nhận")
            .addClass("badge badge-Secondary");
          $("#btnXacNhanUpdate").removeAttr("disabled");
        } else {
          $("#isActive").text("Đã xác nhận").addClass("badge badge-success");
          $("#btnXacNhanUpdate").prop("disabled", true);
        }
      }
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function loadThongKeFirst() {
  $.ajax({
    url: "../controller/usercontroller.php?action=getHocKyNewestByMaGiangVien",
    type: "GET",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.success) {
        var maHocKy = data.data[0].ma_hocky;
        $("#maHocKyUser").val(data.data[0].ma_hocky);
        thongKeCaNhan(maHocKy);
      }
    },
  });
}

function thongKeCaNhan(maHocKy) {
  $.ajax({
    url:
      "../controller/usercontroller.php?action=getListGiangDayByHocKyAndMaGiangVien&maHocKy=" +
      maHocKy,
    type: "GET",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.success) {
        var html = "";

        data.data.forEach(function (item, index) {
          html += "<tr>";
          html += "<td>" + (index + 1) + "</td>";
          html += "<td>" + item.ten_monhoc + "</td>";
          html +=
            "<td>" + item.danh_sach_ma_lophoc.replace(/\n/g, "<br>") + "</td>"; // Danh sách mã lớp học
          html += "<td>" + item.tong_si_so + "</td>"; // Tổng số lượng sinh viên
          html +=
            "<td>" +
            parseInt(item.so_tietmonhoc) / parseInt(item.so_tiet) +
            "</td>"; // Số giờ 1 sinh viên
          html += "<td>" + parseInt(item.tong_si_so / item.tong_lop) + "</td>"; // Số sinh viên 1 ca
          html += "<td>" + item.tong_lop + "</td>"; // Số Nhóm
          html +=
            "<td>" +
            parseInt(
              item.tong_lop *
                (parseInt(item.so_tietmonhoc) / parseInt(item.so_tiet))
            ) +
            "</td>"; // Số ca thực hành
          html +=
            "<td>" +
            parseInt(
              item.tong_lop *
                (parseInt(item.so_tietmonhoc) / parseInt(item.so_tiet))
            ) *
              parseInt(item.so_tiet) +
            "</td>";

          var loaiMonHoc = "";
          if (item.loai_monhoc === "pm") {
            loaiMonHoc = "Thực hành";
          } else if (item.loai_monhoc === "doan") {
            loaiMonHoc = "Đồ án - bài tập lớn";
          } else if (item.loai_monhoc === "lt_pm") {
            loaiMonHoc = "Lý thuyết tại phòng máy";
          } else {
            loaiMonHoc = "";
          }

          html += "<td>" + loaiMonHoc + "</td>";

          if (item.hoc_ky_monhoc !== "") {
            html += "<td>" + item.hoc_ky_monhoc + "</td>";
          } else {
            html += "<td>" + " " + "</td>";
          }
          html += "</tr>";
        });

        $("#thongKeCaNhanTable").DataTable().destroy();
        $("#thongKeCaNhanTable tbody").html(html);
        initializeDataTable("thongKeCaNhanTable");
      }
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function loadHocKyCaNhan() {
  $.ajax({
    url: "../controller/usercontroller.php?action=getListHocKyByMaGiangVien",
    type: "GET",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.success) {
        data.data.sort((a, b) => b.ma_hocky - a.ma_hocky);
        var html = ""; // Thêm option mặc định
        data.data.forEach(function (item) {
          if (item.ten_hocky == 1) {
            hocKyRoman = "I";
          } else if (item.ten_hocky == 2) {
            hocKyRoman = "II";
          } else if (item.ten_hocky == 3) {
            hocKyRoman = "III";
          }

          html +=
            '<option value="' +
            item.ma_hocky +
            '">Học kỳ: ' +
            hocKyRoman +
            " Năm học: " +
            item.nam_hoc +
            "-" +
            (parseInt(item.nam_hoc) + 1) +
            "</option>";
        });

        $("#maHocKyUser").html(html); // Đặt HTML mới cho select box

        $("#maHocKyUser").select2({
          theme: "bootstrap-5",
        });
      }
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function initializeDataTable(tableId) {
  $("#" + tableId).DataTable({
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
    columnDefs: [{ orderable: false, targets: 0 }],
  });
}

$(document).ready(function () {
  function chonLoaiMonHoc(loaiMonHoc) {
    thongKeKhoiLuongGiangDay(loaiMonHoc);
  }

  $("#thucHanhButton").click(function () {
    $(this).addClass("active");
    $("#lyThuyetThucHanhButton, #doAnButton").removeClass("active");
    $("#lyThuyetThucHanhButton, #doAnButton").prop("disabled", false);
    $("#lyThuyetThucHanhLayout, #doAnLayout").hide();
    $("#thucHanhLayout").show();
    chonLoaiMonHoc("pm");
  });

  $("#lyThuyetThucHanhButton").click(function () {
    $(this).addClass("active");
    $("#thucHanhButton, #doAnButton").removeClass("active");
    $("#thucHanhButton, #doAnButton").prop("disabled", false);
    $("#thucHanhLayout, #doAnLayout").hide();
    $("#lyThuyetThucHanhLayout").show();
    chonLoaiMonHoc("lt_pm");
  });

  $("#doAnButton").click(function () {
    $(this).addClass("active");
    $("#thucHanhButton, #lyThuyetThucHanhButton").removeClass("active");
    $("#thucHanhButton, #lyThuyetThucHanhButton").prop("disabled", false);
    $("#thucHanhLayout, #lyThuyetThucHanhLayout").hide();
    $("#doAnLayout").show();
    chonLoaiMonHoc("doan");
  });

  function thongKeKhoiLuongGiangDay(loaiMonHoc) {
    var maHocKy = $("#maHocKy").val();
    $.ajax({
      url:
        "../controller/thongkecontroller.php?action=getListGiangDayByHocKyAndLoaiMonHoc&maHocKy=" +
        maHocKy +
        "&loaiMonHoc=" +
        loaiMonHoc,
      type: "GET",
      success: function (response) {
        var data = JSON.parse(response);
        if (data.success) {
          if (loaiMonHoc == "pm") {
            var html = "";
            var displayedSubjects = {}; // Lưu trữ các môn học đã được hiển thị
            var rowCount = {}; // Đếm số lượng hàng cần rowspan cho cột môn học
            var index = 1; // Số thứ tự ban đầu

            // Đếm số lượng môn học trùng nhau
            // data.data.forEach(function (item) {
            //   if (!(item.ten_monhoc in rowCount)) {
            //     rowCount[item.ten_monhoc] = 1;
            //   }
            //   rowCount[item.ten_monhoc]++;
            // });

            data.data.forEach(function (item) {
              html += "<tr>";

              // Kiểm tra xem môn học hiện tại có trùng với môn học trước đó không
              if (!(item.ten_monhoc in displayedSubjects)) {
                // Nếu không trùng, thêm cột số thứ tự và cột môn học với rowspan
                // html +=
                //   "<td rowspan='" +
                //   rowCount[item.ten_monhoc] +
                //   "'>" +
                //   index +
                //   "</td>";
                // html +=
                //   "<td rowspan='" +
                //   rowCount[item.ten_monhoc] +
                //   "'>" +
                //   item.ten_monhoc +
                //   "</td>";

                html += "<td><strong>" + index + "</strong></td>"; // Số thứ tự
                html += "<td><strong>" + item.ten_monhoc + "</strong></td>"; // Tên môn học

                displayedSubjects[item.ten_monhoc] = true;
              } else {
                html += "<td></td>";
                html += "<td></td>";
              }

              // Tiếp tục với các cột dữ liệu khác
              html +=
                "<td>" +
                item.danh_sach_ma_lophoc.replace(/\n/g, "<br>") +
                "</td>"; // Danh sách mã lớp học
              html += "<td>" + item.tong_si_so + "</td>"; // Tổng số lượng sinh viên
              html +=
                "<td>" +
                parseInt(item.so_tietmonhoc) / parseInt(item.so_tiet) +
                "</td>"; // Số giờ 1 sinh viên
              html +=
                "<td>" + parseInt(item.tong_si_so / item.tong_lop) + "</td>"; // Số sinh viên 1 ca
              html += "<td>" + item.tong_lop + "</td>"; // Số Nhóm
              html +=
                "<td>" +
                parseInt(
                  item.tong_lop *
                    (parseInt(item.so_tietmonhoc) / parseInt(item.so_tiet))
                ) +
                "</td>"; // Số ca thực hành
              html += "<td><strong>" + item.ho_lot_gv + "</strong></td>"; // Họ gv1
              html += "<td><strong>" + item.ten_gv + "</strong></td>"; // Tên gv1
              html +=
                "<td>" +
                parseInt(
                  item.tong_lop *
                    (parseInt(item.so_tietmonhoc) / parseInt(item.so_tiet))
                ) *
                  parseInt(item.so_tiet) +
                "</td>"; // Số tiết 1
              html += "<td>" + " " + "</td>"; // Họ gv2
              html += "<td>" + " " + "</td>"; // Tên gv2
              html += "<td>" + " " + "</td>"; // Số ca
              html += "<td>" + " " + "</td>"; // Số tiết 2

              html += "</tr>";

              // Tăng số thứ tự cho mỗi hàng mới, chỉ khi không có môn học trùng lặp
              if (!(item.ten_monhoc in displayedSubjects)) {
                index++;
              }
            });

            $("#thucHanhTable").DataTable().destroy();
            $("#thucHanhTable tbody").html(html);
            initializeDataTable("thucHanhTable");
          }

          if (loaiMonHoc == "lt_pm") {
            var html = "";
            var displayedSubjects = {}; // Lưu trữ các môn học đã được hiển thị
            var rowCount = {}; // Đếm số lượng hàng cần rowspan cho cột môn học
            var index = 1; // Số thứ tự ban đầu

            // // Đếm số lượng môn học trùng nhau
            // data.data.forEach(function (item) {
            //   if (!(item.ten_monhoc in rowCount)) {
            //     rowCount[item.ten_monhoc] = 1;
            //   }
            //   rowCount[item.ten_monhoc]++;
            // });

            data.data.forEach(function (item) {
              html += "<tr>";

              // Kiểm tra xem môn học hiện tại có trùng với môn học trước đó không
              if (!(item.ten_monhoc in displayedSubjects)) {
                // Nếu không trùng, thêm cột số thứ tự và cột môn học với rowspan
                // html +=
                //   "<td rowspan='" +
                //   rowCount[item.ten_monhoc] +
                //   "'>" +
                //   index +
                //   "</td>";
                // html +=
                //   "<td rowspan='" +
                //   rowCount[item.ten_monhoc] +
                //   "'>" +
                //   item.ten_monhoc +
                //   "</td>";

                html += "<td><strong>" + index + "</strong></td>";
                html += "<td><strong>" + item.ten_monhoc + "</strong></td>";

                displayedSubjects[item.ten_monhoc] = true;
                index++;
              } else {
                html += "<td></td>";
                html += "<td></td>";
              }

              // Tiếp tục với các cột dữ liệu khác
              html +=
                "<td>" +
                item.danh_sach_ma_lophoc.replace(/\n/g, "<br>") +
                "</td>"; // Danh sách mã lớp học
              html += "<td>" + item.tong_si_so + "</td>"; // Tổng số lượng sinh viên
              html += "<td>" + item.so_tietmonhoc + "</td>"; // Số giờ 1 sinh viên
              html +=
                "<td>" + parseInt(item.tong_si_so / item.tong_lop) + "</td>"; // Số sinh viên 1 ca
              html += "<td>" + item.tong_lop + "</td>"; // Số Nhóm
              html += "<td><strong>" + item.ho_lot_gv + "</strong></td>"; // Họ gv1
              html += "<td><strong>" + item.ten_gv + "</strong></td>"; // Tên gv1
              html +=
                "<td>" + parseInt(item.so_tietmonhoc * item.tong_lop) + "</td>"; // Số tiết 1
              html += "<td>" + " " + "</td>"; // Họ gv2
              html += "<td>" + " " + "</td>"; // Tên gv2
              html += "<td>" + " " + "</td>"; // Số tiết 2
              html += "<td>" + " " + "</td>"; // Sáng
              html += "<td>" + " " + "</td>"; // Tối

              html += "</tr>";

              // Tăng số thứ tự cho mỗi hàng mới, chỉ khi không có môn học trùng lặp
              if (!(item.ten_monhoc in displayedSubjects)) {
                index++;
              }
            });

            // Destroy the existing DataTable
            $("#lyThuyetThucHanhTable").DataTable().destroy();

            // Replace the table body content
            $("#lyThuyetThucHanhTable tbody").html(html);

            // Reinitialize DataTable
            initializeDataTable("lyThuyetThucHanhTable");
          }

          if (loaiMonHoc == "doan") {
            var html = "";
            var displayedSubjects = {};
            var displayedMaLopHoc = {};
            var index = 1;

            data.data.forEach(function (item) {
              html += "<tr>";

              if (!(item.ten_monhoc in displayedSubjects)) {
                html += "<td><strong>" + index + "</strong></td>"; // Số thứ tự
                html += "<td><strong>" + item.ten_monhoc + "</strong></td>"; // Tên môn học

                displayedSubjects[item.ten_monhoc] = true;
              } else {
                html += "<td></td>";
                html += "<td></td>";
              }

              if (!(item.danh_sach_ma_lophoc in displayedMaLopHoc)) {
                // Nếu chưa xuất hiện, hiển thị giá trị và đánh dấu là đã xuất hiện
                html +=
                  "<td>" +
                  item.danh_sach_ma_lophoc.replace(/\n/g, "<br>") +
                  "</td>";
                displayedMaLopHoc[item.danh_sach_ma_lophoc] = true;
              } else {
                // Nếu đã xuất hiện, không hiển thị gì cả
                html += "<td></td>";
              }

              // Tiếp tục với các cột dữ liệu khác
              html += "<td>" + item.tong_si_so + "</td>";
              html +=
                "<td>" +
                parseInt(item.so_tietmonhoc) / parseInt(item.so_tiet) +
                "</td>";
              html +=
                "<td>" + parseInt(item.tong_si_so / item.tong_lop) + "</td>";
              html += "<td>" + item.tong_lop + "</td>";
              html +=
                "<td>" +
                parseInt(
                  item.tong_lop *
                    (parseInt(item.so_tietmonhoc) / parseInt(item.so_tiet))
                ) +
                "</td>";
              html += "<td><strong>" + item.ho_lot_gv + "</strong></td>";
              html += "<td><strong>" + item.ten_gv + "</strong></td>";
              html += "<td>" + " " + "</td>";
              html += "<td>" + " " + "</td>";
              html += "<td>" + " " + "</td>";

              html += "</tr>";

              // // Tăng số thứ tự cho mỗi hàng mới, chỉ khi không có môn học trùng lặp
              // if (!(item.ten_monhoc in displayedSubjects)) {
              //   index++;
              // }
            });

            // Destroy the existing DataTable
            $("#doAnTable").DataTable().destroy();

            // Replace the table body content
            $("#doAnTable tbody").html(html);

            // Reinitialize DataTable
            initializeDataTable("doAnTable");
          }
        } else {
          // Handle error
          console.log(data.message);
        }
      },
      error: function (xhr, status, error) {
        // Handle error
        console.error(error);
      },
    });
  }

  function initializeDataTable(tableId) {
    $("#" + tableId).DataTable({
      pageLength: 10,
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

      layout: {
        topStart: {
          buttons: [
            {
              extend: "copy",
              className: "btn btn-secondary",
              text: '<i class="fas fa-copy"></i> Copy',
            },
            {
              extend: "csv",
              className: "btn btn-primary",
              text: '<i class="fas fa-file-csv"></i> CSV',
            },
            {
              extend: "excel",
              className: "btn btn-success",
              text: '<i class="fas fa-file-excel"></i> Excel',
            },
            {
              extend: "pdf",
              className: "btn btn-danger",
              text: '<i class="fas fa-file-pdf"></i> PDF', // Thêm class của Bootstrap vào đây
            },
            {
              extend: "print",
              className: "btn btn-info",
              text: '<i class="fas fa-print"></i> Print', // Thêm class của Bootstrap vào đây
            },

            // Tương tự với các nút khác
          ],
        },
      },

      ordering: false,
      columnDefs: [{ orderable: false, targets: 0 }],
    });
  }
});

$(document).ready(function () {
  $("#tongKhoiLuongTable").DataTable({
    language: {
      lengthMenu: "Hiển thị _MENU_ dòng dữ liệu trên một trang",
      info: "Hiển thị _START_ trong tổng số _TOTAL_ dòng dữ liệu",
      infoEmpty: "Dữ liệu rỗng",
      emptyTable: "Không có dữ liệu nào",
      processing: "Đang xử lý...",
      search: "Tìm kiếm:",
      loadingRecords: "Đang tải...",
      zeroRecords: "Không tìm thấy dữ liệu",
      infoFiltered: "(được lọc từ tổng số _MAX_ dòng dữ liệu)",
      sSearchPlaceholder: "Nhập từ khóa tìm kiếm...",
    },
  });

  loadTongKhoiLuong();
});

function loadTongKhoiLuong() {
  $.ajax({
    url: "../controller/SoSanhController.php?action=getListTongKhoiLuongGiangDay",
    type: "GET",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.success) {
        var tableHtml = "";
        data.data.forEach(function (item) {
          if (item.ten_hocky == 1) {
            hocKyRoman = "I";
          } else if (item.ten_hocky == 2) {
            hocKyRoman = "II";
          } else if (item.ten_hocky == 3) {
            hocKyRoman = "III";
          }
          tableHtml += "<tr>";
          tableHtml +=
            "<td>" +
            "HK" +
            hocKyRoman +
            "   " +
            item.nam_hoc +
            " - " +
            (parseInt(item.nam_hoc) + 1) +
            "</td>";
          tableHtml += "<td>" + item.ho_lot_gv + " " + item.ten_gv + "</td>";
          tableHtml += '<td class="text-center">' + item.so_tietday + "</td>";
          tableHtml += '<td class="text-center">' + item.so_monday + "</td>";
          tableHtml += '<td class="text-center">' + item.so_lopday + "</td>";
          tableHtml +=
            '<td class="text-center">' + item.so_sinhvienday + "</td>";
          tableHtml += '<td class="text-center">' + item.so_doan + "</td>";

          if (item.xac_nhan == 1) {
            tableHtml +=
              "<td><span class='badge badge-success text-center'>Đã xác nhận</span></td>";
          } else {
            tableHtml +=
              "<td><span class='badge badge-warning text-center'>Chưa xác nhận</span></td>";
          }
          tableHtml += "</tr>";
        });
        $("#tongKhoiLuongTable").DataTable().destroy();
        $("#tongKhoiLuongTable tbody").html(tableHtml);
        initializeDataTable("tongKhoiLuongTable");
      } else {
        toastr.error("Load thông tin thất bại");
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
  });
}

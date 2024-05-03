$(document).ready(function () {
  loadListYeuCau();

  $("#yeuCauChinhSuaTable tbody").on("click", "tr", function () {
    var maThongBao = $(this).find("td:first").text();
    getDetailByIDBaoCao(maThongBao);
    $("#DetailYeuCauModal").modal("show");
  });

  function getDetailByIDBaoCao(ma_baocao) {
    $.ajax({
      url:
        "../controller/MessageController.php?action=getDetailByIDBaoCao&ma_baocao=" +
        ma_baocao,
      type: "GET",
      success: function (response) {
        var data = JSON.parse(response);
        if (data.success) {
          var item = data.data[0];
          $("#nguoiyeucau").val(
            item.ma_gv + " - " + item.ho_lot_gv + " " + item.ten_gv
          );
          $("#tieude").val(item.tieu_de);
          $("#noidung").val(item.thongtin_chinhsua);
          $("#thoigiantao").val(item.thoigian_tao);
        } else {
          toastr.error("Load thông tin thất bại");
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  }

  function loadListYeuCau() {
    $.ajax({
      url: "../controller/MessageController.php?action=getListYeuCauChinhSua",
      type: "GET",
      success: function (response) {
        var data = JSON.parse(response);
        if (data.success) {
          var tableHtml = "";

          data.data.forEach(function (item) {
            tableHtml += "<tr>";
            tableHtml += "<td class='text-center'>" + item.ma_baocao + "</td>";
            tableHtml += "<td class='text-center'>" + item.ma_gv + "</td>";
            tableHtml +=
              "<td class='text-left'>" +
              item.ho_lot_gv +
              " " +
              item.ten_gv +
              "</td>";
            tableHtml += "<td class='text-left'>" + item.tieu_de + "</td>";
            tableHtml += "<td class='text-left'>" + item.thoigian_tao + "</td>";
            tableHtml += "</tr>";
          });

          $("#yeuCauChinhSuaTable").DataTable().destroy();
          $("#yeuCauChinhSuaTable tbody").html(tableHtml);
          initializeDataTable("yeuCauChinhSuaTable");
        } else {
          toastr.error("Load thông tin thất bại");
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText); // Log lỗi nếu có
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
});

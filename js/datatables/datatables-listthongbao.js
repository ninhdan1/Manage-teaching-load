$(document).ready(function () {
  loadlistThongBao();
  $("#thongBaoTable tbody").on("click", "tr", function () {
    var maChitietThongBao = $(this).find("td:first").text();
    getDetailByIDChiTietThongBao(maChitietThongBao);
    $("#DetailThongBaoModal").modal("show");
  });
});

//getDetailByIDBaoCao(maThongBao);
//$("#DetailYeuCauModal").modal("show");

function getDetailByIDChiTietThongBao(id) {
  $.ajax({
    url:
      "../controller/MessageController.php?action=getDetailThongBaoById&id=" +
      id,
    type: "GET",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.success) {
        var item = data.data[0];

        $("#mathongbao").text(" - " + "Mã thông báo " + item.ma_thongbao);

        $("#nguoinhan").val(
          item.ma_gv + " - " + item.ho_lot_gv + " " + item.ten_gv
        );
        $("#tieude").val(item.tieu_de);
        $("#noidung").val(item.noi_dung);
        $("#thoigiantao").text(item.thoigian_tao);
        $("#tacgia").val(item.tac_gia);
      } else {
        toastr.error("Load thông tin thất bại");
      }
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    },
  });
}

function loadlistThongBao() {
  $.ajax({
    url: "../controller/MessageController.php?action=getListThongBao",
    type: "GET",

    success: function (response) {
      var data = JSON.parse(response);

      if (data.success) {
        var tableHtml = "";

        data.data.forEach(function (item) {
          tableHtml += "<tr>";
          tableHtml += "<td class='text-center'>" + item.id + "</td>";

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

        $("#thongBaoTable").DataTable().destroy();
        $("#thongBaoTable tbody").html(tableHtml);
        initializeDataTable("thongBaoTable");
      }
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

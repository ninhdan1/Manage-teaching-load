$(document).ready(function () {
  loadListGiangVien();

  $("#btnThongBao").click(function () {
    if (
      $("#giangVienThongBaoTable")
        .DataTable()
        .rows({ selected: true })
        .count() === 0
    ) {
      toastr.error("Vui lòng chọn giảng viên", "Thông báo");
      return;
    } else {
      $("#ThongBaoModal").modal("show");
    }
  });

  $("#ThongBaoForm").submit(function (e) {
    e.preventDefault();
    sendThongBao();
  });
});

function sendThongBao() {
  var selectedRowsData = $("#giangVienThongBaoTable")
    .DataTable()
    .rows({ selected: true })
    .data()
    .toArray();

  var ma_gv_arr = selectedRowsData.map(function (rowData) {
    return rowData[2];
  });
  $.ajax({
    url: "../controller/usercontroller.php?action=sendNotificationToGiangVien",
    type: "POST",
    data: {
      tieu_de: $("#tieude").val(),
      noi_dung: $("#noidung").val(),
      ma_gv_arr: ma_gv_arr,
    },
    success: function (response) {
      var data = JSON.parse(response);
      if (data.success) {
        toastr.success("Gửi thông báo thành công", "Thông báo");
        $("#ThongBaoModal").modal("hide");

        setTimeout(function () {
          location.reload();
        }, 300);
      } else {
        toastr.error("Gửi thông báo thất bại", "Thông báo");
      }
    },
  });
}

function loadListGiangVien() {
  $.ajax({
    url: "../controller/giangviencontroller.php?action=getListGiangVienByRoleUser",
    type: "GET",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.success) {
        var html = "";
        var tableHead = `
            <thead>
              <tr>
                <th></th>
                <th class="text-center">STT</th>
                <th class="text-center">Mã giảng viên</th>
                <th class="text-left">Họ giảng viên</th>
                <th class="text-left">Tên giảng viên</th>
              </tr>
            </thead>
          `;

        data.data.forEach(function (giangvien, index) {
          html += "<tr>";
          html += "<td></td>";
          html += "<td class='text-center'>" + (index + 1) + "</td>";
          html += "<td class='text-center'>" + giangvien.ma_gv + "</td>";
          html += "<td class='text-left'>" + giangvien.ho_lot_gv + "</td>";
          html += "<td class='text-left'>" + giangvien.ten_gv + "</td>";
          html += "</tr>";
        });

        $("#giangVienThongBaoTable").DataTable().destroy();
        $("#giangVienThongBaoTable thead").remove(); // Remove existing thead if any
        $("#giangVienThongBaoTable").prepend(tableHead); // Add new thead
        $("#giangVienThongBaoTable tbody").html(html);
        initializeDataTable("giangVienThongBaoTable");
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
      info: "Hiển thị _START_ trong tổng số _TOTAL_ dòng dữ liệu ",
      infoEmpty: "Dữ liệu rỗng",
      emptyTable: "Không có dữ liệu nào",
      processing: "Đang xử lý...",
      search: "<strong>Tìm kiếm</strong>",
      loadingRecords: "Đang tải...",
      zeroRecords: "Không tìm thấy dữ liệu",
      infoFiltered: "(được lọc từ tổng số _MAX_ dòng dữ liệu)",
      sSearchPlaceholder: "Nhập từ khóa...",
    },

    columnDefs: [
      {
        orderable: false,
        render: DataTable.render.select(),
        targets: 0,
      },
    ],
    select: {
      style: "multi",
      selector: "td:first-child",
    },
    order: [[1, "asc"]],
  });
}

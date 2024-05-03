$(document).ready(function () {
  $("#taiKhoanTable").DataTable({
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
});

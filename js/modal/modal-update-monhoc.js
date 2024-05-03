function showModal(mamonhoc) {
  $.ajax({
    url:
      "../controller/monhoccontroller.php?action=detail&ma_monhoc=" + mamonhoc,
    type: "GET",
    success: function (response) {
      var data = JSON.parse(response);
      var result = data.data[0];
      $("#ma_monhoc").val(result.ma_monhoc);
      $("#ten_monhoc").val(result.ten_monhoc);
      // Set value for loai_monhoc select element
      if (result.loai_monhoc !== null) {
        $("#loai_monhoc").val(result.loai_monhoc);
      } else {
        $("#loai_monhoc").val("");
      }

      if (result.hoc_ky_monhoc !== null) {
        $("#hoc_ky_monhoc").val(result.hoc_ky_monhoc);
      } else {
        $("#hoc_ky_monhoc").val("");
      }

      $("#EditModal").modal("show");
    },
    error: function (xhr, status, error) {
      console.error("Error: " + error);
    },
  });
}

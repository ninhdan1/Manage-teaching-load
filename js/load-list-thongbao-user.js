$(document).ready(function () {
  loadThongBaoCaNhan();
});

function loadThongBaoCaNhan() {
  $.ajax({
    url: "../controller/usercontroller.php?action=getListThongBaoByMaGiangVien",
    type: "GET",
    success: function (response) {
      var data = JSON.parse(response);
      if (data.success) {
        var cardHtml = "";
        data.data.forEach(function (item) {
          cardHtml += '<div class="card-body mb-3" >';
          cardHtml += '<div class="card">';
          cardHtml +=
            '<div class="card-header d-flex justify-content-between align-items-center">';
          cardHtml += '<h6 class="card-title">' + item.tac_gia + "</h6>";
          cardHtml +=
            '<span class="badge bg-secondary">' + item.thoigian_tao + "</span>";
          cardHtml += "</div>";
          cardHtml += '<div class="card-body">';
          cardHtml += '<div class="form-floating mb-3">';
          cardHtml +=
            '<textarea class="form-control" placeholder="" rows="1" style="height: auto;">' +
            item.tieu_de +
            "</textarea>";
          cardHtml += '<label for="floatingTextarea">Tiêu đề</label>';
          cardHtml += "</div>";
          cardHtml += '<div class="form-floating">';
          cardHtml +=
            '<textarea class="form-control" placeholder="" rows="4" style="height: auto;">' +
            item.noi_dung +
            "</textarea>";
          cardHtml += '<label for="floatingTextarea">Nội dung</label>';
          cardHtml += "</div>";
          cardHtml += "</div>";
          cardHtml += "</div>";
          cardHtml += "</div>";
        });
        $("#cardContainer").html(cardHtml);
      } else {
        toastr.error("Load yêu cầu thất bại");
      }
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    },
  });
}

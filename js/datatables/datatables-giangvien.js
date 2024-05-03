$(document).ready(function () {
  var giangvienTable;
  displayListGiangVien();
  var selectedMaGV;
  var tenGiangVien;

  function displayListGiangVien() {
    $.ajax({
      url: "../controller/giangviencontroller.php?action=index",
      type: "GET",
      success: function (response) {
        var data = JSON.parse(response);

        if (data.success) {
          var html = "";

          data.data.forEach(function (giangvien, index) {
            html += "<tr>";
            html += "<td class='text-center'>" + (index + 1) + "</td>";
            html += "<td class='text-center'>" + giangvien.ma_gv + "</td>";
            html += "<td class='text-left'>" + giangvien.ho_lot_gv + "</td>";
            html += "<td class='text-left'>" + giangvien.ten_gv + "</td>";
            html += "</tr>";
          });

          $("#giangvienTable tbody").html(html);

          // Check if DataTable is already initialized
          if ($.fn.dataTable.isDataTable("#giangvienTable")) {
            // If already initialized, destroy it first
            $("#giangvienTable").DataTable().destroy();
          }

          // Initialize DataTable
          giangvienTable = $("#giangvienTable").DataTable({
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

          $("#giangvienTable tbody").on("click", "tr", function () {
            // Loại bỏ lớp active từ tất cả các hàng trong bảng
            $("#giangvienTable tbody tr").removeClass("table-active");

            // Thêm lớp active vào hàng được click
            $(this).addClass("table-active");

            var data = giangvienTable.row(this).data();
            selectedMaGV = data[1];

            tenGiangVien = data[2] + " " + data[3]; // Tên giảng viên là cột 2 và 3 trong dữ liệu
            $("#selectedGiangVien").text(tenGiangVien);
            $("#selectedGiangVien1").text(tenGiangVien);
          });
        } else {
          console.log(data.message);
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText); // Log lỗi nếu có
      },
    });
  }

  //-------------------------------------SO SÁNH HỌC KỲ-------------------------------------
  function loadHocKySelectBoxes(maGiangVien) {
    // Gọi AJAX để lấy danh sách học kỳ dựa trên mã giảng viên
    $.ajax({
      url:
        "../controller/sosanhcontroller.php?action=getListHocKyByGiangVien&ma_gv=" +
        maGiangVien,
      type: "GET",
      success: function (response) {
        var data = JSON.parse(response);

        if (data.success) {
          // Xử lý dữ liệu trả về để tạo các option cho select boxes
          var optionsHtml = "<option value='' selected>Chọn học kỳ</option>";
          data.data.forEach(function (hocKy) {
            if (hocKy.ten_hocky == 1) {
              hocKyRoman = "I";
            } else if (hocKy.ten_hocky == 2) {
              hocKyRoman = "II";
            } else if (hocKy.ten_hocky == 3) {
              hocKyRoman = "III";
            }

            optionsHtml +=
              '<option value="' +
              hocKy.ma_hocky +
              '">Học kỳ: ' +
              hocKyRoman +
              " Năm học: " +
              hocKy.nam_hoc +
              "-" +
              (parseInt(hocKy.nam_hoc) + 1) +
              "</option>";
          });

          // Đổ dữ liệu vào các select boxes
          $("#ma_hocky1, #ma_hocky2").html(optionsHtml);

          // Kích hoạt plugin select2 cho các select boxes
          $("#ma_hocky1, #ma_hocky2").select2({
            theme: "bootstrap-5",
            dropdownParent: $("#SoSanhHocKyModal"),
          });
        } else {
          console.log(data.message);
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText); // Log lỗi nếu có
      },
    });
  }

  $("#btnSoSanhHocKy").click(function () {
    if (selectedMaGV) {
      loadHocKySelectBoxes(selectedMaGV);

      $("#SoSanhHocKyModal").modal("show");

      //cler all data
      clearColumns(1);
      clearColumns(2);
      clearResultColumns();
      $("#tongKetResult").text("");
    } else {
      toastr.error("Vui lòng chọn một giảng viên.");
    }
  });

  $("#ma_hocky1, #ma_hocky2").change(function () {
    var selectedHocKy1 = $("#ma_hocky1").val();
    var selectedHocKy2 = $("#ma_hocky2").val();

    // Show data for selected semesters
    if (selectedHocKy1) {
      showDataForHocKyAndGiangVien(selectedHocKy1, selectedMaGV, 1);
    } else {
      clearColumns(1);
      $("#tongKetResult").text("");
    }

    // Lấy dữ liệu cho học kỳ 2
    if (selectedHocKy2) {
      showDataForHocKyAndGiangVien(selectedHocKy2, selectedMaGV, 2);
    } else {
      clearColumns(2);
      $("#tongKetResult").text("");
    }

    $("#ma_hocky1").on("select2:select", function (e) {
      var selectedValue = e.params.data.id;
      $("#ma_hocky2 option").each(function () {
        if ($(this).val() == selectedValue) {
          $(this).prop("disabled", true);
        } else {
          $(this).prop("disabled", false);
        }
      });
    });

    $("#ma_hocky2").on("select2:select", function (e) {
      var selectedValue = e.params.data.id;
      $("#ma_hocky1 option").each(function () {
        if ($(this).val() == selectedValue) {
          $(this).prop("disabled", true);
        } else {
          $(this).prop("disabled", false);
        }
      });
    });

    if (!selectedHocKy1 || !selectedHocKy2) {
      clearResultColumns();
      $("#tongKetResult").text("");
      $("#btnKetQua").prop("disabled", true);
    } else {
      $("#btnKetQua").prop("disabled", false);
    }

    $("#btnKetQua").click(function () {
      calculateAndShowResult(selectedHocKy1, selectedHocKy2);
    });
  });

  function showDataForHocKyAndGiangVien(selectedHocKy, selectedMaGV, selected) {
    $.ajax({
      url:
        "../controller/sosanhcontroller.php?action=getDetailTongKhoiLuongGiangDayByHocKy&ma_hocky=" +
        selectedHocKy +
        "&ma_gv=" +
        selectedMaGV,
      type: "GET",
      success: function (response) {
        var data = JSON.parse(response);

        if (data.success) {
          populateTable(data.data[0], selected);
          populateTableGV(data.data[0], selected);
        } else {
          toastr.error(data.message);
        }
      },
    });
  }

  function populateTable(data, selected) {
    $("#tongTiet" + selected).text(data.so_tietday);
    $("#tongMon" + selected).text(data.so_monday);
    $("#tongLop" + selected).text(data.so_lopday);
    $("#tongSinhVien" + selected).text(data.so_sinhvienday);
    $("#tongDoAn" + selected).text(data.so_doan);
  }

  function clearColumns(selected) {
    $("#tongTiet" + selected).text("");
    $("#tongMon" + selected).text("");
    $("#tongLop" + selected).text("");
    $("#tongSinhVien" + selected).text("");
    $("#tongDoAn" + selected).text("");
  }

  function calculateAndShowResult(selectedHocKy1, selectedHocKy2) {
    if (selectedHocKy1 && selectedHocKy2) {
      var result1 = calculateDataForHocKy(selectedHocKy1, 1);
      var result2 = calculateDataForHocKy(selectedHocKy2, 2);

      displayOverallResult(calculateOverallResult(result1, result2));

      displayResult(result1, result2);
    }
  }

  function calculateDataForHocKy(selectedHocKy, selected) {
    var result = {
      tongTiet: 0,
      tongMon: 0,
      tongLop: 0,
      tongSinhVien: 0,
      tongDoAn: 0,
    };

    if (selectedHocKy) {
      result.tongTiet = parseFloat($("#tongTiet" + selected).text())
        ? parseFloat($("#tongTiet" + selected).text())
        : 0;
      result.tongMon = parseFloat($("#tongMon" + selected).text())
        ? parseFloat($("#tongMon" + selected).text())
        : 0;
      result.tongLop = parseFloat($("#tongLop" + selected).text())
        ? parseFloat($("#tongLop" + selected).text())
        : 0;
      result.tongSinhVien = parseFloat($("#tongSinhVien" + selected).text())
        ? parseFloat($("#tongSinhVien" + selected).text())
        : 0;
      result.tongDoAn = parseFloat($("#tongDoAn" + selected).text())
        ? parseFloat($("#tongDoAn" + selected).text())
        : 0;
    }

    return result;
  }

  function displayResult(result1, result2) {
    var ketQuaTiet = (result2.tongTiet - result1.tongTiet) * 0.01;
    var ketQuaMon = (result2.tongMon - result1.tongMon) * 0.01;
    var ketQuaLop = (result2.tongLop - result1.tongLop) * 0.01;
    var ketQuaSinhVien = (result2.tongSinhVien - result1.tongSinhVien) * 0.01;
    var ketQuaDoAn = (result2.tongDoAn - result1.tongDoAn) * 0.01;

    $("#ketQuaTiet").html(formatKetQua(ketQuaTiet));
    $("#ketQuaMon").html(formatKetQua(ketQuaMon));
    $("#ketQuaLop").html(formatKetQua(ketQuaLop));
    $("#ketQuaSinhVien").html(formatKetQua(ketQuaSinhVien));
    $("#ketQuaDoAn").html(formatKetQua(ketQuaDoAn));
  }

  function formatKetQua(value) {
    var iconClass =
      value > 0
        ? "fas fa-arrow-up"
        : value < 0
        ? "fas fa-arrow-down"
        : "fas fa-circle";
    var color = value > 0 ? "green" : value < 0 ? "red" : "gray";
    var formattedValue = value !== 0 ? Math.abs(value) + "%" : "0%";
    return (
      '<i class="' +
      iconClass +
      '" style="color: ' +
      color +
      ';"></i> ' +
      formattedValue
    );
  }

  function clearResultColumns() {
    $("#ketQuaTiet").text("");
    $("#ketQuaMon").text("");
    $("#ketQuaLop").text("");
    $("#ketQuaSinhVien").text("");
    $("#ketQuaDoAn").text("");
  }

  function calculateOverallResult(result1, result2) {
    var ketQuaTiet = (result2.tongTiet - result1.tongTiet) * 0.01;
    var ketQuaMon = (result2.tongMon - result1.tongMon) * 0.01;
    var ketQuaLop = (result2.tongLop - result1.tongLop) * 0.01;
    var ketQuaSinhVien = (result2.tongSinhVien - result1.tongSinhVien) * 0.01;
    var ketQuaDoAn = (result2.tongDoAn - result1.tongDoAn) * 0.01;

    var tongKet =
      ketQuaTiet + ketQuaMon + ketQuaLop + ketQuaSinhVien + ketQuaDoAn;
    $("#tongKetResult").text(tongKet.toFixed(2) + "%");
    return tongKet;
  }

  function displayOverallResult(tongKet) {
    var tongKetComment;
    var iconClass;
    var tongKetAbs = Math.abs(tongKet); // Lấy giá trị tuyệt đối của tổng kết

    if (tongKet > 0) {
      tongKetComment = "Tăng";
      iconClass = "fas fa-arrow-up text-success";
    } else if (tongKet < 0) {
      tongKetComment = "Giảm";
      iconClass = "fas fa-arrow-down text-danger";
    } else {
      tongKetComment = "Bằng";
      iconClass = "bi bi-equal-circle text-muted";
    }

    $("#tongKetResult").html(
      `(${tongKetComment})<strong> <i class="${iconClass}"></i></strong> ${tongKetAbs.toFixed(
        2
      )}% so với học kì trước đó! `
    );
  }

  //-------------------------------------SO SÁNH GIẢNG VIÊN-------------------------------------

  function loadGiangVienSelectBoxes() {
    $.ajax({
      url:
        "../controller/sosanhcontroller.php?action=getListGiangVienNoExist&ma_gv=" +
        selectedMaGV,
      type: "GET",
      success: function (response) {
        var data = JSON.parse(response);

        if (data.success) {
          var optionsHtml =
            "<option value='' selected>Chọn giảng viên</option>";
          data.data.forEach(function (giangVien) {
            optionsHtml +=
              '<option value="' +
              giangVien.ma_gv +
              '">' +
              giangVien.ho_lot_gv +
              " " +
              giangVien.ten_gv +
              "</option>";
          });

          $("#ma_giangvien").html(optionsHtml);
          $("#ma_giangvien").select2({
            theme: "bootstrap-5",
            dropdownParent: $("#SoSanhGiangVienModal"),
          });
        } else {
          toastr.error(data.message);
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText); // Log lỗi nếu có
      },
    });
  }

  $("#btnSoSanhGiangVien").click(function () {
    if (selectedMaGV) {
      loadGiangVienSelectBoxes();
      $("#SoSanhGiangVienModal").modal("show");

      $("#ma_hockygiangvien").prop("disabled", true);
      $("#ma_hockygiangvien").val("");
      //cler all data
      clearColumnsGV(1);
      clearColumnsGV(2);
      clearResultColumnsGV();
      $("#tongKetResultGV").text("");
    } else {
      toastr.error("Vui lòng chọn một giảng viên.");
    }
  });

  function getListHocKyBy2GiangVien(selectedMaGV, selectedMaGV2) {
    $.ajax({
      url:
        "../controller/sosanhcontroller.php?action=getListHocKyBy2GiangVien&ma_gv1=" +
        selectedMaGV +
        "&ma_gv2=" +
        selectedMaGV2,
      type: "GET",
      success: function (response) {
        var data = JSON.parse(response);

        if (data.success) {
          var optionsHtml = "<option value='' selected>Chọn học kỳ</option>";
          data.data.forEach(function (hocKy) {
            if (hocKy.ten_hocky == 1) {
              hocKyRoman = "I";
            } else if (hocKy.ten_hocky == 2) {
              hocKyRoman = "II";
            } else if (hocKy.ten_hocky == 3) {
              hocKyRoman = "III";
            }

            optionsHtml +=
              '<option value="' +
              hocKy.ma_hocky +
              '">Học kỳ: ' +
              hocKyRoman +
              " Năm học: " +
              hocKy.nam_hoc +
              "-" +
              (parseInt(hocKy.nam_hoc) + 1) +
              "</option>";
          });

          $("#ma_hockygiangvien").html(optionsHtml);
          $("#ma_hockygiangvien").select2({
            theme: "bootstrap-5",
            dropdownParent: $("#SoSanhGiangVienModal"),
          });
        } else {
          toastr.error(data.message);
        }
      },
    });
  }

  $("#ma_giangvien").change(function () {
    var selectedMaGV2 = $(this).val();

    if (selectedMaGV2) {
      getListHocKyBy2GiangVien(selectedMaGV, selectedMaGV2);
      $("#ma_hockygiangvien").prop("disabled", false);
    } else {
      // Ngược lại, kích hoạt combobox ma_hockygiangvien
      $("#ma_hockygiangvien").prop("disabled", true);
      $("#ma_hockygiangvien").val("");

      clearColumnsGV(1);
      clearColumnsGV(2);
      clearResultColumnsGV();
      $("#btnKetQuaGiangVien").prop("disabled", true);
      $("#tongKetResultGV").text("");
    }
  });

  $("#ma_hockygiangvien").change(function () {
    var selectedGiangVien = $("#ma_giangvien").val();
    var ma_hockygiangvien = $("#ma_hockygiangvien").val();

    if (ma_hockygiangvien && selectedGiangVien) {
      showDataForHocKyAndGiangVien(ma_hockygiangvien, selectedMaGV, 1);
      showDataForHocKyAndGiangVien(ma_hockygiangvien, selectedGiangVien, 2);
    } else {
      clearColumnsGV(1);
      clearColumnsGV(2);
    }

    if (!ma_hockygiangvien || !selectedGiangVien) {
      clearResultColumnsGV();
      $("#btnKetQuaGiangVien").prop("disabled", true);
    } else {
      $("#btnKetQuaGiangVien").prop("disabled", false);
    }

    $("#btnKetQuaGiangVien").click(function () {
      calculateAndShowResultGV(
        ma_hockygiangvien,
        selectedMaGV,
        selectedGiangVien
      );
    });
  });

  function populateTableGV(data, selected) {
    $("#tongTietGV" + selected).text(data.so_tietday);
    $("#tongMonGV" + selected).text(data.so_monday);
    $("#tongLopGV" + selected).text(data.so_lopday);
    $("#tongSinhVienGV" + selected).text(data.so_sinhvienday);
    $("#tongDoAnGV" + selected).text(data.so_doan);
  }

  function calculateAndShowResultGV(
    selectedHocKy,
    selectedMaGV1,
    selectedMaGV2
  ) {
    if (selectedHocKy) {
      var result1 = calculateDataForGiangVien(selectedMaGV1, 1, selectedHocKy);
      var result2 = calculateDataForGiangVien(selectedMaGV2, 2, selectedHocKy);
      displayOverallResultGV(calculateOverallResultGV(result1, result2));
      displayResultGV(result1, result2);
    }
  }

  function calculateDataForGiangVien(
    selectedGiangVien,
    selected,
    selectedHocKy
  ) {
    var result = {
      tongTiet: 0,
      tongMon: 0,
      tongLop: 0,
      tongSinhVien: 0,
      tongDoAn: 0,
    };

    if (selectedHocKy && selectedGiangVien) {
      result.tongTiet = parseFloat($("#tongTietGV" + selected).text())
        ? parseFloat($("#tongTietGV" + selected).text())
        : 0;
      result.tongMon = parseFloat($("#tongMonGV" + selected).text())
        ? parseFloat($("#tongMonGV" + selected).text())
        : 0;
      result.tongLop = parseFloat($("#tongLopGV" + selected).text())
        ? parseFloat($("#tongLopGV" + selected).text())
        : 0;
      result.tongSinhVien = parseFloat($("#tongSinhVienGV" + selected).text())
        ? parseFloat($("#tongSinhVienGV" + selected).text())
        : 0;
      result.tongDoAn = parseFloat($("#tongDoAnGV" + selected).text())
        ? parseFloat($("#tongDoAnGV" + selected).text())
        : 0;
    }

    return result;
  }

  function displayResultGV(result1, result2) {
    var ketQuaTiet = (result1.tongTiet - result2.tongTiet) * 0.01;
    var ketQuaMon = (result1.tongMon - result2.tongMon) * 0.01;
    var ketQuaLop = (result1.tongLop - result2.tongLop) * 0.01;
    var ketQuaSinhVien = (result1.tongSinhVien - result2.tongSinhVien) * 0.01;
    var ketQuaDoAn = (result1.tongDoAn - result2.tongDoAn) * 0.01;

    $("#ketQuaTietGV").html(formatKetQua(ketQuaTiet));
    $("#ketQuaMonGV").html(formatKetQua(ketQuaMon));
    $("#ketQuaLopGV").html(formatKetQua(ketQuaLop));
    $("#ketQuaSinhVienGV").html(formatKetQua(ketQuaSinhVien));
    $("#ketQuaDoAnGV").html(formatKetQua(ketQuaDoAn));
  }

  function calculateOverallResultGV(result1, result2) {
    var ketQuaTiet = (result1.tongTiet - result2.tongTiet) * 0.01;
    var ketQuaMon = (result1.tongMon - result2.tongMon) * 0.01;
    var ketQuaLop = (result1.tongLop - result2.tongLop) * 0.01;
    var ketQuaSinhVien = (result1.tongSinhVien - result2.tongSinhVien) * 0.01;
    var ketQuaDoAn = (result1.tongDoAn - result2.tongDoAn) * 0.01;

    var tongKet =
      ketQuaTiet + ketQuaMon + ketQuaLop + ketQuaSinhVien + ketQuaDoAn;
    $("#tongKetResultGV").text(tongKet.toFixed(2) + "%");
    return tongKet;
  }

  function displayOverallResultGV(tongKet) {
    var tongKetComment;
    var iconClass;
    var tongKetAbs = Math.abs(tongKet); // Lấy giá trị tuyệt đối của tổng kết

    if (tongKet > 0) {
      tongKetComment = "cao hơn";
      iconClass = "fas fa-arrow-up text-success";
    } else if (tongKet < 0) {
      tongKetComment = "thấp hơn";
      iconClass = "fas fa-arrow-down text-danger";
    } else {
      tongKetComment = "bằng với";
      iconClass = "bi bi-equal-circle text-muted";
    }

    $("#tongKetResultGV").html(
      `Giảng viên <strong> ${tenGiangVien}</strong> có số khối lượng <strong> (${tongKetComment}) <i class="${iconClass}"></i></strong> ${tongKetAbs.toFixed(
        2
      )}% so với giảng viên còn lại! `
    );
  }

  function clearColumnsGV(selected) {
    $("#tongTietGV" + selected).text("");
    $("#tongMonGV" + selected).text("");
    $("#tongLopGV" + selected).text("");
    $("#tongSinhVienGV" + selected).text("");
    $("#tongDoAnGV" + selected).text("");
  }
  function clearResultColumnsGV() {
    $("#ketQuaTietGV").text("");
    $("#ketQuaMonGV").text("");
    $("#ketQuaLopGV").text("");
    $("#ketQuaSinhVienGV").text("");
    $("#ketQuaDoAnGV").text("");
  }
});

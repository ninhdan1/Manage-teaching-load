function showModal(maLopMonHoc){
    $.ajax({
        url: "../controller/GiangDayController.php?action=detail&ma_lopmonhoc=" + maLopMonHoc,
        type: "GET",
        success: function(response){
            $("#ma_lopmonhoc").val(response.ma_lopmonhoc);
            $("#ten_phong").val(response.ten_phong);
            $("#thu").val(response.thu);
            $("#tiet_batdau").val(response.tiet_batdau);
            $("#so_tiet").val(response.so_tiet);
            $("#so_tietmonhoc").val(response.so_tietmonhoc);
            $("#si_solop").val(response.si_solop);
            $("#ma_monhoc").val(response.ten_monhoc);
            $("#ma_lophoc").val(response.ma_lophoc);
            $("#ma_gv").val(response.ho_lot_gv + ' ' + response.ten_gv);
            $("#ngay_batdau").val(response.ngay_batdau);
            $("#thoigian_hoc").val(response.thoigian_hoc);
            $("#tiet_hoc").val(response.tiet_hoc);
            $("#ma_lop").val(response.ma_lop);
            $("#ma_hk").val('HK0' + response.ten_hocky + ' ' + response.nam_hoc + '-' + (parseInt(response.nam_hoc) + 1));

           
            $("#EditModal").modal("show");
        }
    });
}


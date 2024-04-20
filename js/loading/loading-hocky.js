// $(document).ready(function() {

//     loadHocKyList();

//     function loadHocKyList() {
//         $.ajax({
//             url: "../controller/thongkecontroller.php?action=getListHocKy",
//             type: "GET",
//             success: function(response) {
//                 var data = JSON.parse(response);
//                 if (data.success) {
//                     var html = "";
//                     data.data.forEach(function(item) {
//                         html += '<option value="' + item.ma_hocky + '">Học kỳ: ' + item.ten_hocky + ' Năm học: ' + item.nam_hoc + '-' + (item.nam_hoc + 1) + '</option>';
//                     });
//                     $("#maHocKy").html(html);
//                 }
//             },
//             error: function(xhr, status, error) {
//                 console.error(xhr.responseText); // Log lỗi nếu có
//             }
//         });
//     }

// }); // Kết thúc document ready


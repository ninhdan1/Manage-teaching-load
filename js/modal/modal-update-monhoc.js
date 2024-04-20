function showModal(mamonhoc) {
    $.ajax({
        url: "../controller/monhoccontroller.php?action=detail&ma_monhoc=" + mamonhoc,
        type: "GET",
        success: function(response) {
            if (Array.isArray(response) && response.length > 0) {
                // Access the first element of the array and populate modal fields
                var data = response[0];
                $("#ma_monhoc").val(data.ma_monhoc);
                $("#ten_monhoc").val(data.ten_monhoc);
                // Set value for loai_monhoc select element
                if (data.loai_monhoc !== null) {
                    $("#loai_monhoc").val(data.loai_monhoc);
                } else {
                    $("#loai_monhoc").val("");
                }
                
                $("#EditModal").modal("show");
            } else {
                // Handle case where response is empty or not in expected format
                console.log("Empty or invalid response.");
            }
        }
    });
}
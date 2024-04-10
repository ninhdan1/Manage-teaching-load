$(document).ready(function(){
    $("form").on("submit", function(event){
        event.preventDefault();

        var formData = new FormData(this);
        $("#loadingButton").show();
        $("#importButton").hide();

        $.ajax({
            url: '../controller/ImportFileExcelController.php?action=import',
            type: 'POST',
            data: formData,
            success: function(data){

                $("#loadingButton").hide();
                $("#importButton").show();

                // Kiểm tra dữ liệu trả về từ máy chủ
                if (data.indexOf("success") !== -1) {
                    toastr.success('Import dữ liệu thành công!', { timeOut: 5000 });

                    setTimeout(function(){
                        location.reload();
                    }, 2000); 
                    
                } else {
                    toastr.error(data, { timeOut: 5000 });
                }
            },
            error: function(xhr, status, error){
                $("#loadingButton").hide();
                $("#importButton").show();
                toastr.error('Có lỗi xảy ra: ' + error, { timeOut: 5000 });
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});


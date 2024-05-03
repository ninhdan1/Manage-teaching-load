// custom.js
$(document).ready(function(){
    $("form").on("submit", function(event){
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: '../controller/ImportFileExcelController.php?action=import',
            type: 'POST',
            data: formData,
            success: function(data){
                toastr.success('Import dữ liệu thành công!', { timeOut: 5000 });
            },
            error: function(xhr, status, error){
                toastr.error('Có lỗi xảy ra: ' + error, { timeOut: 5000 });
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});

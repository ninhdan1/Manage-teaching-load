<?php

$currentYear = date("Y");
$content = '
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Giảng dạy</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> Import file excel</h6>
    </div>
    <div class="card-body">
        <form action="../controller/ImportFileExcelController.php?action=import" method="post"
            enctype="multipart/form-data" class="was-validated">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tenHocKy" class="font-weight-bold d-inline-block">Học kỳ:</label>
                        <select class="form-select form-select-sm" aria-label="Small select example" name="tenHocKy"
                            id="tenHocKy">
                            <option value="1,3,5,7">1, 3, 5, 7</option>
                            <option value="2,4,6,8">2, 4, 6, 8</option>
                        </select>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group input-group-sm has-validation">
                                <label for="namHoc" class="font-weight-bold d-inline-block">Năm học:</label>
                                <input type="number" placeholder="" class="form-control" name="namHoc" id="namHoc"
                                    required min="1900" max="3000" minlength="4" maxlength="4"
                                    value="' . $currentYear . '" onchange="updateNextYear()" onblur="validateYearInput()">
                                <div class="invalid-feedback">
                                    Hãy nhập năm học!.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-4">
                            <div class="form-group input-group-sm has-validation">
                                <label for="namHoc"></label>
                                <input type="number" placeholder="" readonly class="form-control" name="namHoc2"
                                    id="namHoc2" required min="1900" max="3000" value="' . ($currentYear + 1) . '">
                                <div class="invalid-feedback">
                                    Hãy nhập năm học!.
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>

            <div class="form-group">
                <label for="fileToUpload" class="font-weight-bold d-inline-block"><i class="bi bi-file-excel"></i> Chọn
                    tệp Excel để nhập:</label>
                <input type="file" class="form-control form-control-lg" name="fileToUpload" id="fileToUpload"
                     required>
                <div class="invalid-feedback">Bạn chưa nhập file excel!</div>
            </div>

            <div class="d-flex justify-content-center">


                <button id="loadingButton" class="btn btn-warning me-2 btn-sm" type="button" disabled style="display: none;">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Chờ trong giây lát...
                 </button>

                <button id="importButton" type="submit" class="btn btn-success btn-icon-split me-2 btn-sm">
                    <span class="icon text-white">
                        <i class="bi bi-download"></i>
                    </span>
                    <span class="text">Import</span>
                </button>
                <a href="../view/admin/layout-admin.php" class="btn btn-danger btn-icon-split btn-sm">
                    <span class="icon text-white">
                        <i class="bi bi-backspace"></i>
                    </span>
                    <span class="text">Quay lại</span>
                </a>
            </div>
        </form>
    </div>
</div>


<script>
function updateNextYear() {
    var currentYear = parseInt(document.getElementById("namHoc").value);
    document.getElementById("namHoc2").value = currentYear + 1;
}


function validateYearInput() {
    var inputYear = document.getElementById("namHoc").value;
    var minYear = document.getElementById("namHoc").min;
    var maxYear = document.getElementById("namHoc").max;

    if (inputYear.length !== 4) {
        toastr.error("Năm học phải chứa đúng 4 chữ số");
        document.getElementById("namHoc").value = "";
        return;
    }


    if (inputYear < minYear || inputYear > maxYear) {
        toastr.error("Năm học phải nằm trong khoảng từ " + minYear + " đến " + maxYear);
        document.getElementById("namHoc").value = "";
    }
}
</script>
<script src="/js/toastr/toastr-custom.js"></script>
';


include '../view/admin/layout-admin.php';

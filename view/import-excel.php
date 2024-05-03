<?php


$content ='

<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Giảng dạy</h1>
                    </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Import file excel</h6>
                    </div>
                    <div class="card-body">
                    <form action="../controller/ImportFileExcelController.php?action=import" method="post" enctype="multipart/form-data" class="was-validated">
                   <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                                <label for="tenHocKy">Học kỳ:</label>
                                <select class="form-select form-select-sm" aria-label="Small select example" name="tenHocKy" id="tenHocKy">
                                    <option value="1,3,5,7">1, 3, 5, 7</option>
                                    <option value="2,4,6,8">2, 4, 6, 8</option>
                                </select>
                            </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group input-group-sm has-validation">
                            <label for="namHoc">Năm học:</label>
                            <input type="text" placeholder="2022-2023" class="form-control" name="namHoc" id="namHoc" pattern="\d{4}-\d{4}" required>
                            <div class="invalid-feedback">
                                Hãy nhập năm học!.
                            </div>
                        </div>
                    </div>
                      
                   </div>
                    
                    <div class="form-group">
                        <label for="fileToUpload">Chọn tệp Excel để nhập:</label>
                        <input type="file" class="form-control form-control-lg" name="fileToUpload" id="fileToUpload" accept=".xls,.xlsx" required>
                        <div class="invalid-feedback">Bạn chưa nhập file excel!</div>
                    </div>

                    <div class="d-flex justify-content-center"> <!-- Dòng này sẽ căn chỉnh hai nút vào giữa -->
                <button type="submit" class="btn btn-success btn-icon-split me-2 btn-sm">
                    <span class="icon text-white">
                        <i class="bi bi-download"></i>
                    </span>
                    <span class="text">Import</span>
                </button>
                <a href="#" class="btn btn-danger btn-icon-split btn-sm">
                    <span class="icon text-white">
                        <i class="bi bi-backspace"></i>
                    </span>
                    <span class="text">Quay lại</span>
                </a>
            </div>
                    </form>
                    </div>
                </div>

    
';

include '../view/admin/layout-admin.php'

?>


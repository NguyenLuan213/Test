<?php
// $sql_sua = "SELECT sanpham.*, thuonghieu.* FROM sanpham JOIN thuonghieu ON thuonghieu.MaTH = sanpham.MaTH WHERE MaSP = " .$_GET['idsp'];
$sql_sua = "SELECT sanpham.* FROM sanpham WHERE MaSP = " .$_GET['idsp'];

$result = $mysqli->query($sql_sua);
$row = mysqli_fetch_array($result);
?>
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Sửa sản phẩm</h1>
        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <form autocomplete="off" method="POST" action="modules/quanlysanpham/xuly.php?idsp=<?php echo $_GET['idsp']; ?>" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="Category" class="form-label">Danh mục:</label>
                            <select name="Category" class="form-select" id="Category">
                                <?php
                                $sql = "SELECT * FROM thuonghieu ORDER BY ThuTu ASC";
                                $result = mysqli_query($mysqli, $sql);
                                while ($row_sub = mysqli_fetch_array($result)) {
                                    echo '<option value="' . $row_sub['MaTH'] . '"';
                                    if ($row['MaTH'] == $row_sub['MaTH']) {
                                        echo ' selected';
                                    }
                                    echo '>' . $row_sub['TenTH'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="Name" class="form-label">Tên sản phẩm:</label>
                            <input type="text" value="<?php echo $row['TenSP'] ?>" class="form-control" id="Name" name="Name" placeholder="Nhập tên sản phẩm" required>
                        </div>
                        <div class="mb-3">
                            <label for="fileToUpload" class="form-label">Hình ảnh:</label>
                            <div> <img id="imagePreview" src="<?php echo "modules/quanlysanpham/img/$row[HinhAnh]" ?>" alt=""></div>
                            <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" onchange="previewImage(event)">

                        </div>
                        <div class="mb-3">
                            <label for="Color" class="form-label">Màu:</label>
                            <input type="text" value="<?php echo $row['Mau'] ?>" class="form-control" id="Color" name="Color" placeholder="Nhập màu" required>
                        </div>
                        <div class="mb-3">
                            <label for="Memory" class="form-label">Bộ nhớ:</label>
                            <input type="text" value="<?php echo $row['BoNho'] ?>" class="form-control" id="Memory" name="Memory" placeholder="Nhập bộ nhớ" required>
                        </div>
                        <div class="mb-3">
                            <label for="Quantity" class="form-label">Số lượng:</label>
                            <input type="number" min="1" max="40" class="form-control" value="<?php echo $row['SoLuong'] ?>" id="Quantity" name="Quantity" placeholder="Nhập số lượng" required>
                        </div>
                        <div class="mb-3">
                            <label for="OriginalPrice" class="form-label">Giá gốc:</label>
                            <input type="number" value="<?php echo number_format($row['Gia'], 0, '', '') ?>" class="form-control" id="OriginalPrice" name="OriginalPrice" placeholder="Nhập giá gốc" required>
                        </div>
                        <div class="mb-3">
                            <label for="SalePrice" class="form-label">Giá bán:</label>
                            <input type="number" value="<?php echo number_format($row['GiaHienTai'], 0, '', '') ?>" class="form-control" id="SalePrice" name="SalePrice" placeholder="Nhập giá bán" required>
                        </div>
                        <div class="mb-3">
                            <label for="Description" class="form-label">Mô tả:</label>
                            <textarea rows="5" type="text" class="form-control" id="Description" name="Description" placeholder="Nhập mô tả" required><?php echo $row['MoTa'] ?></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" name="edit">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</main>
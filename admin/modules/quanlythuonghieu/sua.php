<?php
$sql_sua = "SELECT thuonghieu.*, menu.TenMenu FROM thuonghieu JOIN menu ON thuonghieu.MaMenu = menu.MaMenu WHERE MaTH = '$_GET[idth]' ORDER BY thuonghieu.ThuTu ASC LIMIT 1";
$result = $mysqli->query($sql_sua);
$row = mysqli_fetch_array($result);
?>
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Sửa Menu sản phẩm</h1>
        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <form method="POST" action="modules/quanlythuonghieu/xuly.php?idth=<?php echo $_GET['idth']; ?>" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="menuNam" class="form-label">Menu:</label>
                            <input type="text" value="<?php echo $row['TenMenu']; ?>" class="form-control" id="menuNam" name="menuNam" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="Name" class="form-label">Tên thương hiệu:</label>
                            <input type="text" value="<?php echo $row['TenTH'] ?>" class="form-control" id="Name" name="Name" placeholder="Nhập tên thương hiệu" required ">
                        </div>
                        <div class=" mb-3">
                            <label for="fileToUpload" class="form-label">Logo thương hiệu:</label>
                            <div> <img id="imagePreview" src="<?php echo "modules/quanlythuonghieu/img/$row[LogoTH]" ?>" alt="Chưa có Logo">
                            </div> <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" placeholder="Logo thương hiệu" onchange="previewImage(event)">
                        </div>
                        <div class="mb-3">
                            <label for="Order" class="form-label">Vị Trí: (sau)</label>
                            <select name="Order" class="form-select" id="Order">
                                <?php
                                $sql = "SELECT * FROM thuonghieu WHERE MaMenu = '$row[MaMenu]' ORDER BY ThuTu ASC";
                                $kq = mysqli_query($mysqli, $sql);
                                while ($row_sub = mysqli_fetch_array($kq)) {
                                    echo '<option name="Order" value="' . $row_sub['ThuTu'] . '"';
                                    if ($row['ThuTu'] == $row_sub['ThuTu']) {
                                        echo 'selected class="d-none"';
                                    }
                                    echo '>' . $row_sub['TenTH'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" name="edit">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</main>
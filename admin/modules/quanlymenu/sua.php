<?php
$sql_sua = "SELECT * FROM menu WHERE MaMenu = '$_GET[idmenu]'  LIMIT 1";
$result = mysqli_query($mysqli, $sql_sua);
$row = mysqli_fetch_array($result);
?>
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Sửa Menu sản phẩm</h1>
        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <form autocomplete="off" method="POST" action="modules/quanlymenu/xuly.php?idmenu=<?php echo $_GET['idmenu']; ?>">
                        <div class="mb-3">
                            <label for="menuName" class="form-label">Tên Menu:</label>
                            <input type="text" class="form-control" id="menuName" name="menuName" value="<?php echo $row['TenMenu']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="menuLink" class="form-label">Menu Link:</label>
                            <input type="text" class="form-control" id="menuLink" name="menuLink" value="<?php echo $row['Link']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="menuOrder" class="form-label">Vị Trí:(Sau)</label>
                            <select name="menuOrder" class="form-select" id="menuOrder">
                                <?php
                                $sql = "SELECT * FROM menu ORDER BY ThuTu ASC";
                                $kq = mysqli_query($mysqli, $sql);
                                while ($row_sub = mysqli_fetch_array($kq)) {
                                    echo '<option name="menuOrder" value="' . $row_sub['ThuTu'] . '"';
                                    if ($row['ThuTu'] - 1 == $row_sub['ThuTu']) {
                                        echo ' selected';
                                    }
                                    if ($row['ThuTu'] == $row_sub['ThuTu']) {
                                        echo 'class="d-none"';
                                    }
                                    echo '>' . $row_sub['TenMenu'] . '</option>';
                                }
                                ?>
                            </select>

                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" name="editMenu">Lưu thay đổi</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
</main>
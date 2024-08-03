<?php
$sql_sua = "SELECT * FROM slider WHERE Id = '$_GET[id]' LIMIT 1";
$result = $mysqli->query($sql_sua);
$row = mysqli_fetch_array($result);
?>
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Sửa bảng quảng cáo sản phẩm</h1>
        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <form autocomplete="off" method="POST" action="modules/quanlybangquangcao/xuly.php?id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="Order" class="form-label">Sản Phẩm:</label>
                            <select name="Order" class="form-select" id="Order">
                            <!-- WHERE MaSP = '$row[MaSP]' -->
                                <?php
                                $sql = "SELECT * FROM sanpham";
                                $kq = mysqli_query($mysqli, $sql);
                                while ($row_sub = mysqli_fetch_array($kq)) {
                                    echo '<option name="Order" value="' . $row_sub['MaSP'] . '"';
                                    if ($row['MaSP'] == $row_sub['MaSP']) {
                                        echo 'selected';
                                    }
                                    echo '>' . $row_sub['TenSP'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="">Hình ảnh:</label>
                            <div> <img id="imagePreview" src="<?php echo "modules/quanlybangquangcao/img/$row[HinhAnh]" ?>" alt="Chưa có Logo">
                            </div> <input type="file" class="form-control" name="fileToUploadImg" id="fileToUploadImg" placeholder="Logo thương hiệu" onchange="previewImage(event)">
                        </div>
                        <div class="mb-3">
                        <label for="">Video:</label>
                            <div><video id="videoPreview" controls>
                                    <source src="<?php echo "modules/quanlybangquangcao/video/$row[Video]" ?>" type="video/mp4">
                                </video><input type="file" class="form-control" name="fileToUploadVideo" id="fileToUploadVideo" placeholder="Video" onchange="previewVideo(event)">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" name="edit">Lưu thay đổi</button>
                        </div>



                    </form>
                </div>
            </div>
        </div>
</main>
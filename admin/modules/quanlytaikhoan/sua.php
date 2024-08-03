<?php
$sql_sua = "SELECT * FROM nguoidung WHERE MaND = " . $_GET['id'];
$result = $mysqli->query($sql_sua);
$row = mysqli_fetch_array($result);
?>

<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Sửa tài khoản</h1>
        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <form autocomplete="off" method="POST" action="modules/quanlytaikhoan/xuly.php?id=<?php echo $_GET['id']; ?>">
                        <div class="mb-3">
                            <label for="FullName" class="form-label">Tên người dùng:</label>
                            <input type="text" value="<?php echo $row['TenND'] ?>" class="form-control" id="FullName" name="FullName" placeholder="Nhập tên" required>
                        </div>

                        <div class="mb-3">
                            <label for="Email" class="form-label">Email:</label>
                            <input type="text" value="<?php echo $row['Email'] ?>" class="form-control" id="Email" name="Email" placeholder="Nhập email" required>
                        </div>
                        <div class="mb-3">
                            <label for="PhoneNumber" class="form-label">Số điện thoại:</label>
                            <input type="text" value="<?php echo $row['SDT'] ?>" class="form-control" id="PhoneNumber" name="PhoneNumber" placeholder="Nhập số điện thoại" required>
                        </div>
                        <div class="mb-3">
                            <label for="Password" class="form-label">Mật khẩu mới:</label>
                            <input type="text" value="" class="form-control" id="Password" name="Password" placeholder="Nhập mật khẩu">
                        </div>
                        <div class="mb-3">
                            <label for="Address" class="form-label">Địa chỉ:</label>
                            <textarea rows="5" type="text" class="form-control" id="Address" name="Address" placeholder="Nhập địa chỉ" required><?php echo $row['DiaChi'] ?></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" name="edit">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
$sql_sua = "SELECT * FROM nguoidung WHERE MaND = '" . $_SESSION['MaND'] . "' AND MaQuyen = 1";
$result = $mysqli->query($sql_sua);
$row = mysqli_fetch_array($result);
?>
<main class="content">
    <div class="container-fluid p-0">

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Hồ sơ</h1>
        </div>
        <div class="row">
            <div class="col-md-4 col-xl-3">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Chi tiết hồ sơ</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="img/avatars/avatar-2.jpg" alt="" class="img-fluid rounded-circle mb-2"
                            width="128" height="128" />
                        <h5 class="card-title mb-0"><?php
                        if (isset($_SESSION['TenND'])) {
                            echo $_SESSION['TenND'];
                        } ?></h5>
                        <div class="text-muted mb-2"></div>

                        <div>
                            <a class="btn btn-primary btn-sm" href="#">Follow</a>
                            <a class="btn btn-primary btn-sm" href="#"><span data-feather="message-square"></span>
                                Message</a>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <h5 class="h6 card-title">Skills</h5>
                        <a href="#" class="badge bg-primary me-1 my-1">HTML</a>
                        <a href="#" class="badge bg-primary me-1 my-1">JavaScript</a>
                        <a href="#" class="badge bg-primary me-1 my-1">PHP</a>
                        <a href="#" class="badge bg-primary me-1 my-1">Angular</a>
                        <a href="#" class="badge bg-primary me-1 my-1">CSS</a>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <h5 class="h6 card-title">Thông tin</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> <?php echo $row['DiaChi'] ?></li>

                            <li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span> Việt-Hàn</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-xl-9">
                <div class="card">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Sửa hồ sơ</h5>
                    </div>
                    <div class="card-body h-100">

                    <form autocomplete="off" method="POST" action="modules/hoso/xuly.php?id=<?= $_SESSION['MaND']; ?>">
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
                            <textarea rows="4" type="text" class="form-control" id="Address" name="Address" placeholder="Nhập địa chỉ" required><?php echo $row['DiaChi'] ?></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" name="edit">Lưu thay đổi</button>
                        </div>
                    </form>


                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

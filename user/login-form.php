<?php
ob_start();
session_start();
?>
<?php
$user = "";
$pass = "";
$kq = "";
require_once("../admin/config/config.php");
if (isset($_POST['login'])) {
    $user = $_POST['txtuser'];
    $pass = md5($_POST['txtpass']);
    $sql = "SELECT * FROM nguoidung WHERE (Email = '$user' OR SDT = '$user') AND MatKhau = '$pass'";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['txtuser'] = $user;
            $_SESSION['Email'] = $row["Email"];
            $_SESSION['TenND'] = $row["TenND"];
            $_SESSION['SDT'] = $row["SDT"];
            $_SESSION['DiaChi'] = $row["DiaChi"];
            $_SESSION['MaND'] = $row["MaND"];
            if ($row['MaQuyen'] == 1) {
                $_SESSION['MaAdmin'] = $row["MaND"];
                header('Location: ../admin/index.php');
                exit();
            } else {
                header('Location:index.php');
                exit();
            }
        }
    } else {
        $kq = "Thông tin không đúng vui lòng kiểm tra lại";
    }
}
?>

<?php include "header.php" ?>


<body>
    <!-- top-header-->
    <?php include "navbar.php" ?>
    <!-- header-section-->
    <div class="content">
        <div class="container">
            <div class="box">
                <div class="row">
                    <div class="col-lg-offset-1 col-lg-5 col-md-offset-1 col-md-5 col-sm-12 col-xs-12 ">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 mb20">
                                    <h3 class="mb10">Đăng Nhập</h3>
                                </div>
                                <!-- form -->
                                <form name="formlogin" id="ffi" method="POST" action="#">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only" for="email"></label>
                                            <div class="login-input">
                                                <input id="email" name="txtuser" type="text" class="form-control" placeholder="Nhập số điện thoại hoặc email để đăng nhập" required value="">
                                                <div class="login-icon"><i class="fa fa-user"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only"></label>
                                            <div class="login-input">
                                                <input name="txtpass" type="password" class="form-control" placeholder="******" required>
                                                <div class="login-icon"><i class="fa fa-lock"></i></div>
                                                <div class="eye-icon"><i class="fa fa-eye"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb20 ">
                                        <button class="submit btn-primary btn-block mb10" name="login" class="btn btn-1" name="login" id="login">Đăng Nhập</button>
                                        <p><?php echo $kq; ?></p>
                                        <div>
                                            <p> Bạn chưa có tài khoản ? <a href="signup-form.php">Đăng ký</a></p>
                                        </div>
                                    </div>
                                </form>
                                <!-- /.form -->
                            </div>
                        </div>
                    </div>
                    <!-- features -->
                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 ">
                        <div class="box-body">
                            <div class="feature-left">
                                <div class="feature-icon">
                                    <img src="./images/feature_icon_1.png" alt="">
                                </div>
                                <div class="feature-content">
                                    <h4>Giá thành hợp lý </h4>
                                </div>
                            </div>
                            <div class="feature-left">
                                <div class="feature-icon">
                                    <img src="./images/feature_icon_2.png" alt="">
                                </div>
                                <div class="feature-content">
                                    <h4>Thanh toán nhanh chóng </h4>
                                </div>
                            </div>
                            <div class="feature-left">
                                <div class="feature-icon">
                                    <img src="./images/feature_icon_3.png" alt="">
                                </div>
                                <div class="feature-content">
                                    <h4>Ưu đãi độc quyền </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.features -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.login-form -->
    <!-- footer -->
    <?php include "footer.php"
    ?>
    <!-- /.footer -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/menumaker.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery.sticky.js"></script>
    <script type="text/javascript" src="js/sticky-header.js"></script>
    <script>
        document.querySelector('.eye-icon').addEventListener('click', function() {
            var input = document.querySelector('input[name="txtpass"]');
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        });
    </script>
</body>

</html>
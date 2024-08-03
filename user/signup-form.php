<?php 
$name  = "";
$phone = "";
$email = "";
$address = "";   
$pass = "";
$repass = "";
$permission_code= '2';
$kqdk="";
if(isset($_POST['register'])) {
    require('../admin/config/config.php');
    $name  = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];   
    $pass = md5($_POST['password']);
    $repass = md5($_POST['repeat-pass']);
    $permission_code= '2';

    // Kiểm tra xem số điện thoại đã tồn tại hay chưa
    $checkPhoneQuery = "SELECT * FROM nguoidung WHERE SDT = '$phone'";
    $resultPhone = mysqli_query($mysqli, $checkPhoneQuery);

    // Kiểm tra xem email đã tồn tại hay chưa
    $checkEmailQuery = "SELECT * FROM nguoidung WHERE Email = '$email'";
    $resultEmail = mysqli_query($mysqli, $checkEmailQuery);

    if (mysqli_num_rows($resultPhone) > 0) {
        // Số điện thoại đã tồn tại, hiển thị thông báo lỗi
        $kqdk = "Số điện thoại đã được đăng ký. Vui lòng chọn một số điện thoại khác.";
    } elseif (mysqli_num_rows($resultEmail) > 0) {
        // Email đã tồn tại, hiển thị thông báo lỗi
        $kqdk = "Email đã được đăng ký. Vui lòng chọn một địa chỉ email khác.";
    } else {
        // Tiếp tục thêm dữ liệu mới nếu số điện thoại và email đều chưa tồn tại
        if($repass != $pass) {
            $kqdk = "Mật khẩu nhập lại không chính xác";
        } else {
            $sql = "INSERT INTO nguoidung (TenND, MatKhau, Email, SDT, DiaChi, MaQuyen) 
                    VALUES ('$name', '$pass', '$email', '$phone', '$address', '$permission_code')";

            if (mysqli_query($mysqli, $sql)) {
                $name = "";
                $phone = "";
                $email = "";
                $address = "";
                $pass = "";
                $repass = "";
                $permission_code = "2";
                $kqdk = "Đăng ký thành công";
            } else {
                $kqdk = "Đăng ký không thành công. Vui lòng kiểm tra lại thông tin.";
            }
        }
    }

    mysqli_close($mysqli);
}
?>

<?php include 'header.php' ?>

<body>
    <!-- top-header-->
      <?php include "navbar.php"?>
    <!-- sign-up form -->
    <div class="content">
        <div class="container">
            <div class="box sing-form">
                <div class="row">
                    <div class="col-lg-offset-1 col-lg-5 col-md-offset-1 col-md-5 col-sm-12 col-xs-12 ">
                        <!-- form -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 mb20">
                                    <h3 class="mb10">Tạo tài khoản</h3>
                                    <p>Vui lòng điền tất cả các thông tin vào mẫu Đăng ký. </p>
                                </div>
                                <form method="POST" action="" >
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only" for="name">

                                            </label>
                                            <input id="name" name="name" type="text" class="form-control"
                                                placeholder="Nhập tên của bạn" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only" for="phone"></label>
                                            <input id="phone" name="phone" type="text" class="form-control"
                                                placeholder=" Nhập số điện thoại" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only" for="email"></label>
                                            <input id="email" name="email" type="text" class="form-control"
                                                placeholder="Nhập email" required>
                                        </div>
                                    </div>                                   
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only" for="address"></label>
                                            <input id="address" name="address" type="text" class="form-control"
                                                placeholder="Nhập địa chỉ" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label  sr-only" for="password"></label>
                                            <input id="password" name="password" type="password" class="form-control"
                                                placeholder="Nhập mật khẩu" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label  sr-only" for="repeat-pass"></label>
                                            <input id="repeat-pass" name="repeat-pass" type="password" class="form-control"
                                                placeholder="Nhập lại mật khẩu" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                        <button class="btn btn-primary btn-block mb10" name="register">Đăng Ký</button>
                                        <div>
                                            <p> <?php echo $kqdk ?>
                                            <p>Bạn đã có tài khoản ? <a href="login-form.php">Đăng Nhập</a></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.form -->
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
    <!-- /.sign-up form -->
    <!-- footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <!-- footer-company-links -->
                <!-- footer-contact links -->
                <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="footer-widget">
                        <h3 class="footer-title">Contact Info </h3>
                        <div class="contact-info">
                            <span class="contact-icon"><i class="fa fa-map-marker"></i></span>
                            <span class="contact-text">1683 Pickens Way Sherman,<br>
                                Bird Street Albuquerque
                                Us 75090</span>
                        </div>
                        <div class="contact-info">
                            <span class="contact-icon"><i class="fa fa-phone"></i></span>
                            <span class="contact-text">+180-123-4567 / 89</span>
                        </div>
                        <div class="contact-info">
                            <span class="contact-icon"><i class="fa fa-envelope"></i></span>
                            <span class="contact-text">info@demo.com</span>
                        </div>
                    </div>
                </div>
                <!-- /.footer-useful-links -->
                <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="footer-widget">
                        <h3 class="footer-title">Quick Links</h3>
                        <ul class="arrow">
                            <li><a href="#">Home </a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Mobiles</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.footer-useful-links -->
                <!-- footer-policy-list-links -->
                <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="footer-widget">
                        <h3 class="footer-title">Policy Info</h3>
                        <ul class="arrow">
                            <li><a href="#">Payments</a></li>
                            <li><a href="#">Cancellation &amp; Returns</a></li>
                            <li><a href="#">Shipping and Delivery</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">T &amp; C</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.footer-policy-list-links -->
                <!-- footer-social links -->
                <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="footer-widget">
                        <h3 class="footer-title">Connect With Us</h3>
                        <div class="ft-social">
                            <span><a href="#" class="btn-social btn-facebook"><i class="fa fa-facebook"></i></a></span>
                            <span><a href="#" class="btn-social btn-twitter"><i class="fa fa-twitter"></i></a></span>
                            <span><a href="#" class="btn-social btn-googleplus"><i
                                        class="fa fa-google-plus"></i></a></span>
                            <span><a href="#" class=" btn-social btn-linkedin"><i class="fa fa-linkedin"></i></a></span>
                            <span><a href="#" class=" btn-social btn-pinterest"><i
                                        class="fa fa-pinterest-p"></i></a></span>
                            <span><a href="#" class=" btn-social btn-instagram"><i
                                        class="fa fa-instagram"></i></a></span>
                        </div>
                    </div>
                </div>
                <!-- /.footer-social links -->
            </div>
        </div>
        <!-- tiny-footer -->
        <div class="tiny-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="payment-method alignleft">
                            <ul>
                                <li><a href="#"><i class="fa fa-cc-paypal fa-2x"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-mastercard  fa-2x"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-visa fa-2x"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-discover fa-2x"></i></a></li>
                            </ul>
                        </div>
                        <p class="alignright">Copyright © All Rights Reserved 2020 Template Design by
                            <a href="https://easetemplate.com/" target="_blank" class="copyrightlink">EaseTemplate</a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- /. tiny-footer -->
        </div>
    </div>
    <!-- /.footer -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/menumaker.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery.sticky.js"></script>
    <script type="text/javascript" src="js/sticky-header.js"></script>
</body>

</html>
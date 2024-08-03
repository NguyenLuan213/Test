<?php
ob_start();
session_start();
require("../admin/config/config.php");
?>

<?php include 'header.php' ?>

<body>
    <!-- top-header-->
    <?php include('navbar.php'); ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <div class="post-block ">

                                <div class="post-content">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3835.7387116137143!2d108.25104871414655!3d15.975015746200913!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108997dc971f%3A0x1295cb3d313469c9!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiB2w6AgVHJ1eeG7gW4gdGjDtG5nIFZp4buHdCAtIEjDoG4!5e0!3m2!1svi!2s!4v1653638363103!5m2!1svi!2s"
                                        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class=" widget widget-categories">
                        <div class="widget-head">
                            <h2 class="widget-title">Thông tin liên hệ</h2>
                        </div>
                        <div class="widget-body">
                            <ul class="arrow">
                                <a> Trường Đại học Công nghệ Thông tin và Truyền thông Việt - Hàn</a>
                                <br>
                                <a><b>Địa chỉ:</b> 470 Đ. Trần Đại Nghĩa, Khu đô thị, Ngũ Hành Sơn, Đà Nẵng 550000</a>

                                <br>
                                <a><b>SĐT:</b> 0123456789</a>
                                <br>
                                <a><b>Email:</b>mobistore@gmail.com</a>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- footer -->
    <?php include('footer.php'); ?>
</body>

</html>
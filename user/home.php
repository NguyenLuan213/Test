<!-- slider -->
<?php require('../admin/config/config.php'); ?>
<div class="slider">
    <div class="owl-carousel owl-one owl-theme">

        <?php
        $sql = "SELECT sanpham.*, slider.HinhAnh, thuonghieu.*
            FROM sanpham 
            INNER JOIN slider ON sanpham.MaSP = slider.MaSP
            INNER JOIN thuonghieu ON sanpham.MaTH = thuonghieu.MaTH LIMIT 4";


        $result = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $mota = explode(',', $row['MoTa']);
            // Lấy ra tối đa 3 chuỗi
            $mota = array_slice($mota, 0, 3);
            $mota = implode("|", $mota);
            echo '<div class="item">
            <div class="slider-img">
                <img src="../admin/modules/quanlysanpham/img/' . $row['HinhAnh'] . '" alt="' . $row['HinhAnh'] . '">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-6 col-xs-12">
                        <div class="slider-captions">
                            
                            <h1 class="slider-title"> <span>' . $row['TenSP'] . '</span></h1>
                            <p class="hidden-xs">' . $mota . '</p>
                            <p class="slider-price">' . number_format($row['GiaHienTai'], 0, '', '.') . '</p>
                            <a href="product-single.php?idsp=' . $row['MaSP'] . '" class="btn btn-primary btn-lg hidden-xs">Mua Ngay</a>
                        </div>
                    </div>
                </div>
            </div>
            </div>';
        }
        ?>
    </div>
</div>
<!-- /.slider -->
<!-- mobile showcase -->
<div class="space-medium">
    <div class="container">
        <div class="row">

            <?php
            $sql = "SELECT sanpham.*, slider.*, thuonghieu.*
                    FROM sanpham 
                    INNER JOIN slider ON sanpham.MaSP = slider.MaSP
                    INNER JOIN thuonghieu ON sanpham.MaTH = thuonghieu.MaTH LIMIT 2";
            $result = mysqli_query($mysqli, $sql);
            while ($row = mysqli_fetch_array($result)) {
                echo '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="showcase-block active">
                        <div class="display-logo alignleft" >
                            <a > <img height="100" width="auto" src="../admin/modules/quanlythuonghieu/img/' . $row['LogoTH'] . '" alt="' . $row['TenTH'] . '">
                            </a>
                        </div>
                        <div class="showcase-img">
                            <video id="myVideo" autoplay muted loop preload="auto" poster="">
                                <source src="../admin/modules/quanlybangquangcao/video/' . $row['Video'] . '" type="video/mp4 ">
                            </video>
                        </div>
                    </div>
                </div>';
            }
            ?>


        </div>
    </div>
    <!-- /.mobile showcase -->
    <!-- latest products -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box">
                    <div class="box-head">
                        <h3 class="head-title">Sản phẩm mới </h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <!-- product -->
                            <?php

                            $sql = "SELECT * FROM sanpham ORDER BY MaSP DESC LIMIT 4;"; //số phẩm được lấy ra 
                            $result = mysqli_query($mysqli, $sql);

                            //Hiển thị
                            while ($row = mysqli_fetch_array($result)) {

                                echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">';
                                echo '<div class="product-block">
                                        <div class="product-img">
                                            <div class="thumbnail">
                                                <a href="product-single.php?idsp=' . $row['MaSP'] . '"><img src="../admin/modules/quanlysanpham/img/' . $row['HinhAnh'] . '" alt="' . $row['HinhAnh'] . '"></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h5><a href="product-single.php?idsp=' . $row['MaSP'] . '" class="product-title">' . $row['TenSP'] . '
                                                    <br>
                                                    <strong>(' . $row['BoNho'] . ', ' . $row['Mau'] . ')</strong>
                                                </a></h5>
                                            <div class="product-meta"><a href="product-single.php?idsp=' . $row['MaSP'] . '" class="product-price">' . number_format($row['GiaHienTai'], 0, '', '.') . ' ₫</a>
                                                <a href="product-single.php?idsp=' . $row['MaSP'] . '" class="discounted-price"><strike>' . number_format($row['Gia'], 0, '', '.') . ' ₫</strike></a>

                                            </div>
                                            <div class=" body1">
                                            <a href="processImmediateBuy.php?idsp=' . $row['MaSP'] . ' ">
                                            <button class="button">
                                                Mua ngay
                                            </button></a>
                        
                                            <a class="addtocart" name="addtocart" data-idsp="' . $row['MaSP'] . '" href="addProductToCart.php?idsp=' . $row['MaSP'] . ' " >
                                            <button class="button">
                                                Giỏ hàng
                                                <svg class="cartIcon" viewBox="0 0 576 512">
                                                    <path
                                                        d="M0 24C0 10.7 10.7 0 24 0H69.5c22 
                                                                    0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 
                                                                    28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 
                                                                    24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 
                                                                    48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                                                    </path>
                                                </svg>
                                            </button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            } ?>
                            <!-- /.product -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.latest products -->
    <!-- seller products -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box">
                    <div class="box-head">
                        <h3 class="head-title">Sản phẩm bán chạy </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-carousel">
            <div class="box-body">
                <div class="row">
                    <div class="owl-carousel owl-two owl-theme">
                        <!-- product -->

                        <?php
                        $sql = "SELECT * FROM sanpham ORDER BY MaSP DESC LIMIT 10;";//số sản phẩm được lấy ra 
                        $result = mysqli_query($mysqli, $sql);

                        //Hiển thị
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<div class="item">';
                            echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="product-block">
                                        <div class="product-img">
                                            <div class="thumbnail">
                                                <a href="product-single.php?idsp=' . $row['MaSP'] . '"><img src="../admin/modules/quanlysanpham/img/' . $row['HinhAnh'] . '" alt="' . $row['HinhAnh'] . '"></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h5><a href="product-single.php?idsp=' . $row['MaSP'] . '" class="product-title">' . $row['TenSP'] . '
                                                    <br>
                                                    <strong>(' . $row['BoNho'] . ', ' . $row['Mau'] . ')</strong>
                                                </a></h5>
                                            <div class="product-meta"><a href="product-single.php?idsp=' . $row['MaSP'] . '" class="product-price">' . number_format($row['GiaHienTai'], 0, '', '.') . ' ₫</a>
                                                <a href="product-single.php?idsp=' . $row['MaSP'] . '" class="discounted-price"><strike>' . number_format($row['Gia'], 0, '', '.') . ' ₫</strike></a>

                                            </div>
                                            <div class=" body1">
                                            <a href="processImmediateBuy.php?idsp=' . $row['MaSP'] . ' ">
                                            <button class="button">
                                                Mua ngay
                                            </button></a>
                        
                                            <a class="addtocart" name="addtocart" data-idsp="' . $row['MaSP'] . '" href="addProductToCart.php?idsp=' . $row['MaSP'] . ' " >
                                            <button class="button">
                                                Giỏ hàng
                                                <svg class="cartIcon" viewBox="0 0 576 512">
                                                    <path
                                                        d="M0 24C0 10.7 10.7 0 24 0H69.5c22 
                                                                    0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 
                                                                    28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 
                                                                    24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 
                                                                    48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                                                    </path>
                                                </svg>
                                            </button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div> </div>';
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.seller products -->
    <!-- featured products -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box">
                    <div class="box-head">
                        <h3 class="head-title">Gợi ý hôm nay</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <!-- product -->
                            <?php

                            $sql = "SELECT * FROM sanpham ORDER BY RAND() LIMIT 4";
                            $result = mysqli_query($mysqli, $sql);

                            //Hiển thị
                            while ($row = mysqli_fetch_array($result)) {
                                echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">';
                                echo '<div class="product-block">
                                        <div class="product-img">
                                            <div class="thumbnail">
                                                <a href="product-single.php?idsp=' . $row['MaSP'] . '"><img src="../admin/modules/quanlysanpham/img/' . $row['HinhAnh'] . '" alt="' . $row['HinhAnh'] . '"></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h5><a href="product-single.php?idsp=' . $row['MaSP'] . '" class="product-title">' . $row['TenSP'] . '
                                                    <br>
                                                    <strong>(' . $row['BoNho'] . ', ' . $row['Mau'] . ')</strong>
                                                </a></h5>
                                            <div class="product-meta"><a href="product-single.php?idsp=' . $row['MaSP'] . '" class="product-price">' . number_format($row['GiaHienTai'], 0, '', '.') . ' ₫</a>
                                                <a href="product-single.php?idsp=' . $row['MaSP'] . '" class="discounted-price"><strike>' . number_format($row['Gia'], 0, '', '.') . ' ₫</strike></a>

                                            </div>
                                            <div class=" body1">
                                            <a href="processImmediateBuy.php?idsp=' . $row['MaSP'] . ' ">
                                            <button class="button">
                                                Mua ngay
                                            </button></a>
                        
                                            <a class="addtocart" name="addtocart" data-idsp="' . $row['MaSP'] . '" href="addProductToCart.php?idsp=' . $row['MaSP'] . ' " >
                                            <button class="button">
                                                Giỏ hàng
                                                <svg class="cartIcon" viewBox="0 0 576 512">
                                                    <path
                                                        d="M0 24C0 10.7 10.7 0 24 0H69.5c22 
                                                                    0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 
                                                                    28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 
                                                                    24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 
                                                                    48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                                                    </path>
                                                </svg>
                                            </button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            } ?>
                            <!-- /.product -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.featured products -->
    <!-- features -->
    <div class="bg-default pdt40">
        <div class="container">
            <div class="row">
                <!-- features -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="feature-left">
                        <div class="feature-outline-icon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div class="feature-content">
                            <h3 class="text-white">Thanh toán an toàn</h3>
                            <p>Đảm bảo rằng mọi giao dịch diễn ra một cách an toàn và tin cậy, bảo vệ thông tin cá nhân và tài chính của người tham gia</p>
                        </div>
                    </div>
                </div>
                <!-- features -->
                <!-- features -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="feature-left">
                        <div class="feature-outline-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="feature-content">
                            <h3 class="text-white">Hỗ trợ 24/7</h3>
                            <p> Kỹ thuật viên và đội ngũ hỗ trợ của chúng tôi đều có mặt 24/7, sẵn lòng giải quyết mọi thách thức và yêu cầu của bạn.</p>
                        </div>
                    </div>
                </div>
                <!-- features -->
                <!-- features -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="feature-left feature-circle">
                        <div class="feature-outline-icon">
                            <i class="fa fa-rotate-left "></i>
                        </div>
                        <div class="feature-content">
                            <h3 class="text-white">Hoàn trả miễn phí</h3>
                            <p>Chúng tôi cam kết đặt lợi ích của khách hàng lên hàng đầu, chính sách hoàn trả miễn phí của chúng tôi được thiết kế để mang lại sự thoải mái và hài lòng tối đa cho bạn.</p>
                        </div>
                    </div>
                </div>
                <!-- features -->
                <!-- features -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="feature-left">
                        <div class="feature-outline-icon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <div class="feature-content">
                            <h3 class="text-white">Giá cạnh tranh</h3>
                            <p>Chúng tôi tự hào về cam kết cung cấp giá cạnh tranh nhất để đảm bảo khách hàng của chúng tôi nhận được giá trị tối đa cho mỗi đồng chi trả.</p>
                        </div>
                    </div>
                </div>
                <!-- features -->
            </div>
        </div>
    </div>
</div>
<!-- /.features -->
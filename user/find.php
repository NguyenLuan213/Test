<?php
ob_start();
session_start();
require("../admin/config/config.php");
?>
<?php include 'header.php' ?>


<body>
    <?php include('navbar.php'); ?>

    <!-- slider -->
    <div class="space-medium">
        <div class="container">
            <div class="row">
                <?php
                $kqqq = "";
                if (isset($_POST["find-product"])) {
                    $tentimkiem = $_POST["find"];
                    $sql2 = "SELECT * FROM sanpham  WHERE TenSP LIKE '%$tentimkiem%'";
                    $result = $mysqli->query($sql2);
                    if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)) {

                            echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb30">';
                            echo '<div class="product-block">
                        <div class="product-img">
                            <div class="thumbnail">
                                <a href="product-single.php?idsp=' . $row['MaSP'] . '"><img src="../admin/modules/quanlysanpham/img/' . $row['HinhAnh'] . '" alt="' . $row['HinhAnh'] . '"></a>
                            </div>
                        </div>
                        <div class="product-content">
                            <h5><a href="#" class="product-title">' . $row['TenSP'] . '
                                    <br>
                                    <strong>(' . $row['BoNho'] . ', ' . $row['Mau'] . ')</strong>
                                </a></h5>
                            <div class="product-meta"><a href="#" class="product-price">' . number_format($row['GiaHienTai'], 0, '', '.') . ' ₫</a>
                                <a href="#" class="discounted-price"><strike>' . number_format($row['Gia'], 0, '', '.') . ' ₫</strike></a>
    
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
                        }

                    } else {
                        $kqqq = "Thông tin không đúng vui lòng kiểm tra lại";
                    }
                }
                echo '<h3>' . $kqqq . '</h3>';
                ?>

            </div>
        </div>
    </div>
    <?php include "footer.php"
        ?>

</body>

</html>
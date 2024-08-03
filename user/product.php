<?php session_start();
require("../admin/config/config.php") ?>
<?php include 'header.php' ?>

<body>
    <?php include 'navbar.php' ?>
    <!-- /. header-section-->

    <!-- product-list -->
    <div class="content">
        <div class="container">
            <?php
            $result = mysqli_query($mysqli, 'SELECT COUNT(sanpham.MaSP)  as total
            FROM sanpham 
            JOIN thuonghieu ON sanpham.MaTH = thuonghieu.MaTH 
            WHERE sanpham.MaTH =' . $_GET['idth']);

            $row = mysqli_fetch_assoc($result);
            //lấy tổng ra
            $total_records = $row['total'];
            if ($total_records > 0) {
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                //Giới hạn mỗi trang
                $limit = 8;
                //
            
                $total_pages = ceil($total_records / $limit);
                //
                if ($current_page > $total_pages) {
                    $current_page = $total_pages;
                } else if ($current_page < 1) {
                    $current_page = 1;
                }

                //
                $start = ($current_page - 1) * $limit;
                $sql = "select * from sanpham  LIMIT $start, $limit";






                // $sql = "SELECT * FROM sanpham WHERE MaTH = " . $_GET['idth'] . " LIMIT $start, $limit";
                $sql = "SELECT sanpham.* FROM sanpham 
                    INNER JOIN thuonghieu ON sanpham.MaTH = thuonghieu.MaTH
                    INNER JOIN menu ON thuonghieu.MaMenu = menu.MaMenu
                    WHERE menu.MaMenu = " . $_GET['mamenu'] . " AND sanpham.MaTH = " . $_GET['idth'] . "  
                    LIMIT $start, $limit";

                $result = mysqli_query($mysqli, $sql);
                if ($result->num_rows > 0) {
                    ?>
                   
                    <!-- product -->

                    <?php

                    //Hiển thị
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
                    } ?>
                    <!-- /.product -->


                    <div class="row">
                        <!-- pagination start -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="st-pagination">
                                <ul class="pagination">
                                    <?php
                                    $idth = isset($_GET['idth']) ? $_GET['idth'] : '';
                                    $mamenu = $_GET['mamenu'];
                                    if ($current_page > 1 && $total_pages > 1) {
                                        echo '<li><a href="product.php?mamenu=' . $mamenu . '&idth=' . $idth . '&page=' . ($current_page - 1) . '" aria-label="previous"><span aria-hidden="true">Trước</span></a>';
                                    }
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == $current_page) {
                                            echo '<li class="active"><a href="product.php?mamenu=' . $mamenu . '&idth=' . $idth . '&page=' . $i . '">' . $i . ' </a></li>';
                                        } else {
                                            echo '<li><a href="product.php?mamenu=' . $mamenu . '&idth=' . $idth . '&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                    }
                                    if ($current_page < $total_pages && $total_pages > 1) {
                                        echo '<li> <a href="product.php?mamenu=' . $mamenu . '&idth=' . $idth . '&page=' . ($current_page + 1) . '" aria-label="Next"><span aria-hidden="true">Sau</span></a>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <!-- pagination close -->
                    </div>
                <?php }
            } else {
                echo '<h2 class="mbs">Trang này hiện đang trống . Vui lòng liên hệ lại admin</h2>';
            } ?>
        </div>
    </div>
    <!-- /.product-list -->
    <!-- footer -->
    <?php include('footer.php'); ?>
</body>

</html>
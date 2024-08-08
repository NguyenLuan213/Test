<?php
session_start();
?>

<?php include 'header.php' ?>

<body>
    <!-- top-header-->
    <?php include 'navbar.php' ?>
    <div class="space-medium">
        <div class="container">


            <div class="row">

                <?php

                if (isset($_SESSION['giohang']) && !empty($_SESSION['giohang'])) {
                    $giohang_reversed = array_reverse($_SESSION['giohang']);
                    echo '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="box">
                        <div class="box-head">
                            <h3 class="head-title">Giỏ hàng của tôi</h3>
                        </div>
                        <!-- cart-table-section -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <div class="cart">
                                    <table class="table table-bordered ">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <span>Sản Phẩm</span>
                                                </th>
                                                <th></th>
                                                <th>
                                                    <span>Giá</span>
                                                </th>
                                                <th>
                                                    <span>Số Lượng</span>
                                                </th>
                                                <th>
                                                    <span>Tổng Cộng</span>
                                                </th>
                                                <th>
                                                </th>
                                            </tr>
                                        </thead>';
                    foreach ($giohang_reversed as $sanpham) {
                        $hinh_san_pham = $sanpham["HinhAnh"];
                        echo '<tbody>
                                            <tr>
                                                <td><a href="product-single.php?idsp=' . $sanpham['MaSP'] . '" class="thumb-img"><img src="../admin/modules/quanlysanpham/img/' . $sanpham["HinhAnh"] . '" alt="' . $sanpham["HinhAnh"] . '"></a>
                                                </td>
                                                <td>                                                    <div class="name_thumb-img"><a href="product-single.php?idsp=' . $sanpham['MaSP'] . '">' . $sanpham["TenSP"] . '</a></div>
                                                </td>
                                                <td class="text-nowrap">' . number_format($sanpham['GiaHienTai'], 0, '', '.') . ' ₫</td>
                                                <td>
                                             
                                                    <div class="product-quantity">
                                                        <div class="quantity text-nowrap">
                                                        <a href="addProductToCart.php?tru=' . $sanpham['MaSP'] . '"><i class="fa fa-minus"></i></a>
                                                        <input class="input-text qty text" min="1" max="6" name="quantity" title="Số lượng" size="4" pattern="[0-9]*" 
                                                        value="' . $sanpham['soluongsp'] . '" id="soluong_' . $sanpham['soluongsp'] . '" readonly>
                                                        <a href="addProductToCart.php?cong=' . $sanpham['MaSP'] . '"><i class="fa fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">' . number_format($sanpham['GiaHienTai'] * $sanpham['soluongsp'], 0, '', '.') . ' ₫</td>
                                                <th scope="row"><a href="removefromcart.php?idsp=' . $sanpham['MaSP'] . '" class="btn-close"><i class="fa fa-times-circle-o"></i></a></th>
                                        </tbody>';
                    }
                    echo '
                                        
                                        </table>  
                                          
            <div class="text-align-end"><a href="removefromcart.php?xoatatca=1" class="btn btn-danger">Xóa tất cả</a></div>
     
                                </div> <!-- cart -->
                            </div> <!-- /.table-responsive-->
                        </div><!-- /.cart-table-section -->
                    </div>
                    <a href="product-list.php?mamenu=2" class="btn-link"><i class="fa fa-angle-left"></i> Quay lại Mua sắm</a>
                </div>
                <!-- cart-total -->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="box mb30">
                        <div class="box-head">
                            <h3 class="head-title">Chi tiết giá</h3>
                        </div>
                        <div class="box-body">
                            <div class=" table-responsive">
                                <div class="pay-amount ">
                                    <table class="table mb20">
                                        <tbody>
                                            <tr>
                                                <th>
                                                    <span>Giá (' .  array_sum(array_column($_SESSION['giohang'], 'soluongsp')) . ' sản phẩm)</span>
                                                </th>
                                                <td class="text-nowrap">';
                    $tong_gia_tri = 0;
                    if (isset($_SESSION['giohang']) && !empty($_SESSION['giohang'])) {
                        foreach ($giohang_reversed as $sanpham) {
                            $tong_gia_tri += $sanpham['GiaHienTai'] * $sanpham['soluongsp'];
                        }
                    }
                    echo number_format($tong_gia_tri);
                    echo ' ₫</td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <span>Phí vận chuyển</span>
                                                </th>
                                                <td><strong class="text-green">Miễn phí</strong></td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <th>
                                                    <span class="mb0" style="font-weight: 700;">Số tiền phải trả</span>
                                                </th>
                                                <td class="text-nowrap" style="font-weight: 700; color: #1c1e1e; ">' . number_format($tong_gia_tri) . ' ₫</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                    
                                    <a href="processImmediateBuy.php"><button type="submit" class="btn btn-primary btn-block">Tiến hành thanh toán</button></a>
                                

                            </div>
                        </div>
                    </div>
                  
                </div>';
                } else {
                    echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: flex; justify-content: center;">
                            <p class="alert alert-info" style="text-align: center; width: 80%;">Giỏ hàng của bạn trống.</p>
                        </div>
                        <div class="mt-5">&nbsp;</div>
                        <div class="mt-5">&nbsp;</div>
                        ';
                }
                ?>
            </div>

        </div>
        <!-- footer -->
        <?php include 'footer.php' ?>


</body>

</html>
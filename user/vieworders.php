<?php
session_start();
require("../admin/config/config.php");
?>

<?php include 'header.php' ?>

<body>
    <!-- top-header-->
    <?php include 'navbar.php' ?>
    <div class="space-medium">
        <div class="container">
            <div class="row">
                <div class="col-12 text-align-end mds">
                    <a href="order-history.php" class="btn btn-primary btn-xs"><i class="bi bi-arrow-left-circle"></i>
                        Quay lại</a>
                </div>

            </div>
            <div class="row">
                <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                    <div class="table-responsive">
                        <div class="cart">
                            <table class="table table-bordered ">

                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th></th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Số Lượng </th>
                                        <th>Đơn Giá</th>
                                        <th>Thành Tiền</th>
                                    </tr>
                                </thead>
                                <?php
                                $code = $_GET['code'];
                                $sql_danhsach = "SELECT * FROM chitiethoadon,sanpham WHERE chitiethoadon.MaSP = sanpham.MaSP AND chitiethoadon.CodeDH = '$code'  ORDER BY sanpham.MaSP DESC";
                                $result = mysqli_query($mysqli, $sql_danhsach);
                                $tongtien = 0;
                                $i = 1;
                                while ($row = mysqli_fetch_array($result)) {
                                    $tongtien += ($row['GiaHienTai'] * $row['SoLuongMua']);
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php echo $i++; ?>
                                            </td>
                                            <td><a href="product-single.php?idsp=<?php echo $row['MaSP'] ?>"
                                                    class="thumb-img"><img src="../admin/modules/quanlysanpham/img/<?php echo $row['HinhAnh'] ?>"
                                                        alt="<?php echo $row['TenSP'] ?>">
                                                </a>
                                            </td>
                                            <td><a href="product-single.php?idsp=<?php echo $row['MaSP'] ?>">
                                                    <?php echo $row['TenSP'] ?>
                                                </a>
                                            </td>
                                            <td>
                                                <?php echo $row['SoLuongMua'] ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($row['GiaHienTai'], 0, '', '.') . ' đ'; ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($row['GiaHienTai'] * $row['SoLuongMua'], 0, '', '.') . ' đ' ?>
                                            </td>

                                        </tr>
                                    </tbody>
                                <?php } ?>
                                <tr class="table-info">
                                    <td colspan="5" class="text-end">Tổng tiền:</td>
                                    <td class="fw-bold">
                                        <?php echo number_format($tongtien, 0, '', '.') . ' đ' ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- footer -->
    <?php include 'footer.php' ?>


</body>

</html>
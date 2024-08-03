<?php
require_once("../admin/config/config.php");
require_once("config_vnpay.php");
ob_start();
session_start();
?>
<?php if (!isset($_SESSION['MaND'])) {
    header("Location: ./login-form.php");
    exit();
} ?>

<?php include 'header.php'; ?>

<body>
    <!-- top-header-->
    <?php include "navbar.php"; ?>

    <div class="space-medium">
        <div class="container-fluid">
            <form name="formorder" id="ffi" method="POST" action="payment-processing.php">

                <div class="row">
                    <div class="col-12">
                        <?php
                        if (isset($_GET['idsp'])) {
                            $idsp = $_GET['idsp'];
                            $sql = "SELECT * FROM sanpham WHERE MaSP =" . $idsp;
                            $result = mysqli_query($mysqli, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $_SESSION['GiaHienTai'] = $row['GiaHienTai'];
                            echo '';
                            echo '<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                    <div class="box-head">
                                        <h3 class="head-title">Chi tiết đơn hàng</h3>
                                    </div>
                                    <!-- cart-table-section -->
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <div class="cart">
                                                <table class="table table-bordered ">
                                                    <thead>
                                                        <tr>
                                                            <th><span>Sản Phẩm</span></th>
                                                            <th></th>
                                                            <th><span>Giá</span></th>
                                                            <th><span>Số Lượng</span></th>                                                        </tr>
                                                    </thead>';
                            echo '<tbody>
                                                        <tr>
                                                            <td>
                                                                <a><img src="../admin/modules/quanlysanpham/img/' . $row['HinhAnh'] . '" alt="' . $row['HinhAnh'] . '"></a>
                                                                <input type="hidden" name="idsp" value=" ' . $row['MaSP'] . ' ">
                                                            </td>
                                                            <td>
                                                                <div class="name_thumb-img"><a href="product-single.php?idsp=' . $row['MaSP'] . '">' . $row['TenSP'] . '</a></div>
                                                            </td>
                                                            <td class="text-nowrap">' . number_format($row['GiaHienTai'], 0, '', '.') . ' ₫</td>
                                                            <td>
                                                            <input type="number" class="input-text qty text buy-quantity" step="1" min="1" max="3" name="quantity" id="quantity" value="' . (isset($_GET['quantity']) ? $_GET['quantity'] : 1) . '" title="Qty" size="4" pattern="[0-9]*">
                                                            <input type="hidden" id="price" value=" ' . $row['GiaHienTai'] . '">
                                                            
                                                            </td>
                                                    </tbody>
                                                     <tr class="table-info">
                                                        <td colspan="2" class="">Tổng tiền: </td>
                                                        <td colspan="2" class="text-right fw-bold total"> </td>
                                                    ';
                            echo '</table>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        } else {
                            echo '<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                    <div class="box-head">
                                        <h3 class="head-title">Chi tiết đơn hàng</h3>
                                    </div>
                                    <!-- cart-table-section -->
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <div class="cart">
                                                <table class="table table-bordered ">
                                                    <thead>
                                                        <tr>
                                                            <th><span>Sản Phẩm</span></th>
                                                            <th></th>
                                                            <th><span>Giá</span></th>
                                                            <th><span>Số Lượng</span></th>
                                                            <th><span>Tổng Cộng</span></th>
                                                        </tr>
                                                    </thead>';
                            foreach (array_reverse($_SESSION['giohang']) as $sanpham) {
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
                                                                <input class="input-text qty text" min="1" max="3" name="quantity" title="Số lượng" size="4" pattern="[0-9]*" 
                                                                value="' . $sanpham['soluongsp'] . '" id="soluong_' . $sanpham['soluongsp'] . '" readonly>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-nowrap">' . number_format($sanpham['GiaHienTai'] * $sanpham['soluongsp'], 0, '', '.') . ' ₫</td>
                                                </tbody> ';
                            }
                            echo '</table>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                    </div>

                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">Thông tin khách hàng</div>
                            <div class="panel-body">
                                <div>
                                    <div class="form-group">
                                        <label for="tenKhachHang">Tên khách hàng:</label>
                                        <input type="text" class="form-control" id="tenKhachHang" name="TenNguoiNhan" value="<?php echo $_SESSION['TenND']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="dienThoai">Điện thoại:</label>
                                        <input type="text" class="form-control" id="dienThoai" name="SDT" value="<?php echo $_SESSION['SDT']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="hidden" class="form-control" id="email" value="<?php echo $_SESSION['Email']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="diaChi">Địa chỉ giao hàng:</label>
                                        <textarea rows="4" class="form-control" id="DiaChiHD" placeholder="Nhập địa chỉ giao hàng" name="DiaChiHD" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($_GET['idsp'])) {

                            echo '<button class="btn btn-primary btn-block" name="order">Đặt hàng</button>
                            <input type="hidden" id="total_hidden"  name="vnp_Amount" readonly>                                
                            ';
                        } else {
                            $tong_gia_tri = 0;
                            if (isset($_SESSION['giohang']) && !empty($_SESSION['giohang'])) {
                                foreach ($_SESSION['giohang'] as $sanpham) {
                                    $tong_gia_tri += $sanpham['GiaHienTai'] * $sanpham['soluongsp'];
                                }
                            }
                            echo '<button class="btn btn-primary btn-block" name="AllPayOrders">Đặt hàng</button>
                            <input type="hidden" name="vnp_Amount" value=" ' . $tong_gia_tri . '">
                            ';
                        }
                        ?>
                    </div>
                    <div class="col-lg-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">Hình thức thanh toán</div>
                            <div class="panel-body">
                                <div>
                                    <div class="form-group">
                                        <input type="radio" id="tienmat" name="payment" value="tienmat" checked>
                                        <label for="tienmat">Tiền mặt</label><br>
                                        <input type="radio" id="VNPay" name="payment" value="vnpay">
                                        <label for="VNPay"><img src="./images/vnpay-image.jpg" style="width: 25px; height: 25px;"> VNPay</label><br>
                                        <input type="radio" id="momo" name="payment" value="momo">
                                        <label for="momo"><img src="./images/momo-image.jpg" style="width: 25px; height: 25px;"> Momo</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.cart-section -->
    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- /.footer -->
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#quantity').on('input', function() {
            // Lấy giá trị số lượng và số tiền
            var quantity = parseInt($(this).val(), 10);
            var price = parseFloat($('#price').val());

            // Tính tổng tiền

            var total_hidden = quantity * price;
            $('#total_hidden').val(total_hidden);

            var total = quantity * price;
            $('.total').text(total.toLocaleString('vi-VN') + ' ₫');
        });

        // Tính tổng tiền ngay khi tải trang nếu cần
        $('#quantity').trigger('input');
    });
</script>


</html>
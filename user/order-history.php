<?php
require("../admin/config/config.php");
session_start();
?>

<?php include 'header.php' ?>

<body>
    <!-- top-header-->
    <?php include 'navbar.php' ?>
    <div class="space-medium">
        <div class="container">


            <div class="row">

                <div class="col-12">
                    <div class="box">
                        <div class="box-head">
                            <h3 class="head-title">Đơn hàng của tôi</h3>
                        </div>
                        <!-- cart-table-section -->
                        <div class="box-body">
                            <div class="table-responsive">

                                <div class="cart ">
                                    <table class="table-hover table table-bordered ">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Ngày đặt</th>

                                                <th>Địa chỉ nhận hàng</th>
                                                <!-- <th>Số điện thoại</th>
                                                <th>Địa chỉ</th> -->
                                                <th>Phương thức thanh toán</th>
                                                <th>Tình trạng</th>
                                                <th>Chi tiết</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody class="myTable" id="myTable">
                                            <?php
                                            $sql_danhsach = "SELECT * FROM hoadon ORDER BY hoadon.MaHD DESC";
                                            $result = mysqli_query($mysqli, $sql_danhsach);
                                            $i = 1;
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                                    <tr class="table-bordered table-hover" data-href="vieworders.php?code=<?php echo $row['CodeDH']; ?>">

                                                        <td class="td-table">
                                                            <input type="hidden" class="codedh" value="<?php echo $row['CodeDH']; ?>">
                                                            <input type="hidden" class="huydon" value="<?php echo $row['DaHuy']; ?>">
                                                            <?php echo $i++; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['NgayLap']; ?>

                                                        </td>

                                                        <td style="max-width: 270px; word-wrap: break-word;">
                                                            <?php
                                                            echo $row['TenNguoiNhan'] . '<br>';
                                                            echo $row['SDT'] . '<br>';
                                                            echo $row['DiaChiHD'];
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($row['ThanhToan'] == 'vnpay') {
                                                                echo 'Thanh toán bằng VNPay';
                                                            } else  if ($row['ThanhToan'] == 'tienmat') {
                                                                echo 'Thanh toán khi nhận hàng';
                                                            } else  if ($row['ThanhToan'] == 'momo') {
                                                                echo 'Thanh toán bằng Momo';
                                                            } ?>


                                                        </td>

                                                        <td>
                                                            <?php if ($row['TrangThai'] == 0) {
                                                                echo 'Đang xử lý';
                                                            } else {
                                                                echo 'Đang giao';
                                                            } ?>
                                                        </td>
                                                        <td>
                                                            <a class="btn-detail" href="vieworders.php?code=<?php echo $row['CodeDH']; ?>">
                                                                <i class="bi bi-eye align-middle me-2"></i> Chi tiết
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <?php if ($row['TrangThai'] == 0) {
                                                                if ($row['DaHuy'] == 0) {
                                                                    echo '<button type="button" class="btn-cancel" >Hủy đơn</button>';
                                                                } else {
                                                                    echo '<button type="button" class="btn-cancel" disabled>Đã hủy</button>';
                                                                }
                                                            } else {
                                                                echo '<button type="button" class="btn-cancel" title="Đơn hàng đang giao, không thể hủy đơn."  disabled>Hủy đơn</button>';
                                                            } ?>

                                                        </td>

                                                    </tr>
                                            <?php }
                                            } else {
                                                echo '<td  colspan="8"><h2 class="text-center">Bạn chưa có đơn hàng nào !</h2></td>';
                                            } ?>
                                        </tbody>


                                    </table>


                                </div> <!-- cart -->
                            </div> <!-- /.table-responsive-->
                        </div><!-- /.cart-table-section -->
                    </div>
                </div>
                <!-- cart-total -->

            </div>

        </div>
        <!-- footer -->
        <?php include 'footer.php' ?>


</body>
<script>
    // $(document).ready(function() {
    //     $('#myTable tr').dblclick(function() {
    //         window.location.href = $(this).data('href');
    //     });
    // });
</script>

<script>
    $(document).ready(function() {
        $(".btn-cancel").click(function() {
            var $button = $(this);
            var $row = $button.closest('tr');
            var $huydon = $row.find('.huydon');
            var codedh = $row.find('.codedh').val();
            var huydonValue = $huydon.val();

            var newHuydonValue = huydonValue === '0' ? '1' : '0';
            var newButtonText = newHuydonValue === '0' ? 'Hủy đơn' : 'Đã hủy';

            console.log('Code Hóa đơn: ' + codedh);
            console.log('Hủy đơn trước: ' + huydonValue);
            console.log('Thay đổi huydon thành: ' + newHuydonValue);

            $.ajax({
                url: 'addProductToCart.php',
                type: 'get',
                data: {
                    codedh: codedh,
                    huydon: newHuydonValue
                },
                success: function(data) {
                    $huydon.val(newHuydonValue);
                    $button.replaceWith('<button type="button" class="btn-cancel" disabled>Đã hủy</button>');
                    console.log('Thành công');
                },
                error: function() {
                    console.log('Lỗi');
                }
            });
        });
    });
</script>

</html>
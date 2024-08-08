<?php
$sql_danhsach = "SELECT * FROM hoadon ORDER BY hoadon.MaHD DESC";
$result = mysqli_query($mysqli, $sql_danhsach);
?>
<!-- // echo 'DH-' . strtoupper(substr(uniqid(), -8)); -->
<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-9">
                <h1 class="h3 mb-3">Danh sách đơn hàng</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill p-3">
                    <table class="table table-hover my-0" id="table1">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã Đơn Hàng</th>
                                <th>Địa chỉ nhận hàng</th>
                                <th> Phương thức thanh toán</th>
                                <th>Trạng thái</th>
                                <th>Xem Chi Tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['CodeDH']; ?></td>
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
                                    <td><?php
                                        if ($row['DaHuy'] == 0) {
                                            if ($row['TrangThai'] == 1) {

                                                echo '<a class="text-decoration-none badge bg-success" href="modules/quanlydonhang/xuly.php?tt=1&code=' . $row['CodeDH'] . '">Đang giao</a>';
                                            } else {
                                                echo '<a class="text-decoration-none badge bg-warning" href="modules/quanlydonhang/xuly.php?tt=0&code=' . $row['CodeDH'] . '">Đơn Hàng mới</a>';
                                            }
                                        } else {
                                            echo '<a class="text-decoration-none badge bg-secondary" >Đã hủy</a>';
                                        }
                                        ?></td>

                                    <td><a class="btn btn-sm btn-primary" href="?action=donhang&query=xemdonhang&code=<?php echo $row['CodeDH']; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye align-middle me-2">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>Chi tiết</a></td>
                                </tr>
                            <?php   }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
</main>
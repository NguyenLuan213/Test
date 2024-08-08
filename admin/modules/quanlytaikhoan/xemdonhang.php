<?php
$MaND = $_GET['id'];
$sql_danhsach = "SELECT * FROM hoadon INNER JOIN nguoidung ON hoadon.MaND = nguoidung.MaND WHERE hoadon.MaND = $MaND ORDER BY hoadon.MaHD DESC";
$result = mysqli_query($mysqli, $sql_danhsach);
?>
<!-- // echo 'DH-' . strtoupper(substr(uniqid(), -8)); -->
<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-9">
                <h1 class="h3 mb-3">Danh sách đơn hàng theo người dùng</h1>
            </div>
            <div class="col-3 text-end">
                <button type="button" class="btn btn-primary btn-lg" onclick="goBack()">
                    <i class="bi bi-arrow-left-circle"></i> Quay lại
                </button>
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
                                <th>Tên Khách Hàng</th>
                                <th>Số Điện Thoại </th>
                                <th>Địa Chỉ</th>
                                <th>Tình Trạng</th>
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
                                    <td><?php echo $row['TenNguoiNhan']; ?></td>
                                    <td><?php echo $row['SDT']; ?></td>
                                    <td style="max-width: 200px; word-wrap: break-word; ">
                                        <?php echo $row['DiaChiHD']; ?>
                                    </td>
                                    <td><?php
                                        if ($row['TrangThai'] == 1) {
                                            echo '<a class="text-decoration-none badge bg-success" href="modules/quanlydonhang/xuly.php?tt=1&code=' . $row['CodeDH'] . '">Đã xem</a>';
                                        } else {
                                            echo '<a class="text-decoration-none badge bg-warning" href="modules/quanlydonhang/xuly.php?tt=0&code=' . $row['CodeDH'] . '">Đơn Hàng mới</a>';
                                        }
                                        ?></td>
                                    <td><a class="btn btn-sm btn-primary" href="?action=donhang&query=xemdonhang&code=<?php echo $row['CodeDH']; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye align-middle me-2">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>Chi tiết</a></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
</main>
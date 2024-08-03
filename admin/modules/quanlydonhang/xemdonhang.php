<?php
$code = $_GET['code'];
$sql_danhsach = "SELECT * FROM chitiethoadon,sanpham WHERE chitiethoadon.MaSP = sanpham.MaSP AND chitiethoadon.CodeDH = '$code'  ORDER BY sanpham.MaSP DESC";
$result = mysqli_query($mysqli, $sql_danhsach);
?>
<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-9">
                <h1 class="h3 mb-3">Xem đơn hàng</h1>
            </div>
            <div class="col-3 text-end">
                <a href="index.php?action=quanlydonhang&query=danhsach" class="btn btn-primary btn-lg"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-plus-circle align-middle me-2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="16"></line>
                        <line x1="8" y1="12" x2="16" y2="12"></line>
                    </svg>Danh sách</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill p-3">

                    <table class="table table-hover my-0">

                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã Đơn Hàng</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Số Lượng </th>
                                <th>Đơn Giá</th>
                                <th>Thành Tiền</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $tongtien = 0;
                            $i = 1;
                            while ($row = mysqli_fetch_array($result)) {
                                $tongtien += ($row['GiaHienTai'] * $row['SoLuongMua']);
                                echo '<tr>
                                    <td>' . $i++ . '</td>
                                    <td>' . $row['CodeDH'] . '</td>
                                    <td>' . $row['TenSP'] . '</td>
                                    <td>' . $row['SoLuongMua'] . '</td>
                                    <td>' . number_format($row['GiaHienTai'], 0, '', '.') . '</td>
                                    <td>' . number_format($row['GiaHienTai'] * $row['SoLuongMua'], 0, '', '.') . '</td>   
                                </tr>';
                            }
                            echo '<tr class="table-info"><td colspan="5" class="text-end">Tổng tiền:</td><td class="fw-bold">' . number_format($tongtien, 0, '', '.') . '</td></tr>';
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</main>
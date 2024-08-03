<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-9">
                <h1 class="h3 mb-3">Danh sách sản phẩm</h1>
            </div>
            <div class="col-3 text-end">
                <a href="index.php?action=quanlysanpham&query=them" class="btn btn-primary btn-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle align-middle me-2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="16"></line>
                        <line x1="8" y1="12" x2="16" y2="12"></line>
                    </svg>Thêm sản phẩm</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill p-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Danh mục:</h5>
                    </div>
                    <div class="mb-3">
                        <select name="menuOrder" class="form-select" id="menuOrder">
                            <?php
                            $sql = "SELECT * FROM thuonghieu ORDER BY ThuTu ASC";
                            $result = mysqli_query($mysqli, $sql);
                            $selectedId = isset($_GET['id']) ? $_GET['id'] : 'all';

                            if ($selectedId !== 'all') {
                                echo '<option value="all">Tất cả</option>';
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option value="' . $row['MaTH'] . '"';
                                    if ($row['MaTH'] == $selectedId) {
                                        echo ' selected';
                                    }
                                    echo '>' . $row['TenTH'] . '</option>';
                                }
                            } else {
                                echo '<option value="all" selected>Tất cả</option>';
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option value="' . $row['MaTH'] . '">' . $row['TenTH'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <table class="table table-hover my-0" id="table1">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Hình Ảnh</th>
                                <th class="d-none d-xl-table-cell">Màu</th>
                                <th class="d-none d-xl-table-cell">Bộ nhớ</th>
                                <th>Số lượng</th>
                                <th class="d-none d-xl-table-cell">Giá gốc</th>
                                <th>Giá bán</th>
                                <th class="d-none  d-xl-table-cell">Mô tả</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selectedId = isset($_GET['id']) ? $_GET['id'] : 'all';
                            $sqlWhere = ($selectedId !== 'all') ? "WHERE MaTH = $selectedId" : "";
                            $sql = "SELECT * FROM sanpham $sqlWhere ORDER BY MaSP DESC";
                            $result = mysqli_query($mysqli, $sql);
                            $i = 1;
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<tr>
                                            <td>' . $i++ . '</td>
                                            <td>' . $row['TenSP'] . '</td>
                                            <td><img width=auto height=80 src="modules/quanlysanpham/img/' . $row['HinhAnh'] . '" alt=""> </td>
                                            <td class="d-none d-xl-table-cell">' . $row['Mau'] . '</td>
                                            <td class="d-none d-xl-table-cell">' . $row['BoNho'] . '</td>
                                            <td>' . $row['SoLuong'] . '</td>
                                            <td class="d-none d-xl-table-cell">' . number_format($row['Gia'], 0, '', '.') . '</td>
                                            <td>' . number_format($row['GiaHienTai'], 0, '', '.') . '</td>
                                            <td style="max-width: 300px; word-wrap: break-word;" class="d-none d-xl-table-cell">' . $row['MoTa'] . '</td>
                                            <td><a class="btn btn-sm btn-primary" href="?action=quanlysanpham&query=sua&idsp=' . $row['MaSP'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit align-middle me-2">
                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                    </svg>Sửa</a></td>
                                            <td><a name="' . $row['MaSP'] . '" class="btn btn-sm btn-danger" href="modules/quanlysanpham/xuly.php?idsp=' . $row['MaSP'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 align-middle me-2">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg>Xóa</a></td>
                                        </tr>';
                                }
                            } else {
                                echo '<tr><td colspan="11" class="p-4 text-center">Không có sản phẩm</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
</main>
<!-- //quan lý sản phẩm danh sách -->
<script>
    document.getElementById('menuOrder').addEventListener('change', function() {
        // Lấy giá trị của id từ Order
        var id = this.value;

        // Gửi id qua thẻ GET để sử dụng trong PHP
        window.location.href = '?action=quanlysanpham&query=danhsach&id=' + id;
    });
</script>
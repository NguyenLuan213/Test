<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-9">
                <h1 class="h3 mb-3">Danh sách tài khoản</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill p-3">
                   
                    <table class="table table-hover my-0" id="table1">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên người dùng</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <!-- <th>Mật khẩu</th> -->
                                <th>Địa chỉ</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                                <th>Đã Mua</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM nguoidung WHERE MaQuyen = 2 ORDER BY MaND DESC";
                            $result = mysqli_query($mysqli, $sql);
                            $i = 1;
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<tr>
                                            <td>' . $i++ . '</td>
                                            <td>' . $row['TenND'] . '</td>
                                            <td>' . $row['Email'] . '</td>
                                            <td>' . $row['SDT'] . '</td>
                                           
                                            <td>' . $row['DiaChi'] . '</td>
                                            <td><a class="btn btn-sm btn-primary" href="?action=quanlytaikhoan&query=sua&id=' . $row['MaND'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit align-middle me-2">
                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                    </svg>Sửa</a></td>
                                            <td><a class="btn btn-sm btn-danger" href="modules/quanlytaikhoan/xuly.php?id=' . $row['MaND'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 align-middle me-2">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg>Xóa</a></td>
                                                    </td>
                                    <td><a class="btn btn-sm btn-primary" href="?action=quanlytaikhoan&query=xemdonhang&id=' . $row['MaND'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye align-middle me-2">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>Chi tiết</a></td>
                                </tr>
                                        </tr>';
                                }
                            } else {
                                echo '<tr><td colspan="11" class="p-4 text-center">Không có tài khoản</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
</main>
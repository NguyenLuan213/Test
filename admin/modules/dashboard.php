<?php

$mysqli->query("SELECT DATE_FORMAT(CONVERT_TZ(NgayLap, '+00:00', '+07:00'), '%d/%m/%Y') as formatted_date FROM HoaDon");
// nguoidung.TenND,MaND hoadon.* chitiethoadon.* nguoidung.MaND = hoadon.MaND chitiethoadon.MaHD = hoadon.MaHD chitiethoadon.MaSP = sanpham.MaSP
// $sql = "SELECT nguoidung.TenND, nguoidung.MaND, hoadon.*, 
// 		chitiethoadon.*, sanpham.*, 
// 		SUM(chitiethoadon.SoLuong * chitiethoadon.Gia) AS TongTien
// 		FROM nguoidung
// 		JOIN hoadon ON nguoidung.MaND = hoadon.MaND
// 		JOIN chitiethoadon ON chitiethoadon.MaHD = hoadon.MaHD
// 		JOIN sanpham ON chitiethoadon.MaSP = sanpham.MaSP
// 		GROUP BY hoadon.MaHD
// 		ORDER BY hoadon.NgayLap DESC;";
$sql = "SELECT * FROM hoadon ORDER BY hoadon.MaHD DESC";
$result = mysqli_query($mysqli, $sql);
$sum = mysqli_fetch_array(mysqli_query($mysqli, "SELECT SUM(sanpham.GiaHienTai * chitiethoadon.SoLuongMua) AS TongDonHang
FROM chitiethoadon, sanpham
WHERE chitiethoadon.MaSP = sanpham.MaSP;"));
$rowcount = mysqli_num_rows($result);
$tongkhachhang = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM nguoidung WHERE MaQuyen = 2"));//dùng hàm trả về số lượng 
// $row = mysqli_fetch_array($result);
// echo "Ngày giờ hiện tại: " . date_format(date_create($row["NOW()"]), "d/m/Y H:i:s") . "<br>";
?>
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3">Bảng Thống Kê</h1>
		<div class="row">
			<div class="col-xl-12 col-xxl-12 d-flex">
				<div class="w-100">
					<div class="row">
						
						<div class="col-sm-4">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Khách Hàng</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="users"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?php echo $tongkhachhang; ?></h1>
									<div class="mb-0">
										<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i></span>
										<span class="text-muted">Thời điểm hiện tại</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Thu Nhập</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="dollar-sign"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?php echo number_format($sum['TongDonHang'], 0, '', '.'); ?> đ</h1>
									<div class="mb-0">
										<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i></span>
										<span class="text-muted">Thời điểm hiện tại</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Đặt Hàng</h5>
										</div>
										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="shopping-cart"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?php echo $rowcount ?></h1>
									<div class="mb-0">
										<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i></span>
										<span class="text-muted">Thời điểm hiện tại</span>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-lg-12 col-xxl-12 d-flex">
				<div class="card flex-fill p-3">
					<div class="card-header">
						<h5 class="card-title mb-0">Người mua gần đây</h5>
					</div>
					<table class="table table-hover my-0" id="table1">
						<thead>
							<tr>
								<th>STT</th>
								<th>Mã Đơn Hàng</th>
								<th>Tên Khách Hàng</th>
								<th>Số Điện Thoại </th>
								<th>Địa Chỉ</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 0;
							while ($row = mysqli_fetch_array($result)) {
								echo '<tr>
								<td>' . $i++ . '</td>
								<td>' . $row['CodeDH'] . '</td>
								<td>' . $row['TenNguoiNhan'] . '</td>
								<td>' . $row['SDT'] . '</td>
								<td>' . $row['DiaChiHD'] . '</td>
							</tr>';
							}
							?>
						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
</main>
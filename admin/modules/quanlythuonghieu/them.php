<main class="content">
	<div class="container-fluid p-0">
		<div class="row">
			<div class="col-8">
				<h1 class="h3 mb-3">Thêm thương hiệu</h1>
			</div>
			<div class="col-4 text-end">
				<a href="?action=quanlythuonghieu&query=danhsach" class="btn btn-primary btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye align-middle me-2">
						<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
						<circle cx="12" cy="12" r="3"></circle>
					</svg>Danh sách thương hiệu</a>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card p-4">
					<form method="POST" action="modules/quanlythuonghieu/xuly.php" enctype="multipart/form-data">
						<div class="mb-3">
							<label for="menuOrder" class="form-label">Menu:</label>

							<select name="menuOrder" class="form-select" id="menuOrder">
								<?php
								$sql = "SELECT * FROM menu ORDER BY ThuTu ASC";
								$result = mysqli_query($mysqli, $sql);
								$count = 0;

								$selectedId = isset($_GET['id']) ? $_GET['id'] : 2;

								while ($row = mysqli_fetch_array($result)) {
									echo '<option ';
									if ($row['MaMenu'] ==  $selectedId) {
										echo 'selected';
									}
									if ($count == 0) {
										echo ' class="d-none"';
									}
									echo ' value="' . $row['MaMenu'] . '">' . $row['TenMenu'] . '</option>';
									$count++;
								}
								?>
							</select>

						</div>
						<div class="mb-3">
							<label for="Name" class="form-label">Tên thương hiệu:</label>
							<input type="text" class="form-control" id="Name" name="Name" placeholder="Nhập tên thương hiệu" required>
						</div>
						<div class="mb-3">
							<label for="fileToUpload" class="form-label">Logo thương hiệu:</label>
							<input type="file" class="form-control" name="fileToUpload" id="fileToUpload" placeholder="Logo thương hiệu" required>
						</div>
						<div class="mb-3">
							<label for="Order" class="form-label">Vị Trí:</label>
							<select name="Order" class="form-select" id="Order">
								<?php
								$selectedId = isset($_GET['id']) ? $_GET['id'] : 2;
								$sql = "SELECT * FROM thuonghieu WHERE MaMenu = $selectedId ORDER BY ThuTu ASC";
								$result = mysqli_query($mysqli, $sql);
								if (mysqli_num_rows($result) > 0) {
									while ($row = mysqli_fetch_array($result)) {

										echo '<option class="p-5" value="' . $row['ThuTu'] + 1 . '">' . $row['TenTH'] . '</option>';
									}
								} else {
									echo '<option class="p-5">Không có dữ liệu</option>';
								}
								?>
							</select>
						</div>
						<div class="d-flex justify-content-end">
							<button type="submit" class="btn btn-primary" name="add">Thêm</button>
						</div>
					</form>
				</div>
			</div>
		</div>
</main>
<!-- thêm quản lí thương hiệu -->
<script>
	document.getElementById('menuOrder').addEventListener('change', function() {
		// Lấy giá trị của id từ Order
		var id = this.value;

		// Gửi id qua thẻ GET để sử dụng trong PHP
		window.location.href = '?action=quanlythuonghieu&query=them&id=' + id;
	});
</script>

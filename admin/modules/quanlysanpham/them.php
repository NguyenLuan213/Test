<main class="content">
	<div class="container-fluid p-0">
		<div class="row">
			<div class="col-8">
				<h1 class="h3 mb-3">Thêm sản phẩm</h1>
			</div>
			<div class="col-4 text-end">
				<a href="?action=quanlysanpham&query=danhsach" class="btn btn-primary btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye align-middle me-2">
						<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
						<circle cx="12" cy="12" r="3"></circle>
					</svg>Danh sách</a>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card p-4">
					<form method="POST" action="modules/quanlysanpham/xuly.php" enctype="multipart/form-data">
						<div class="mb-3">
							<label for="Category" class="form-label">Danh mục:</label>

							<select name="Category" class="form-select" id="Category">
								<?php
								$sql = "SELECT * FROM thuonghieu ORDER BY ThuTu ASC";
								$result = mysqli_query($mysqli, $sql);
								while ($row = mysqli_fetch_array($result)) {
									echo '<option value="' . $row['MaTH'] . '">' . $row['TenTH'] . '</option>';
								}
								?>
							</select>

						</div>
						<div class="mb-3">
							<label for="Name" class="form-label">Tên sản phẩm:</label>
							<input type="text" class="form-control" id="Name" name="Name" placeholder="Nhập tên sản phẩm" required>
						</div>
						<div class="mb-3">
							<label for="fileToUpload" class="form-label">Hình ảnh:</label>
							<input type="file" class="form-control" name="fileToUpload" id="fileToUpload" placeholder="Hình" required>
						</div>
						<div class="mb-3">
							<label for="Color" class="form-label">Màu:</label>
							<input type="text" class="form-control" id="Color" name="Color" placeholder="Nhập màu" required>
						</div>
						<div class="mb-3">
							<label for="Memory" class="form-label">Bộ nhớ:</label>
							<input type="text" class="form-control" id="Memory" name="Memory" placeholder="Nhập bộ nhớ" required>
						</div>
						<div class="mb-3">
							<label for="Quantity" class="form-label">Số lượng:</label>
							<input type="number" min="1" max="40" class="form-control" id="Quantity" name="Quantity" placeholder="Nhập số lượng" required>
						</div>
						<div class="mb-3">
							<label for="OriginalPrice" class="form-label">Giá gốc:</label>
							<input type="number" class="form-control" id="OriginalPrice" name="OriginalPrice" placeholder="Nhập giá gốc" required>
						</div>
						<div class="mb-3">
							<label for="SalePrice" class="form-label">Giá bán:</label>
							<input type="number" class="form-control" id="SalePrice" name="SalePrice" placeholder="Nhập giá bán" required>
						</div>
						<div class="mb-3">
							<label for="Description" class="form-label">Mô tả:</label>
							<textarea rows="5" type="text" class="form-control" id="Description" name="Description" placeholder="Nhập mô tả" required></textarea>
						</div>
						<div class="d-flex justify-content-end">
							<button type="submit" class="btn btn-primary" name="add">Thêm</button>
						</div>

					</form>
				</div>
			</div>
		</div>
</main>
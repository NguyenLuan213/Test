<main class="content">
	<div class="container-fluid p-0">
		<div class="row">
			<div class="col-9">
				<h1 class="h3 mb-3">Thêm Menu sản phẩm</h1>
			</div>
			<div class="col-3 text-end">
				<a href="?action=quanlymenu&query=danhsach" class="btn btn-primary btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye align-middle me-2">
						<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
						<circle cx="12" cy="12" r="3"></circle>
					</svg>Danh sách Menu</a>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card p-4">
					<form method="POST" action="modules/quanlymenu/xuly.php">
						<div class="mb-3">
							<label for="menuName" class="form-label">Tên Menu:</label>
							<input type="text" class="form-control" id="menuName" name="menuName" placeholder="Nhập tên menu">
						</div>
						<div class="mb-3">
							<label for="menuLink" class="form-label">Menu Link:</label>
							<input type="text" class="form-control" id="menuLink" name="menuLink" placeholder="Nhập menu link">
						</div>
						<div class="mb-3">
							<label for="menuOrder" class="form-label">Vị Trí:</label>
							<select name="menuOrder" class="form-select" id="menuOrder">
								<?php
								$sql = "SELECT * FROM menu ORDER BY ThuTu ASC";
								$result = mysqli_query($mysqli, $sql);
								while ($row = mysqli_fetch_array($result)) {
									echo '<option name="menuOrder" class="p-5" value="' . $row['ThuTu'] + 1 . '">' . $row['TenMenu'] . '</option>';
								}
								?>
							</select>
						</div>
						<div class="d-flex justify-content-end">
							<button type="submit" class="btn btn-primary" name="addMenu">Thêm</button>
						</div>
					</form>
				</div>
			</div>
		</div>
</main>
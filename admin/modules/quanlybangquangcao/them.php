<main class="content">
	<div class="container-fluid p-0">
		<div class="row">
			<div class="col-8">
				<h1 class="h3 mb-3">Thêm SP quảng cáo</h1>
			</div>
			<div class="col-4 text-end">
				<a href="?action=quanlybangquangcao&query=danhsach" class="btn btn-primary btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye align-middle me-2">
						<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
						<circle cx="12" cy="12" r="3"></circle>
					</svg>Danh sách SP quảng cáo</a>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card p-4">
					<form method="POST" action="modules/quanlybangquangcao/xuly.php" enctype="multipart/form-data">
						<div class="mb-3">
							<label for="Order" class="form-label">Sản Phẩm:</label>
							<select id="mySelect" name="Order" class="form-select" id="Order">
								<?php
								$sql = "SELECT * FROM sanpham";
								$result = mysqli_query($mysqli, $sql);
								$count = 0;
								while ($row = mysqli_fetch_array($result)) {
									echo '<option value="' . $row['MaSP'] . '">' . $row['TenSP'] . '</option>';
									$count++;
								}
								?>
							</select>

						</div>

						<div class="mb-3">
						<label for="">Hình ảnh:</label>
							<div> <img id="imagePreview" class="d-none" alt="Chưa có Logo">
							</div> <input type="file" class="form-control" name="fileToUploadImg" id="fileToUploadImg" placeholder="Logo thương hiệu" onchange="previewImage(event)" required>
						</div>
						<div class="mb-3">
						<label for="">Video:</label>
							<div><video id="videoPreview" class="d-none" controls>
									<source src="" type="video/mp4">
								</video><input type="file" class="form-control" name="fileToUploadVideo" id="fileToUploadVideo" placeholder="Video" onchange="previewVideo(event)" required>
							</div>
							<div class="d-flex justify-content-end">
								<button type="submit" class="btn btn-primary" name="add">Thêm</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
</main>
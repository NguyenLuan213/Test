<?php
session_start();
require("../admin/config/config.php");
date_default_timezone_set("Asia/Ho_Chi_Minh");

$mand = $_SESSION['MaND'];
$idsp = $_POST['idsp'];
$nhanxet = $_POST['textarea_content'];
$rating = $_POST['rating']; /// Lấy số sao đánh giá từ yêu cầu

//thiếu mã người dùng 
$sql = "INSERT INTO DanhGia(MaND ,MaSP,Diem, NhanXet, NgayDanhGia) VALUES ($mand,'$idsp','$rating','$nhanxet',NOW())";

if ($mysqli->query($sql) === TRUE) {
  $sql = "SELECT * FROM danhgia WHERE MaSP = " . $idsp . " ORDER BY MaDG DESC";
  $result = mysqli_query($mysqli, $sql);
  if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
      if (isset($_SESSION['MaAdmin']) || $_SESSION['MaND'] == $row["MaND"]) {
        $del = '<a class="text-decoration-none badge bg-warning" href="del_cmt.php?idsp=' . $idsp . '&madg=' . $row['MaDG'] . '">Xóa</a>';
      } else {
        $del = '';
      }
      $rating = $row['Diem']; // Số sao đánh giá
      echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <p class="reviews-text">Bởi <span class="text-default">' . $_SESSION['TenND'] . '</span> ' . $row['NgayDanhGia'] . ' '. $del .' </p>
          <div class="product-rating">';
      // Hiển thị số sao đánh giá
      for ($i = 0; $i < $rating; $i++) {
        echo '<span><i class="fa fa-star"></i></span> ';
      }
      for ($i = $rating; $i < 5; $i++) {
        echo '<span><i class="fa fa-star-o"></i></span> ';
      }
      echo '</div>
          
          <p>' . $row['NhanXet'] . '.</p>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="divider-line"></div>
      </div>';
    }
  }
  $mysqli->close();
}

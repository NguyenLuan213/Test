<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$strTime = strftime("%H-%M-%S_%d-%B-%Y", time());

require_once('../../config/config.php');
$category = $_POST['Category']; //mã thương hiệu
$name = $_POST['Name']; //tên SP
$color = $_POST['Color'];
$memory = $_POST['Memory'];
$quantity = $_POST['Quantity'];
$originalPrice = $_POST['OriginalPrice']; // Giá 
$salePrice = $_POST['SalePrice']; //Giá Hiện Tại
$description = $_POST['Description']; //Mô tả

$target_dir = "img/"; //chỉ định thư mục nơi tệp sẽ được đặt
$target_file = $target_dir . $strTime . basename($_FILES["fileToUpload"]["name"]); //chỉ định đường dẫn của tệp sẽ được tải lên
if (!empty($_FILES["fileToUpload"]["name"])) {
    $rename = $strTime . basename($_FILES["fileToUpload"]["name"]);//tạo lưu trữ tên mới bao gồm thời gian và tên gốc
} else {
    $rename = '';
}

if (isset($_POST['add'])) {
    //thêm
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    $sql_them = "INSERT INTO sanpham (TenSP, HinhAnh, Mau, BoNho, SoLuong, Gia, GiaHienTai, MoTa) VALUES ('$name', '$rename', '$color', '$memory', '$quantity', '$originalPrice', '$salePrice', '$description')";
    $mysqli->query($sql_them);
    header("Location: ../../index.php?action=quanlysanpham&query=danhsach");
} elseif (isset($_POST['edit'])) {
    //sửa
    if ($rename != '') {
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $sql = "SELECT * FROM sanpham WHERE MaSP = " . $_GET['idsp'];
        $row = mysqli_fetch_array($mysqli->query($sql));
        unlink("./img/$row[HinhAnh]");
        $sql_update = "UPDATE  sanpham set TenSP = '$name', HinhAnh = '$rename', Mau = '$color', BoNho = '$memory', SoLuong = '$quantity', Gia = '$originalPrice', GiaHienTai = '$salePrice', MoTa = '$description' WHERE MaSP = " . $_GET['idsp'];
    } else {
        $sql_update = "UPDATE  sanpham set TenSP = '$name', Mau = '$color', BoNho = '$memory', SoLuong = '$quantity', Gia = '$originalPrice', GiaHienTai = '$salePrice', MoTa = '$description' WHERE MaSP = " . $_GET['idsp'];
    }
    $mysqli->query($sql_update);
    header("Location: ../../index.php?action=quanlysanpham&query=danhsach");
} elseif (isset($_GET['idsp'])) {
    //xóa
    $sql = "SELECT * FROM sanpham WHERE MaSP = " . $_GET['idsp'];
    while ($row = mysqli_fetch_array($mysqli->query($sql))) {
        unlink("./img/$row[HinhAnh]");
        mysqli_query($mysqli, "DELETE FROM sanpham WHERE MaSP = " . $_GET['idsp']);
    }
    header("Location: ../../index.php?action=quanlysanpham&query=danhsach");
}

<?php
require_once('../../config/config.php');
$fullName = $_POST['FullName'];
$email = $_POST['Email'];
$phoneNumber = $_POST['PhoneNumber'];
$address = $_POST['Address'];

if (isset($_POST['edit'])) {
    if (!empty($_POST['Password'])) {
        $password = ", MatKhau = '". md5($_POST['Password']) ."'";
    }
    else {
        $password ='';
    }
    //sửa
    $sql_update = "UPDATE  nguoidung set TenND = '$fullName', Email = '$email', SDT = '$phoneNumber', DiaChi = '$address' ". $password ." WHERE MaND = " . $_GET['id'];
    $mysqli->query($sql_update);
    header("Location: ../../index.php?action=quanlytaikhoan&query=danhsach");
} elseif (isset($_GET['id'])) {
    //xóa
    mysqli_query($mysqli, "DELETE FROM nguoidung WHERE MaND = " . $_GET['id']);
    header("Location: ../../index.php?action=quanlytaikhoan&query=danhsach");
}

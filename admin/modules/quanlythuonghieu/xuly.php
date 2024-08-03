<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$strTime = strftime("%H-%M-%S_%d-%B-%Y", time());

require_once('../../config/config.php');
$idmenu = $_POST['menuOrder']; //id Menu
$name = $_POST['Name']; //tên TH
$order = $_POST['Order']; //vị trí thương hiệu

$target_dir = "img/"; //chỉ định thư mục nơi tệp sẽ được đặt
$target_file = $target_dir . $strTime . basename($_FILES["fileToUpload"]["name"]); //chỉ định đường dẫn của tệp sẽ được tải lên
if (!empty($_FILES["fileToUpload"]["name"])) {
    $rename = $strTime . basename($_FILES["fileToUpload"]["name"]);
} else {
    $rename = '';
}
if (isset($_POST['add'])) {
    //thêm
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    $sql_sua = "UPDATE thuonghieu SET ThuTu = ThuTu + 1 WHERE ThuTu >= " . $order;
    $row = $mysqli->query($sql_sua);
    $sql_them = "INSERT INTO thuonghieu (TenTH, LogoTH, ThuTu, MaMenu) VALUES ('$name', '$rename', '$order', $idmenu)";
    $mysqli->query($sql_them);
    header("Location: ../../index.php?action=quanlythuonghieu&query=danhsach");
} elseif (isset($_POST['edit'])) {
    //sửa
    if ($rename != '') {
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $sql = "SELECT * FROM thuonghieu WHERE MaTH = " . $_GET['idth'];
        $row = mysqli_fetch_array($mysqli->query($sql));
        unlink("./img/$row[LogoTH]");
        $sql_sua = "UPDATE thuonghieu SET ThuTu = ThuTu + 1 WHERE ThuTu >= " . $order + 1;
        $mysqli->query($sql_sua);
        $sql_update = "UPDATE  thuonghieu set TenTH = '$name' , ThuTu = $order + 1, LogoTH = '$rename' WHERE MaTH = " . $_GET['idth'];
    } else {
        $sql_sua = "UPDATE thuonghieu SET ThuTu = ThuTu + 1 WHERE ThuTu >= " . $order + 1;
        $mysqli->query($sql_sua);
        $sql_update = "UPDATE  thuonghieu set TenTH = '$name' , ThuTu = $order + 1 WHERE MaTH = " . $_GET['idth'];
    }
    $mysqli->query($sql_update);
    header("Location: ../../index.php?action=quanlythuonghieu&query=danhsach");
} elseif (isset($_GET['idth'])) {
    //xóa
    $sql = "SELECT * FROM thuonghieu WHERE MaTH = " . $_GET['idth'];
    while ($row = mysqli_fetch_array($mysqli->query($sql))) {
        unlink("./img/$row[LogoTH]");
        mysqli_query($mysqli, "DELETE FROM thuonghieu WHERE MaTH = " . $_GET['idth']);
    }
    header("Location: ../../index.php?action=quanlythuonghieu&query=danhsach");
}

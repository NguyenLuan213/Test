<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$strTime = strftime("%H-%M-%S_%d-%B-%Y", time());

require_once('../../config/config.php');
$masp = $_POST['Order']; //Mã SP

//$target_dir = "img/"; //chỉ định thư mục nơi tệp sẽ được đặt
$target_file_img = "img/" . $strTime . basename($_FILES["fileToUploadImg"]["name"]); //chỉ định đường dẫn của tệp sẽ được tải lên
$target_file_video = "video/" . $strTime . basename($_FILES["fileToUploadVideo"]["name"]); //chỉ định đường dẫn của tệp sẽ được tải lên
$rename_img = (!empty($_FILES["fileToUploadImg"]["name"])) ? $strTime . basename($_FILES["fileToUploadImg"]["name"]) : '';
$rename_video = (!empty($_FILES["fileToUploadVideo"]["name"])) ? $strTime . basename($_FILES["fileToUploadVideo"]["name"]) : '';

if (isset($_POST['add'])) {
    //thêm
    move_uploaded_file($_FILES["fileToUploadImg"]["tmp_name"], $target_file_img);
    move_uploaded_file($_FILES["fileToUploadVideo"]["tmp_name"], $target_file_video);

    $sql_them = "INSERT INTO slider (MaSP, HinhAnh, Video) VALUES ($masp, '$rename_img', '$rename_video')";
    $mysqli->query($sql_them);
    header("Location: ../../index.php?action=quanlybangquangcao&query=danhsach");
} elseif (isset($_POST['edit'])) {
    //sửa

    $sql = "SELECT * FROM slider WHERE Id = " . $_GET['id'];
    $row = mysqli_fetch_array($mysqli->query($sql));
    if ($rename_img != '' && $rename_video != '') {
        move_uploaded_file($_FILES["fileToUploadImg"]["tmp_name"], $target_file_img);
        move_uploaded_file($_FILES["fileToUploadVideo"]["tmp_name"], $target_file_video);
        unlink("./img/$row[HinhAnh]");
        unlink("./video/$row[Video]");
        $sql_update = "UPDATE slider SET MaSP = '$masp', HinhAnh = '$rename_img', Video = '$rename_video' WHERE Id = " . $_GET['id'];
    } elseif ($rename_img == '' && $rename_video == '') {
        $sql_update = "UPDATE slider SET MaSP = '$masp' WHERE Id = " . $_GET['id'];
    } elseif ($rename_img != '' && $rename_video == '') {
        move_uploaded_file($_FILES["fileToUploadImg"]["tmp_name"], $target_file_img);
        unlink("./img/$row[HinhAnh]");
        $sql_update = "UPDATE slider SET MaSP = '$masp', HinhAnh = '$rename_img' WHERE Id = " . $_GET['id'];
    } else {
        move_uploaded_file($_FILES["fileToUploadVideo"]["tmp_name"], $target_file_video);
        unlink("./video/$row[Video]");
        $sql_update = "UPDATE slider SET MaSP = '$masp', Video = '$rename_video' WHERE Id = " . $_GET['id'];
    }
    $mysqli->query($sql_update);
    header("Location: ../../index.php?action=quanlybangquangcao&query=danhsach");
} elseif (isset($_GET['id'])) {
    //xóa
    $sql = "SELECT * FROM slider WHERE Id = " . $_GET['id'];
    while ($row = mysqli_fetch_array($mysqli->query($sql))) {
        unlink("./img/$row[HinhAnh]");
        unlink("./img/$row[Video]");
        mysqli_query($mysqli, "DELETE FROM slider WHERE Id = " . $_GET['id']);// thực hiện lệnh xóa 
    }
    header("Location: ../../index.php?action=quanlybangquangcao&query=danhsach");
}

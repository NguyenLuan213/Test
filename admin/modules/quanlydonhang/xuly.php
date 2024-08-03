<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$strTime = strftime("%H-%M-%S_%d-%B-%Y", time());

require_once('../../config/config.php');
echo $_GET['tt'];
if (isset($_GET['code']) && isset($_GET['tt'])) {
    $code = $_GET['code'];
    $trangthai = $_GET['tt'];
    if ($trangthai == 1) {
        $trangthai = 0;
    } else {
        $trangthai = 1;
    }
    mysqli_query($mysqli, "UPDATE hoadon SET TrangThai = $trangthai WHERE CodeDH = '" . $code . "'");
    header("location: ../../index.php?action=quanlydonhang&query=danhsach");
}
?>

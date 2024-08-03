<?php
require_once('../../config/config.php');
$menuname = $_POST['menuName'];
$menulink = $_POST['menuLink'];
$menuorder = $_POST['menuOrder'];

if (isset($_POST['addMenu'])) {
    $sql_sua = "UPDATE menu SET ThuTu = ThuTu + 1 WHERE ThuTu >= " . $menuorder;
    $mysqli->query($sql_sua);
    $sql_them = "INSERT INTO menu (TenMenu, ThuTu, Link, MaQuyen) VALUES ('$menuname', " . ($menuorder) . ", '$menulink', 1)";
    $mysqli->query($sql_them);
    header("Location: ../../index.php?action=quanlymenu&query=danhsach");
} elseif (isset($_POST['editMenu'])) {
    $sql_sua = "UPDATE menu SET ThuTu = ThuTu + 1 WHERE ThuTu >= " . $menuorder + 1;
    $mysqli->query($sql_sua);
    $sql_update = "UPDATE  menu set TenMenu = '$menuname' , ThuTu = $menuorder + 1, Link = '$menulink' WHERE MaMenu = " . $_GET['idmenu'];
    $mysqli->query($sql_update);
    header("Location: ../../index.php?action=quanlymenu&query=danhsach");
} elseif (isset($_GET['idmenu'])) {
    $sql_xoa = "DELETE FROM menu WHERE MaMenu = " . $_GET['idmenu'];
    $mysqli->query($sql_xoa);
    header("Location: ../../index.php?action=quanlymenu&query=danhsach");
}

<?php
session_start();
require '../admin/config/config.php';

if (!isset($_SESSION['MaND'])) {
    header("Location: ./login-form.php");
    exit();
}

// Kiểm tra xem giỏ hàng đã được tạo chưa
if (!isset($_SESSION['giohang'])) {
    $_SESSION['giohang'] = array();
}
//cong
if (isset($_GET['cong'])) {
    $id = $_GET['cong'];
    foreach ($_SESSION['giohang'] as &$sanpham) {
        if ($sanpham['MaSP'] == $id && $sanpham['soluongsp'] < 10) {
            $sanpham['soluongsp']++;
            break;
        }
    }
    header('Location:cart.php');
    exit();
}

//hủy đơn hàng
if (isset($_GET['huydon']) && $_GET['codedh']) {
    $codedh = $_GET['codedh'];
    $huydon = $_GET['huydon'];

    // if ($huydon == 1) {
    //     $huydon = 0;
    // } else {
    //     $huydon = 1;
    // }
    mysqli_query($mysqli, "UPDATE hoadon SET DaHuy = $huydon WHERE CodeDH = '" . $codedh . "'");
}

//trừ 
if (isset($_GET['tru'])) {
    $id = $_GET['tru'];
    foreach ($_SESSION['giohang'] as &$sanpham) {
        if ($sanpham['MaSP'] == $id) {
            $sanpham['soluongsp']--;
            if ($sanpham['soluongsp'] == 0) {
                header("Location: removefromcart.php?idsp=" . $id);
                exit();
            }
            break;
        }
    }
    header('Location:cart.php');
    exit();
}

if (isset($_GET['idsp'])) {
    $idsp =  $_GET['idsp'];
    $sql = "SELECT * FROM sanpham WHERE MaSP = " . $idsp;
    $result = mysqli_query($mysqli, $sql);

    if ($row = mysqli_fetch_array($result)) {
        // Lấy thông tin sản phẩm
        $tensp = $row["TenSP"];
        $gia = $row["Gia"];
        $giahientai = $row['GiaHienTai'];
        $hinhanh = $row["HinhAnh"];
        $soluongsp = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
        // Thêm sản phẩm vào giỏ hàng
        // $quantity = $_GET['quantity'];
        $sanpham = array(
            'MaSP' => $idsp,
            'TenSP' => $tensp,
            'HinhAnh' => $hinhanh,
            'GiaHienTai' => $giahientai,
            'Gia' => $gia,
            'soluongsp' => $soluongsp
        );
        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        $timthay = false;
        foreach ($_SESSION['giohang'] as &$sp_trong_gio) {
            if ($sp_trong_gio['MaSP'] == $idsp) {
                $sp_trong_gio['soluongsp'] = isset($_GET['quantity']) ? ($_GET['quantity'] + ($sp_trong_gio['soluongsp']++)) : ($sp_trong_gio['soluongsp'] + 1);
                $timthay = true;
            }
        }
        // Nếu sản phẩm chưa có trong giỏ hàng, thì thêm mới
        if (!$timthay) {
            array_push($_SESSION['giohang'], $sanpham);
        }

        $page = $_SERVER['HTTP_REFERER'];
        $sec = "0";
        header("Refresh: $sec; url=$page");
    }
}

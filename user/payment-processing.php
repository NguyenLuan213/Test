<?php
require_once("../admin/config/config.php");
require_once("config_vnpay.php");
ob_start();
session_start();
?>
<?php if (!isset($_SESSION['MaND'])) {
    header("Location: ./login-form.php");
    exit();
} ?>
<?php
$mysqli->query("SELECT DATE_FORMAT(CONVERT_TZ(NgayLap, '+00:00', '+07:00'), '%d/%m/%Y') as formatted_date FROM HoaDon");
date_default_timezone_set('Asia/Ho_Chi_Minh');
$strTime = strftime("%H-%M-%S_%d-%B-%Y", time());

$MaND = $_SESSION['MaND'];
$codedh = 'DH-' . strtoupper(substr(uniqid(), -8));
$Email = $_SESSION['Email'];
$TenNguoiNhan = isset($_POST['TenNguoiNhan']) ? $_POST['TenNguoiNhan'] : '';
$SDT = isset($_POST['SDT']) ? $_POST['SDT'] : '';
$cart_payment = $_POST['payment'];

// $TenND = $_SESSION['TenND'];
// $SDT = $_SESSION['SDT'];
$DiaChiHD = isset($_POST['DiaChiHD']) ? $_POST['DiaChiHD'] : '';
//xử lí thanh toán
if ($cart_payment == 'tienmat') {




    if (isset($_POST['order'])) {
        $soluong = isset($_POST['quantity']) ? $_POST['quantity'] : 1;
        $masp = isset($_GET['idsp']) ? $_GET['idsp'] : $_POST['idsp'];
        $sql_update_hoadon = "INSERT INTO hoadon (CodeDH, NgayLap, MaND, DiaChiHD, TenNguoiNhan, SDT, ThanhToan) VALUES ('$codedh', NOW(), '$MaND', '$DiaChiHD' , '$TenNguoiNhan', '$SDT', '$cart_payment')";
        $mysqli->query($sql_update_hoadon);
        $sql_update_cthoadon = "INSERT INTO chitiethoadon (MaSP,CodeDH,SoLuongMua) VALUES ($masp,'$codedh', $soluong)";
        $mysqli->query($sql_update_cthoadon);
        $sql_update_soluongsp = "UPDATE sanpham SET SoLuong = SoLuong - $soluong WHERE MaSP = '" . $masp . "' ";
        $mysqli->query($sql_update_soluongsp);
        header('Location: confirm.php');
    }
    if (isset($_POST['AllPayOrders'])) {

        $sql_update_hoadon = "INSERT INTO hoadon (CodeDH, NgayLap, MaND, DiaChiHD, TenNguoiNhan, SDT, ThanhToan) VALUES ('$codedh', NOW(), '$MaND','$DiaChiHD', '$TenNguoiNhan', '$SDT', '$cart_payment' )";
        $mysqli->query($sql_update_hoadon);
        foreach ($_SESSION['giohang'] as $key => $value) {
            $idsp = $value['MaSP'];
            $tensp = $value['TenSP'];
            $giahientai = $value['GiaHienTai'];
            $soluongsp = $value['soluongsp'];

            $sql_update_cthoadon = "INSERT INTO chitiethoadon (MaSP,CodeDH,SoLuongMua) VALUES ($idsp,'$codedh', $soluongsp)";
            $mysqli->query($sql_update_cthoadon);
            $sql_update_soluongsp = "UPDATE sanpham SET SoLuong = SoLuong - $soluongsp WHERE MaSP = '" . $idsp . "' ";
            $mysqli->query($sql_update_soluongsp);
        }
        unset($_SESSION["giohang"]);
        header('Location: confirm.php');
    }
} elseif ($cart_payment == 'vnpay') {






    $cart_payment == 'vnpay';
    $vnp_TxnRef = $codedh; //Mã giao dịch thanh toán tham chiếu của merchant
    $vnp_Amount = $_POST['vnp_Amount']; // Số tiền thanh toán
    $vnp_Locale = 'vn'; //Ngôn ngữ chuyển hướng thanh toán
    $vnp_BankCode = 'NCB'; //Mã phương thức thanh toán
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

    $_SESSION['order_info'] = array(
        'codedh' => $codedh,
        'MaND' => $MaND,
        'DiaChiHD' => $DiaChiHD,
        'TenNguoiNhan' => $TenNguoiNhan,
        'SDT' => $SDT,
        'cart_payment' => $cart_payment,
        'soluong' => isset($_POST['quantity']) ? $_POST['quantity'] : 1,
        'masp' => isset($_GET['idsp']) ? $_GET['idsp'] : $_POST['idsp'],
        'AllPayOrders' => isset($_POST['AllPayOrders']) ? $_POST['AllPayOrders'] : null
    );


    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount * 100,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => "Thanh toan hoa don",
        "vnp_OrderType" => "other",
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
        "vnp_ExpireDate" => $expire
    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }

    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    header('Location: ' . $vnp_Url);
    exit();





    // if (isset($_POST['order'])) {

    //     $soluong = isset($_POST['quantity']) ? $_POST['quantity'] : 1;
    //     $masp = isset($_GET['idsp']) ? $_GET['idsp'] : $_POST['idsp'];
    // $sql_update_hoadon = "INSERT INTO hoadon (CodeDH, NgayLap, MaND, DiaChiHD, TenNguoiNhan, SDT, ThanhToan) VALUES ('$codedh', NOW(), '$MaND', '$DiaChiHD' , '$TenNguoiNhan', '$SDT', '$cart_payment')";
    // $mysqli->query($sql_update_hoadon);
    // $sql_update_cthoadon = "INSERT INTO chitiethoadon (MaSP,CodeDH,SoLuongMua) VALUES ($masp,'$codedh', $soluong)";
    // $mysqli->query($sql_update_cthoadon);
    // $sql_update_soluongsp = "UPDATE sanpham SET SoLuong = SoLuong - $soluong WHERE MaSP = '" . $masp . "' ";
    // $mysqli->query($sql_update_soluongsp);
    //     header('Location: confirm.php');
    //     die();
    // }
    // if (isset($_POST['AllPayOrders'])) {
    //     header('Location: ' . $vnp_Url);
    //     $sql_update_hoadon = "INSERT INTO hoadon (CodeDH, NgayLap, MaND, DiaChiHD, TenNguoiNhan, SDT, ThanhToan) VALUES ('$codedh', NOW(), '$MaND','$DiaChiHD', '$TenNguoiNhan', '$SDT', '$cart_payment' )";
    //     $mysqli->query($sql_update_hoadon);
    //     foreach ($_SESSION['giohang'] as $key => $value) {
    //         $idsp = $value['MaSP'];
    //         $tensp = $value['TenSP'];
    //         $giahientai = $value['GiaHienTai'];
    //         $soluongsp = $value['soluongsp'];

    //         $sql_update_cthoadon = "INSERT INTO chitiethoadon (MaSP,CodeDH,SoLuongMua) VALUES ($idsp,'$codedh', $soluongsp)";
    //         $mysqli->query($sql_update_cthoadon);
    //         $sql_update_soluongsp = "UPDATE sanpham SET SoLuong = SoLuong - $soluongsp WHERE MaSP = '" . $idsp . "' ";
    //         $mysqli->query($sql_update_soluongsp);
    //     }
    //     unset($_SESSION["giohang"]);
    //     header('Location: confirm.php');
    //     die();
    // }
} elseif ($cart_payment == 'momo') {
    echo 'thanh toán bằng momo';
}

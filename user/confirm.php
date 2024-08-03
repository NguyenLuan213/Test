<?php
require_once("../admin/config/config.php");
ob_start();
session_start(); ?>
<?php if (!isset($_SESSION['MaND'])) {
    header("Location: ./login-form.php");
    exit();
} ?>

<?php

//xử lí thanh toán
$vnp_ResponseCode = isset($_GET['vnp_ResponseCode']) ? $_GET['vnp_ResponseCode'] : '';
if ($_GET['vnp_ResponseCode'] == '00') {
    // Thanh toán thành công
    $order_info = $_SESSION['order_info'];
    $codedh = $order_info['codedh'];
    $MaND = $order_info['MaND'];
    $DiaChiHD = $order_info['DiaChiHD'];
    $TenNguoiNhan = $order_info['TenNguoiNhan'];
    $SDT = $order_info['SDT'];
    $cart_payment = $order_info['cart_payment'];

    // Cập nhật dữ liệu vào hóa đơn
    $sql_update_hoadon = "INSERT INTO hoadon (CodeDH, NgayLap, MaND, DiaChiHD, TenNguoiNhan, SDT, ThanhToan) VALUES ('$codedh', NOW(), '$MaND', '$DiaChiHD', '$TenNguoiNhan', '$SDT', 'vnpay')";
    $mysqli->query($sql_update_hoadon);

    if (isset($order_info['AllPayOrders'])) {
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
    } else {
        $soluong = $order_info['soluong'];
        $masp = $order_info['masp'];
        $sql_update_cthoadon = "INSERT INTO chitiethoadon (MaSP,CodeDH,SoLuongMua) VALUES ($masp,'$codedh', $soluong)";
        $mysqli->query($sql_update_cthoadon);
        $sql_update_soluongsp = "UPDATE sanpham SET SoLuong = SoLuong - $soluong WHERE MaSP = '" . $masp . "' ";
        $mysqli->query($sql_update_soluongsp);
    }
    unset($_SESSION['order_info']);
    $mesg = 'ĐƠN HÀNG CỦA BẠN ĐÃ ĐƯỢC ĐẶT THÀNH CÔNG. SẢN PHẨM SẼ ĐƯỢC GIAO ĐẾN BẠN TRONG THỜI GIAN NHANH NHẤT!
                    <br> MONG BẠN LUÔN ỦNG HỘ CỬA HÀNG CHÚNG TÔI.';



    //cập nhật dữ liệu vào bảng vnpay
    $vnp_TxnRef = isset($_GET['vnp_TxnRef']) ? $_GET['vnp_TxnRef'] : '';
    $vnp_TransactionNo = isset($_GET['vnp_TransactionNo']) ? $_GET['vnp_TransactionNo'] : '';
    $vnp_CardType = isset($_GET['vnp_CardType']) ? $_GET['vnp_CardType'] : '';
    $vnp_BankTranNo = isset($_GET['vnp_BankTranNo']) ? $_GET['vnp_BankTranNo'] : '';
    $vnp_OrderInfo = isset($_GET['vnp_OrderInfo']) ? $_GET['vnp_OrderInfo'] : '';
    $vnp_Amount = isset($_GET['vnp_Amount']) ? $_GET['vnp_Amount'] : '';
    $vnp_BankCode = isset($_GET['vnp_BankCode']) ? $_GET['vnp_BankCode'] : '';
    $vnp_ResponseCode = isset($_GET['vnp_ResponseCode']) ? $_GET['vnp_ResponseCode'] : '';
    $vnp_PayDate = isset($_GET['vnp_PayDate']) ? $_GET['vnp_PayDate'] : '';
    $vnp_TmnCode = isset($_GET['vnp_TmnCode']) ? $_GET['vnp_TmnCode'] : '';

    $sql_update_vnp = "INSERT INTO vnpay (id_vnp, vnp_amount, vnp_bankcode, vnp_banktranno, vnp_cardtype, vnp_orderinfo, vnp_paydate, vnp_tmncode, vnp_transactionno) 
    VALUES ('$vnp_TxnRef', '$vnp_Amount', '$vnp_BankCode', '$vnp_BankTranNo', '$vnp_CardType', '$vnp_OrderInfo', '$vnp_PayDate', '$vnp_TmnCode', '$vnp_TransactionNo')";
    $mysqli->query($sql_update_vnp);
} else {
    $mesg = 'THANH TOÁN TẤT BẠI.';
}
?>
<?php include 'header.php' ?>

<body>
    <?php include 'navbar.php' ?>

    <div class=" mtb-140">
        <div class="row">
            <h3 class="text-center text-primary d-flex">
                <b> <?php echo $mesg; ?>
                </b>
            </h3>
        </div>
        <div class="contrainer">
            <p class="text-center mt-3">
                <i class="fa fa-angle-left"></i>
                <?php echo '<a href="../index.php" class="text-primary"><b>  Tiếp tục mua sắp</b></a>'; ?>
            </p>
        </div>
    </div>
    <?php include 'footer.php' ?>

</body>

</html>
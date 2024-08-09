<?php
require_once("../admin/config/config.php");
include "sendmail.php";
ob_start();
session_start(); ?>
<?php if (!isset($_SESSION['MaND'])) {
    header("Location: ./login-form.php");
    exit();
} ?>

<?php

//xử lí thanh toán
$vnp_ResponseCode = isset($_GET['vnp_ResponseCode']) ? $_GET['vnp_ResponseCode'] : '';
$resultCode = isset($_GET['resultCode']) ? $_GET['resultCode'] : '';
$cash_status = isset($_GET['cash_status']) ? $_GET['cash_status'] : '';

if ($vnp_ResponseCode == '00' || $resultCode == '0' || $cash_status == '0') {
    // Thanh toán thành công
    $order_info = $_SESSION['order_info'];
    $codedh = $order_info['codedh'];
    $MaND = $order_info['MaND'];
    $DiaChiHD = $order_info['DiaChiHD'];
    $TenNguoiNhan = $order_info['TenNguoiNhan'];
    $SDT = $order_info['SDT'];
    $cart_payment = $order_info['cart_payment'];

    // Cập nhật dữ liệu vào hóa đơn
    $sql_update_hoadon = "INSERT INTO hoadon (CodeDH, NgayLap, MaND, DiaChiHD, TenNguoiNhan, SDT, ThanhToan) VALUES ('$codedh', NOW(), '$MaND', '$DiaChiHD', '$TenNguoiNhan', '$SDT', '$cart_payment')";
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


    if ($vnp_ResponseCode == '00') {

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
    }


    if ($resultCode == '0') {

        $orderId = isset($_GET['orderId']) ? $_GET['orderId'] : '';
        $partnerCode = isset($_GET['partnerCode']) ? $_GET['partnerCode'] : '';
        $orderInfo = isset($_GET['orderInfo']) ? $_GET['orderInfo'] : '';
        $amount = isset($_GET['amount']) ? $_GET['amount'] : '';
        $orderType = isset($_GET['orderType']) ? $_GET['orderType'] : '';
        $transId = isset($_GET['transId']) ? $_GET['transId'] : '';
        $responseTime = isset($_GET['responseTime']) ? $_GET['responseTime'] : '';

        $sql_update_momo = "INSERT INTO momo (id_momo, partner_code, order_info, amount, order_type, trans_id, response_time) 
        VALUES ('$orderId', '$partnerCode', '$orderInfo', '$amount', '$orderType', '$transId', '$responseTime')";
        $mysqli->query($sql_update_momo);
    }

    // Gửi email thông báo đơn hàng
    $sql_items = "SELECT * FROM chitiethoadon,sanpham WHERE chitiethoadon.MaSP = sanpham.MaSP AND chitiethoadon.CodeDH = '$codedh'  ORDER BY sanpham.MaSP DESC";
    $result_items = $mysqli->query($sql_items);
    if (!$result_items) {
        die("Lỗi truy vấn: " . $mysqli->error);
    }

    // Chuẩn bị nội dung cho các món hàng
    $items_content = '';
    $total_amount = 0; // Tổng tiền của tất cả món hàng

    $items_content .= '<table width="630" align="center" cellpadding="0" cellspacing="0" border="1" style="table-layout:fixed;">';
    $items_content .= '<thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Giá tiền</th>
            <th>Số lượng</th>
            <th>Tổng tiền</th>
        </tr>
    </thead>';
    while ($row_item = mysqli_fetch_assoc($result_items)) {
        $ten_san_pham = $row_item['TenSP'];
        $gia_tien = number_format($row_item['GiaHienTai'], 0, '', '.'); // Định dạng tiền tệ
        $so_luong = $row_item['SoLuongMua'];
        $tong_tien = number_format($row_item['GiaHienTai'] * $so_luong, 0, '', '.');

        $items_content .= '<tr>';
        $items_content .= "<td> $ten_san_pham</td>";
        $items_content .= "<td> $gia_tien ₫</td>";
        $items_content .= "<td> $so_luong</td>";
        $items_content .= "<td> $tong_tien ₫</td>";
        $items_content .= '</tr>';

        $total_amount += $row_item['GiaHienTai'] * $so_luong;
    }

    $items_content .= '</tbody>';
    $items_content .= '</table>';

    // Định dạng tổng tiền
    $total_amount_formatted = number_format($total_amount, 0, '', '.');

    // Nội dung email
    $tieude = "Đơn hàng đã đặt thành công";
    $to = $_SESSION['Email'];
    $body = "
    Chào bạn, đơn hàng của bạn đã được đặt thành công.<br/>
    Mã đơn hàng: $codedh <br/>  
    THÔNG TIN ĐƠN HÀNG: <br/>
    - Tên người nhận: $TenNguoiNhan <br/>
    - SĐT: $SDT <br/>
    - Địa chỉ giao hàng: $DiaChiHD <br/>
    - Thành tiền: $total_amount_formatted ₫ <br/>
    - Ngày đặt hàng: " . date('d/m/Y H:i:s') . "<br/><br/>
    THÔNG TIN CÁC MÓN HÀNG:<br/><br/>
    $items_content <br/>
    Cảm ơn bạn đã mua hàng tại website của chúng tôi.";
    $mail = new Mailer();
    $mail->send_mail($tieude, $to, $body);
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
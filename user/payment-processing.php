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

    header('Location: confirm.php?cash_status=0', true, 302);
    exit();
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
} elseif ($cart_payment == 'momo_qr') {
    header('Content-type: text/html; charset=utf-8');

    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

    $vnp_Amount = $_POST['vnp_Amount'];
    $partnerCode = 'MOMOBKUN20180529';
    $accessKey = 'klm05TvNBzhg7h7j';
    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

    $orderInfo = "Thanh toán qua mã QR MoMo";
    $amount =  trim($vnp_Amount); // Remove the dollar sign
    $orderId = $codedh;
    $redirectUrl = "http://localhost/user/confirm.php";
    $ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
    $extraData = "";

    $requestId = time() . "";
    $requestType = "captureWallet";
    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl
        . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl="
        . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;

    $signature = hash_hmac("sha256", $rawHash, $secretKey);

    // Debug output
    echo "Raw Hash: " . $rawHash . "<br>";
    echo "Signature: " . $rawHash . "<br>";

    $data = array(
        'partnerCode' => $partnerCode,
        'partnerName' => "Test",
        "storeId" => "MomoTestStore",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature
    );

    $result = execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true);  // decode json

    if (isset($jsonResult['payUrl'])) {
        header('Location: ' . $jsonResult['payUrl']);
    } else {
        $_SESSION['message'] = 'Số tiền thanh toán vượt mức cho phép (50,000,000).';
        header('Location: processImmediateBuy.php');

        // echo "Error: ";
        // print_r($jsonResult);
    }
} elseif ($cart_payment == 'momo_atm') {
    header('Content-type: text/html; charset=utf-8');


    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }


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

    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

    $vnp_Amount = $_POST['vnp_Amount'];
    $partnerCode = 'MOMOBKUN20180529';
    $accessKey = 'klm05TvNBzhg7h7j';
    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

    $orderInfo = "Thanh toán qua ATM MoMo";
    $amount =  trim($vnp_Amount); // Remove the dollar sign
    $orderId = $codedh;
    $redirectUrl = "http://localhost/user/confirm.php";
    $ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
    $extraData = "";

    $requestId = time() . "";
    $requestType = "payWithATM";
    // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
    //before sign HMAC SHA256 signature
    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
    $signature = hash_hmac("sha256", $rawHash, $secretKey);
    $data = array(
        'partnerCode' => $partnerCode,
        'partnerName' => "Test",
        "storeId" => "MomoTestStore",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature
    );
    $result = execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true);  // decode json

    //Just a example, please check more in there

    if (isset($jsonResult['payUrl'])) {
        header('Location: ' . $jsonResult['payUrl']);
    } else {
        $_SESSION['message'] = 'Số tiền thanh toán vượt mức cho phép (50,000,000).';
        header('Location: processImmediateBuy.php');
    }
}

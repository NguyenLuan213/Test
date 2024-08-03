<h1>Xóa sp</h1>
<style>
    body {
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }
</style>
<script>
    window.onload = function() {
        document.body.style.opacity = '1';
    }
</script>
<?php

session_start();
if (isset($_GET['xoatatca']) &&$_GET['xoatatca'] == 1) {
    unset($_SESSION['giohang']);
    header("Location: user/cart.php");
}
if (isset($_GET['idsp'])) {
    $idsp = $_GET['idsp'];

    // Kiểm tra xem giỏ hàng đã được tạo chưa, nếu chưa, thì tạo giỏ hàng
    if (!isset($_SESSION['giohang'])) {
        $_SESSION['giohang'] = array();
    }

    if (isset($_SESSION['giohang']) && !empty($_SESSION['giohang'])) {
        foreach ($_SESSION['giohang'] as $key => $sanpham) {
            if ($sanpham['MaSP'] == $idsp) {
                unset($_SESSION['giohang'][$key]); // Xóa sản phẩm khỏi giỏ hàng
            }
        }
    }
}
header('Location: cart.php');

?>
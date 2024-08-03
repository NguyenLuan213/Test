<?php
//$mysqli = new mysqli("127.0.0.1:3307", "root", "", "dacs2");

$mysqli = new mysqli("localhost", "root", "", "dacs2");

if ($mysqli->connect_error) {
    echo "Lỗi kết nối" . $mysqli->connect_error;
    exit();
}
?>
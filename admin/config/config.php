<?php
//$mysqli = new mysqli("127.0.0.1:3307", "root", "", "web_mobile");

$mysqli = new mysqli("localhost", "root", "", "web_mobile");

if ($mysqli->connect_error) {
    echo "Lỗi kết nối" . $mysqli->connect_error;
    exit();
}

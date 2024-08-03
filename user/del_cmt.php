<?php
require("../admin/config/config.php");

$sql = "DELETE FROM danhgia WHERE MaDG =" . $_GET['madg'];
$mysqli -> query($sql);
header("Location: product-single.php?idsp=" . $_GET['idsp']);
?>
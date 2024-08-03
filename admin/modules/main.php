<?php
if (isset($_GET['action']) && isset($_GET['query'])) {
    $action = $_GET['action'];
    $query = $_GET['query'];
} else {
    $action = '';
    $query = '';
}
if ($action == 'hoso'&& $query == 'xem') {
    include("modules/hoso/sua.php");
} elseif ($action == 'quanlymenu' && $query == 'danhsach') {
    include("modules/quanlymenu/danhsach.php");
} elseif ($action == 'quanlymenu' && $query == 'them') {
    include("modules/quanlymenu/them.php");
} elseif ($action == 'quanlymenu' && $query == 'sua') {
    include("modules/quanlymenu/sua.php");
} elseif ($action == 'quanlybangquangcao' && $query == 'danhsach') {
    include("modules/quanlybangquangcao/danhsach.php");
} elseif ($action == 'quanlybangquangcao' && $query == 'them') {
    include("modules/quanlybangquangcao/them.php");
} elseif ($action == 'quanlybangquangcao' && $query == 'sua') {
    include("modules/quanlybangquangcao/sua.php");
} elseif ($action == 'quanlythuonghieu' && $query == 'danhsach') {
    include("modules/quanlythuonghieu/danhsach.php");
} elseif ($action == 'quanlythuonghieu' && $query == 'them') {
    include("modules/quanlythuonghieu/them.php");
} elseif ($action == 'quanlythuonghieu' && $query == 'sua') {
    include("modules/quanlythuonghieu/sua.php");
} elseif ($action == 'quanlysanpham' && $query == 'danhsach') {
    include("modules/quanlysanpham/danhsach.php");
} elseif ($action == 'quanlysanpham' && $query == 'them') {
    include("modules/quanlysanpham/them.php");
} elseif ($action == 'quanlysanpham' && $query == 'sua') {
    include("modules/quanlysanpham/sua.php");
} elseif ($action == 'quanlytaikhoan' && $query == 'danhsach') {
    include("modules/quanlytaikhoan/danhsach.php");
} elseif ($action == 'quanlytaikhoan' && $query == 'sua') {
    include("modules/quanlytaikhoan/sua.php");
}elseif ($action == 'quanlytaikhoan' && $query == 'xemdonhang') {
    include("modules/quanlytaikhoan/xemdonhang.php");
} elseif ($action == 'quanlydonhang' && $query == 'danhsach') {
    include("modules/quanlydonhang/danhsach.php");
} elseif ($action == 'donhang' && $query == 'xemdonhang') {
    include("modules/quanlydonhang/xemdonhang.php");
} else {
    include("modules/dashboard.php");
}

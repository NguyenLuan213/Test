<?php
session_start();
$ketqua = '';
if (isset($_POST['update'])) {
    require_once("../admin/config/config.php");
    $ten = $_POST['txtten'];
    $diachi = $_POST['diachi'];
    $emaill = $_POST['emaill'];
    $sdt = $_POST['sdt'];
    $id = $_SESSION['MaND'];

    if (!empty($_POST['Password'])) {
        $password = ", MatKhau = '" . md5($_POST['Password']) . "'";
    } else {
        $password = '';
    }
    $sql = "UPDATE nguoidung SET TenND='$ten', Email='$emaill', SDT='$sdt',DiaChi='$diachi' " . $password . " WHERE MaND='$id'";
    if ($mysqli->query($sql) === TRUE) {
        $ketqua = "Cập nhật thành công ";
        // header('Location: infor.php');
    } else {
        $ketqua = "Cập nhật thất bại ";
    }
    $mysqli->close();
}
?>
<?php include 'header.php' ?>

<body>
    <!-- top-header-->
    <?php include "navbar.php"
        ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <div class="post-block ">
                                <form method="post" action="#">
                                    <div class="post-content">
                                        <table class="table table-bordered ">
                                            <!-- post block -->
                                            <?php
                                            $sql1 = "SELECT * FROM nguoidung WHERE MaND=" . $_SESSION['MaND'];
                                            $result = mysqli_query($mysqli, $sql1);
                                            $row = mysqli_fetch_assoc($result);

                                            echo '<tr >
                                            <td><label>Tên </label></td>
                                            <td> <input type="text" name="txtten" value="' . $row['TenND'] . '"></td>
                                        </tr>
                                        <tr>
                                            <td><label>Email</label></td>
                                            <td> <input type="email" name="emaill" value="' . $row['Email'] . '"></td>
                                        </tr>
                                        <tr>
                                            <td><label>Số điện thoại </label></td>
                                            <td><input type="phone" name="sdt" value="' . $row['SDT'] . '"></td>
                                        </tr>
                                        <tr>
                                            <td><label>Địa chỉ </label></td>
                                            <td><input type="address" name="diachi" value="' . $row['DiaChi'] . '"></td>
                                        </tr> 
                                        <tr> 
                                            <td><label for="Password" class="form-label">Mật khẩu mới:</label></td>
                                            <td><input type="text" value="" id="Password" name="Password" placeholder="Nhập mật khẩu mới"></td>
                                        </tr>';
                                            ?>


                                        </table>
                                        <div class="text-center">
                                            <button id="update" name="update" class="btn btn-primary btn-sm">Cập nhật
                                                thông tin</button>
                                            <p>
                                                <?php echo $ketqua ?>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class=" widget widget-categories">
                        <div class="widget-head">
                            <?php
                            $sql1 = "SELECT * FROM nguoidung WHERE MaND=" . $_SESSION['MaND'];
                            $result = mysqli_query($mysqli, $sql1);
                            $row = mysqli_fetch_assoc($result);
                            echo '<h2 class="widget-title"><span class="glyphicon glyphicon-user"></span> Chào bạn ' . $row['TenND'] . '</h2>';
                            ?>
                        </div>
                        <div class="widget-body">
                            <ul class="arrow">
                                <li class="active"><a href="infor.php"> Tài khoản của tôi</a></li>
                                <li><a href="order-history.php">Đơn hàng của tôi</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'
        ?>
</body>

</html>
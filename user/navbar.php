<?php
include '../admin/config/config.php';
?>
<!-- top-header-->

<div class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6 hidden-xs">
                <p class="top-text">Giao hàng linh hoạt, giao hàng nhanh.</p>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                <ul>
                    <li>0905-481-608</li>
                    <li>22it@vku.udn.vn</li>
                    <li>Trợ giúp</li>
                </ul>
            </div>
        </div>
        <!-- /.top-header-->
    </div>
</div>
<!-- header-section-->
<div class="header-wrapper">

    <!-- navigation -->

    <!-- header-section-->
    <div class="header-wrapper">
        <div class="container">
            <div class="row">
                <!-- logo -->
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-8">
                    <div class="logo">
                        <a href="index.php"><img src="./images/logo.png" alt=""> </a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <form action="find.php" method="post">
                        <div class="search-bg">
                            <input type="text" name="find" class="form-control" placeholder="Bạn muốn mua gì ?">
                            <button type="Submit" name="find-product"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="account-section">

                        <ul>
                            <?php
                            //require login.php                                
                            if (isset($_SESSION['txtuser'])) {
                                $sql1 = "SELECT * FROM nguoidung WHERE MaND=" . $_SESSION['MaND'];
                                $result = mysqli_query($mysqli, $sql1);
                                $row = mysqli_fetch_assoc($result);
                                $ten_tach = explode(" ", $row["TenND"]);
                                $ten = end($ten_tach);
                                ?>


                                <li class="user-info">
                                    <span class="glyphicon glyphicon-user">
                                        <a href="infor.php">
                                            <?php echo $ten; ?>
                                        </a>
                                    </span>
                                    <span class="logout"><a href="log-out.php">Đăng xuất</a></span>
                                </li>

                                <li class="user-info">
                                    <a href="cart.php" class="title">
                                        <i class="fa fa-shopping-cart">&nbsp;&nbsp;&nbsp;Giỏ Hàng</i>
                                        <sup class="cart-quantity">
                                            <?php
                                            $ok = 1;
                                            if (isset($_SESSION['giohang'])) {
                                                foreach ($_SESSION['giohang'] as $key => $value) {
                                                    if (isset($key)) {
                                                        $ok = 2;
                                                    }
                                                }
                                            }
                                            echo ($ok == 2) ? count($_SESSION['giohang']) : "0";
                                            ?>
                                        </sup>
                                    </a>

                                    <span class="order-history"><a href="order-history.php">Đơn Hàng</a></span>

                                </li>
                                <?php
                                if (isset($_SESSION['MaAdmin'])) {
                                    echo '<li><a id="admin" href="../admin/index.php">Admin</a></li>';
                                } ?>


                                <?php
                            } else {
                                ?>
                                <li><a href="login-form.php" class="title hidden-xs">Đăng Nhập</a></li>
                                <li class="hidden-xs"><a href="signup-form.php">Đăng Ký</a></li>
                                <!-- <li><a href="cart.php" class="title"><i class="fa fa-shopping-cart"></i> </a></li> -->
                                <?php
                            }
                            ?>

                        </ul>

                    </div>
                    <!-- /.account -->
                </div>
                <!-- search -->
            </div>
        </div>
        <!-- navigation -->
        <div class="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- navigations-->
                        <div id="navigation">
                            <ul>
                                <?php
                                $sql = "SELECT * FROM menu ORDER BY ThuTu ASC LIMIT 7";
                                $result = mysqli_query($mysqli, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<li ><a href="' . $row['Link'] . '?mamenu=' . $row["MaMenu"] . '"> ' . $row['TenMenu'] . '</a>';
                                    $subSql = "SELECT * FROM thuonghieu WHERE MaMenu = '" . $row["MaMenu"] . "' ORDER BY ThuTu ASC";
                                    $subResult = mysqli_query($mysqli, $subSql);
                                    if ($subResult->num_rows > 0) {
                                        echo '<ul class="dropdown-menu" aria-labelledby="menu-' . $row["MaMenu"] . '">';
                                        while ($subrow = mysqli_fetch_array($subResult)) {
                                            echo '<li><a href="product.php?mamenu=' . $row["MaMenu"] . '&idth=' . $subrow['MaTH'] . '">' . $subrow['TenTH'] . '</a></li>';
                                        }
                                        echo ' </ul>';
                                    }
                                    echo '</li>';
                                }
                                ?>

                            </ul>
                        </div>
                    </div>
                    <!-- /.navigations-->
                </div>
            </div>
        </div>
    </div>
    <!-- /. header-section-->

    <!-- /.navigations-->
</div>
<!-- ./top-header-->
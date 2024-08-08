<?php session_start();
require("../admin/config/config.php");
?>
<!DOCTYPE html>
<html lang="en">

<?php include 'header.php' ?>

<body>

    <?php include 'navbar.php'; ?>

    <!-- product-single -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box">
                        <?php
                        $sql = "SELECT * FROM sanpham WHERE MaSP =" . $_GET['idsp'];
                        $result = mysqli_query($mysqli, $sql);
                        $row = mysqli_fetch_assoc($result);
                        ?>
                        <!-- product-description -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <ul id="demo1_thumbs" class="slideshow_thumbs">
                                        <li>
                                            <a href="../admin/modules/quanlysanpham/img/<?php echo $row['HinhAnh'] ?>">
                                                <div class=" thumb-img"><img src="../admin/modules/quanlysanpham/img/<?php echo $row['HinhAnh'] ?>" alt=""></div>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                                <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div id="slideshow"></div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="product-single">
                                        <h2>
                                            <?php echo $row['TenSP'] ?>
                                        </h2>

                                        <p class="product-price">
                                            <?php echo number_format($row['GiaHienTai'], 0, '', '.') ?>
                                            <u>đ</u>
                                            <strike>
                                                <?php echo number_format($row['Gia'], 0, '', '.') ?>
                                                <u>đ</u>
                                            </strike>
                                        </p>
                                        <p>
                                            <?php
                                            $result = mysqli_query($mysqli, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $mota = explode(',', $row['MoTa']);
                                                    // Lấy ra tối đa 3 chuỗi
                                                    $mota = array_slice($mota, 0, 3);
                                                    echo implode("|", $mota);
                                                }
                                            } else {
                                                return;
                                            }
                                            ?>
                                        </p>
                                        <form id="myForm" method="get">
                                            <div class="product-quantity">
                                                <h5>Số Lượng</h5>
                                                <div class="quantity mb20">
                                                    <input type="number" class="input-text qty text" step="1" min="1" max="6" name="quantity" id="quantity" value="1" title="Qty" size="4" pattern="[0-9]*">
                                                </div>
                                            </div>
                                            <?php $row = mysqli_fetch_assoc(mysqli_query($mysqli, $sql)); ?>
                                            <input type="hidden" name="idsp" value="<?php echo $row['MaSP']; ?>">
                                            <button type="button" class="btn btn-sub" id="buyNow"><i class=""></i> Mua Ngay</button>
                                            <button type="button" class="btn btn-default" id="addToCart"><i class="fa fa-shopping-cart"></i> Giỏ Hàng</button>
                                        </form>

                                        <script>
                                            document.getElementById('buyNow').addEventListener('click', function() {
                                                document.getElementById('myForm').action = 'processImmediateBuy.php';
                                                document.getElementById('myForm').submit();
                                            });

                                            // document.getElementById('addToCart').addEventListener('click', function() {
                                            //     document.getElementById('myForm').action = 'addProductToCart.php';
                                            //     document.getElementById('myForm').submit();
                                            // });
                                        </script>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box-head scroll-nav">
                        <div class="head-title"> <a class="page-scroll active" href="#product">Thông Tin Chi
                                TIết</a>
                            <a class="page-scroll" href="#review">Đánh giá &amp; Nhận xét</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- highlights -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="highlights">
                                <h4 class="product-small-title" id="product">Cấu Hình Chi Tiết</h4>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul class="arrow">
                                            <?php
                                            $result = mysqli_query($mysqli, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $mota = explode(',', $row['MoTa']);

                                                    // Chia mảng $mota thành hai mảng con
                                                    $half = ceil(count($mota) / 2);
                                                    $mota1 = array_slice($mota, 0, $half);
                                                    $mota2 = array_slice($mota, $half);

                                                    // In ra mảng con thứ nhất
                                                    foreach ($mota1 as $item) {
                                                        echo '<li>' . $item . '</li>';
                                                    }
                                                }
                                            } else {
                                                return;
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul class="arrow">
                                            <?php
                                            // In ra mảng con thứ hai
                                            foreach ($mota2 as $item) {
                                                echo '<li>' . $item . '</li>';
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- rating reviews  -->
            <div id="rating">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="box">
                            <div class="box-head">
                                <h3 class="head-title">Bình luận về
                                    <?php
                                    $result = mysqli_query($mysqli, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['TenSP'] ?>
                                </h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <?php
                                    $sql_count = "SELECT COUNT(*) as MaDG FROM danhgia WHERE MaSP = " . $_GET['idsp'];
                                    $sql_avg = "SELECT AVG(Diem) as AVG_Diem FROM danhgia WHERE MaSP = " . $_GET['idsp'];
                                    $result_count = mysqli_query($mysqli, $sql_count);
                                    $result_avg = mysqli_query($mysqli, $sql_avg);
                                    $row_avg = mysqli_fetch_assoc($result_avg);
                                    $row_count = mysqli_fetch_assoc($result_count);

                                    echo '<div class="rating-review">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <h1>' . round($row_avg['AVG_Diem'], 1) . '</h1>';

                                    $rating_avg = round($row_avg['AVG_Diem'], 0);
                                    echo '<div class="product-rating">';
                                    for ($i = 0; $i < $rating_avg; $i++) {
                                        echo '<span><i class="fa fa-star"></i></span> ';
                                    }
                                    for ($i = $rating_avg; $i < 5; $i++) {
                                        echo '<span><i class="fa fa-star-o"></i></span> ';
                                    }
                                    echo '</div><p class="text-secondary">' . $row_count['MaDG'] . ' bình luận</p>
                                            </div>';

                                    echo '
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <h2>' . round($row_avg['AVG_Diem'], 1) * 20 . '%</h2>
                                            <p class="text-secondary">Dựa trên ' . $row_count['MaDG'] . ' bình luận</p>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        </div>
                                    </div>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.rating reviews  -->
                <!-- customers review  -->
                <div class="row" id="top-dsbinhluan">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="box">
                            <div class="box-head">
                                <h3 class="head-title"> Bình Luận</h3>
                            </div>

                            <!-- danh sách bình luận -->
                            <div class="box-body scroll-review">
                                <div class="row">

                                    <div class="customer-reviews" id="dsbinhluan">
                                        <?php
                                        $sql = "SELECT danhgia.*,nguoidung.TenND FROM danhgia JOIN nguoidung ON danhgia.MaND = nguoidung.MaND WHERE MaSP = " . $_GET['idsp'] . " ORDER BY MaDG DESC";
                                        $result = mysqli_query($mysqli, $sql);


                                        if ($result->num_rows > 0) {
                                            while ($row = mysqli_fetch_array($result)) {
                                                if (isset($_SESSION['MaAdmin']) || (isset($_SESSION['MaND']) ? ($_SESSION['MaND'] == $row["MaND"]) : '')) {
                                                    $del = '<a class="text-decoration-none badge bg-warning" href="del_cmt.php?idsp=' . $_GET['idsp'] . '&madg=' . $row['MaDG'] . '">Xóa</a>';
                                                } else {
                                                    $del = '';
                                                }
                                                $rating = $row['Diem']; // Số sao đánh giá
                                                echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <p class="reviews-text">Bởi <span class="text-default">' . $row['TenND'] . '</span> ' . $row['NgayDanhGia'] . ' ' . $del . ' </p> 
                                                <div class="product-rating">';
                                                // Hiển thị số sao đánh giá
                                                for ($i = 0; $i < $rating; $i++) {
                                                    echo '<span><i class="fa fa-star"></i></span> ';
                                                }
                                                for ($i = $rating; $i < 5; $i++) {
                                                    echo '<span><i class="fa fa-star-o"></i></span> ';
                                                }
                                                echo '</div>
                                                
                                                <p>' . $row['NhanXet'] . '.</p>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="divider-line"></div>
                                            </div>';
                                            }
                                        }
                                        ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- customers review  -->
                <!-- reviews-form -->
                <div id="review">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="box">
                                <div class="box-head">
                                    <h3 class="head-title">Thêm Bình Luận</h3>
                                </div>

                                <div class="box-body">
                                    <div class="row">
                                        <div class="review-form">

                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="review-rating">
                                                    <h5>Đánh Giá : &nbsp;</h5>
                                                    <div class="star-rate" id="rateYo"></div>


                                                </div>
                                            </div>
                                            <div>

                                                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label sr-only " for="textarea"></label>
                                                        <textarea class="form-control" id="textarea_content" name="textarea_content" rows="4" placeholder="Nhập bình luận của bạn"></textarea>
                                                    </div>
                                                    <input type="hidden" id="idsp" value="<?php echo $_GET['idsp']; ?>">
                                                    <?php if (isset($_SESSION['MaND'])) {
                                                        echo '<input type="button" id="btnThem" name="singlebutton"
                                                            class="btn btn-primary" value="Thêm đánh giá">';
                                                    } else  echo '<p>Vui lòng <a href="./login-form.php">đăng nhập</a> để thêm đánh giá.</p>'; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.reviews-form -->
            </div>
        </div>
        <!-- /.product-description -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box-head">
                        <h3 class="head-title">Sản phẩm liên quan</h3>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <!-- product -->
                        <?php
                        $sql = "SELECT * FROM sanpham WHERE MaSP != " . $_GET['idsp'] . " LIMIT 4;";
                        $result = mysqli_query($mysqli, $sql);

                        while ($row = mysqli_fetch_array($result)) {
                            echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb30">';
                            echo '<div class="product-block">
                                <div class="product-img"><a href="product-single.php?idsp=' . $row['MaSP'] . '"><img src="../admin/modules/quanlysanpham/img/' . $row['HinhAnh'] . '" alt="' . $row['HinhAnh'] . '"></a></div>
                                <div class="product-content">
                                    <h5><a href="product-single.php?idsp=' . $row['MaSP'] . '" class="product-title">' . $row['TenSP'] . '<strong>(' . $row['BoNho'] . ', ' . $row['Mau'] . ')</strong></a></h5>
                                    <div class="product-meta"><a href="product-single.php?idsp=' . $row['MaSP'] . '" class="product-price">' . number_format($row['GiaHienTai'], 0, '', '.') . ' ₫</a>
                                        <a href="product-single.php?idsp=' . $row['MaSP'] . '" class="discounted-price">' . number_format($row['Gia'], 0, '', '.') . ' ₫</a>
                                        <span class="offer-price">10%off</span>
                                    </div>
                                    <div class="body1">

                                    <a href="processImmediateBuy.php?idsp=' . $row['MaSP'] . ' ">
                                            <button class="button">
                                                Mua ngay
                                            </button></a>
                        
                                            <a class="product" name="addToCarts" data-idsp="' . $row['MaSP'] . '">
    <input type="hidden" class="product_id" value="' . $row['MaSP'] . '">
    <button class="button addToCartBtn">
        Giỏ hàng
        <svg class="cartIcon" viewBox="0 0 576 512">
            <path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 
                    0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 
                    28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 
                    24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 
                    48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
            </path>
        </svg>
    </button>
</a>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        } ?>
                        <!-- /.product -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.product-single -->
    </div>

    <!-- footer -->
    <?php include 'footer.php' ?>
    <!-- /.footer-social links -->
    </div>
    </div>
    </div>


    <script type="text/javascript">
        $('#slideshow').desoSlide({
            thumbs: $('ul.slideshow_thumbs li > a'),
            effect: {
                provider: 'animate',
                name: 'fade'
            }

        });
    </script>

    <!-- <script type="text/javascript">
        $(function() {

            $("#rateYo").rateYo({
                rating: 5,
                starWidth: "16px"
            });

        });
    </script> -->
    <script>
        $(function() {
            $("#rateYo").rateYo({
                rating: 5,
                starWidth: "25px"
            });

            $("#btnThem").click(function() {

                var rating = $("#rateYo").rateYo(
                    "rating"
                ); //rateYo("rating") gọi phương thức “rating” của plugin RateYo, trả về giá trị đánh giá hiện tại
                $.ajax({
                    url: 'add-reviews.php',
                    type: 'post',
                    data: {
                        idsp: $('#idsp').val(),
                        textarea_content: $('#textarea_content').val(),
                        rating: rating
                    },
                    success: function(data) {
                        // $('#dsbinhluan').append('<div>' + $('#textarea_content').val() + '</div>');

                        $('#dsbinhluan').prepend(data);
                        $('#textarea_content').val('');
                        $('html, body').scrollTop($('#top-dsbinhluan').offset().top);
                        console.log('Đánh giá đã được lưu thành công');
                    },
                    error: function() {
                        alert('Có lỗi xảy ra, vui lòng thử lại');
                    }
                });
            });
        });
    </script>


    <script>
        //ajax
        $("#addToCart").click(function() {
            $.ajax({
                url: 'addProductToCart.php',
                type: 'get',
                data: {
                    idsp: $('#idsp').val(),
                    quantity: $('#quantity').val(),
                },
                success: function(data) {
                    $('#successMessage').show();

                    // Ẩn thông báo sau 2 giây
                    setTimeout(function() {
                        $('#successMessage').hide();
                    }, 2000);
                    console.log('Thêm giỏ thành công');
                },
                error: function() {
                    alert('Error');
                }
            });
        });
    </script>



    <script>
        // Lấy thẻ input bằng id
        var input = document.getElementById("quantity");

        // Lấy giá trị từ thẻ input
        var quantity = input.value;

        // In ra giá trị
        console.log(quantity);
    </script>
    <!-- <script type="text/javascript">
        $(function() {
            $("#rateYo").rateYo({
                rating: 5,
                starWidth: "16px",
                onSet: function(rating, rateYoInstance) {
                    $.ajax({
                        url: 'add-reviews.php',
                        type: 'POST',
                        data: {
                            rating: rating
                        },
                        success: function(data) {
                            alert('Đánh giá đã được lưu thành công');
                        },
                        error: function() {
                            alert('Có lỗi xảy ra, vui lòng thử lại');
                        }
                    });
                }
            });
        });
    </script> -->


</body>

</html>
<?php
session_start();
if (!isset($_SESSION['MaAdmin'])) {
    if (!isset($_SESSION['dangnhap'])) {
        header('Location: sign-in.php');
    }
}
?>
<?php include('config/config.php'); ?>
<?php include('modules/header.php'); ?>
<body>
    <div class="wrapper">
        <?php include('modules/sidebar.php'); ?>
        <div class="main">
            <?php include('modules/navbar.php'); ?>
            <?php include('modules/main.php'); ?>
            <?php include('modules/footer.php'); ?>
        </div>
    </div>
</body>

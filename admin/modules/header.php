<?php
if (isset($_GET['act']) == "dangxuat") {
  session_destroy();
  header('Location:sign-in.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Add other head content here -->
  <!-- <base href="http://localhost"> -->
  <link rel="shortcut icon" href="./img/icons/icon-48x48.png" />
  <title>Admin MobiStore</title>
  <link rel="stylesheet" href="./css/style.css">
  <link href="./css/app.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<?php
include 'db/config.php';
session_start();
if (isset($_POST['login'])) {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    $sql = mysqli_query($conn, "SELECT `id`, `user_name`, `full_name`, `password`, `role`, `status` FROM `uesrs` 
WHERE user_name='$user_name' and password='$password'");
    $result = mysqli_fetch_array($sql);
//    $id = $result['id'];

    if ($result == null) {
        $_SESSION['error'] = "User Name or Passwrod is mismatch!!! Please try again.";
    } else {
        $_SESSION['user_name'] = $result['user_name'];
        $_SESSION['full_name'] = $result['full_name'];
        $_SESSION['role'] = $result['role'];
        $_SESSION['id'] = $result['id'];
        header("Location: home.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>TheBidSpot</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
<nav>
    <img src="image/logo.png" alt="Logo">
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Auctions</a></li>
        <li><a href="#">Sell</a></li>
        <li><a href="login.php">Log In/Sign Up</a></li>
    </ul>
</nav>
<section>

    <div class="container" >

        <div class="row">
            <img src="image/TheBitSpot-removebg-preview.webp" style="margin-top: 10%; margin-left: 35%; background-color: #e9eaed; "/>
        </div>
    </div>
</section>
</body>
</html>
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
        <li><a href="index.php">Home</a></li>
        <li><a href="#">Auctions</a></li>
        <li><a href="#">Sell</a></li>
        <li><a href="login.php">Log In/Sign Up</a></li>
    </ul>
</nav>
<section>
    <form class="card-body cardbody-color p-lg-5" name="form1" method="post" action="" enctype="multipart/form-data">
        <div class="container">

            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card bg-light mt-5">
                        <?php if (isset($_SESSION['register'])) { ?>
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Registration Complete Successfully. Using user name and password, you can login
                                    now
                                    !!!</strong>
                            </div>
                            <?php
                        }
                        unset($_SESSION['register']);

                        if (isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>User Name or Password is mismatch. Please try again!!!</strong>
                            </div>
                            <?php
                        }
                        unset($_SESSION['error']);
                        ?>
                        <div class="card-header card-text">
                            <h3 class="card-text">User login</h3>
                            <p class="card-text">Please enter your user name and password</p>
                        </div>

                        <div class="card-body" style="font-size: 14px;">
                            <div class="form-group">
                                <label for="name">User Name<sub> * </sub></label>
                                <input type="text" name="user_name"
                                       class="form-control form-control-lg"
                                       value="">
                            </div>

                            <div class="form-group">
                                <label for="Password">Password<sub> * </sub></label>
                                <input type="password" name="password"
                                       class="form-control form-control-lg"
                                       value="">
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">

                                        <button type="submit" class="btn btn-info" name="login"
                                                style="background-color:#0d6efd; width: 100%; display: block">Login
                                        </button>
                                    </div>
                                    <div class="col">
                                        <a href="register.php"
                                           class="btn btn-warning btn-block pull-right">No account? Register </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
</body>
</html>
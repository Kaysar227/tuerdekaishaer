<?php
if(!isset($_SESSION))
{
    session_start();
}
//database connection
include_once 'db/config.php';

if (isset($_POST['submit'])) {
    var_dump($_POST);
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];
    if ($password == $confirm_password){
        $sql = "INSERT INTO `uesrs`(`user_name`, `full_name`, `password`, `role`, `status`) VALUES ('$user_name', '$full_name','$password','$role','Y')";
        $isSuccess = mysqli_query($conn, $sql);
        if ($isSuccess) {
            $_SESSION['message'] = 1;
        } else {
            $_SESSION['error'] = 2;
        }
    }else{
        $_SESSION['pass'] = 3;
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
            <?php if (isset($_SESSION['message']) == '1') { ?>
                <div class="alert alert-success" id="s_message">
                    <strong>Success!</strong> You have registered successfully!!!.
                </div>
                <?php
                unset($_SESSION['message']);
            }
            if (isset($_SESSION['error']) == '2') { ?>

                <div class="alert alert-danger" id="e_message">
                    <strong>Error!</strong> Something Went Wrong. Please try again!!!.
                </div>
                <?php  unset($_SESSION['error']);
            }

            if (isset($_SESSION['pass']) == '3') { ?>

                <div class="alert alert-danger" id="e_message">
                    <strong>Error!</strong> Password Mismatch. Please try again!!!.
                </div>
                <?php  unset($_SESSION['pass']);
            }
            ?>

            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card bg-light mt-5">
                        <div class="card-header card-text">
                            <h2 class="card-text">Create Account</h2>
                            <p class="card-text">Please Fill out This form to register with us</p>
                        </div>

                        <div class="card-body" style="font-size: 14px;">
                            <div class="form-group">
                                <label for="name">Full Name<sub> * </sub></label>
                                <input type="text" name="full_name"
                                       class="form-control form-control-lg"
                                       value="">
                            </div>

                            <div class="form-group">
                                <label for="user_name">User Name<sub> * </sub></label>
                                <input type="text" name="user_name"
                                       class="form-control form-control-lg"
                                       value="">
                            </div>

                            <div class="form-group">
                                <label for="password">Password<sub>*</sub></label>
                                <input type="password" name="password"
                                       class="form-control form-control-lg"
                                       value="">
                            </div>

                            <div class="form-group">
                                <label for="confirm_password">Confirm Password<sub>*</sub></label>
                                <input type="password" name="confirm_password"
                                       class="form-control form-control-lg"
                                       value="">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">User Role<sub>*</sub></label>
                                <select class="form-control" name="role" id="role" style="height: 45px;">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>

                                </select>
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <input type="submit" class="btn btn-success btn-block pull-left" name="submit"
                                               value="Register" style="font-size: 14px;">
                                    </div>
                                    <div class="col">
                                        <a href="login.php" style="font-size: 14px;"
                                           class="btn btn-warning btn-block pull-right">Already have account? Login </a>
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
<?php
include_once 'common/header.php';
include_once 'db/config.php';


if (isset($_POST['submit'])) {

    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    //$image = $_POST['image'];


    $milliseconds = round(microtime(true) * 1000);
    if (isset($_FILES["image"]["tmp_name"])){
        $orig_file = $_FILES["image"]["tmp_name"];
        $ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $target_dir = 'uploads/';
        $destination = $target_dir.$milliseconds.".".$ext;
        move_uploaded_file($orig_file,$destination);
    }else{
        $destination="";
    }

    $sql = "INSERT INTO `item`(`name`, `description`, `price`, `type`, `image`) VALUES 
('$item_name','$description','$price','$type','$destination')";
    $isSuccess = mysqli_query($conn, $sql);
    if ($isSuccess) {
        $_SESSION['message'] = 1;
    } else {
        $_SESSION['error'] = 2;
    }
}
$sql = mysqli_query($conn, "SELECT `id`, `name`, `description`, `price`, `type`, `image` FROM `item` WHERE 1");
?>

<section>
    <form class="card-body cardbody-color p-lg-5" name="form1" method="post" action="" enctype="multipart/form-data">
        <div class="container">
            <?php if (isset($_SESSION['message']) == '1') { ?>
                <div class="alert alert-success" id="s_message">
                    <strong>Success!</strong> Item create successfully!!!.
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

            ?>

            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card bg-light mt-5">
                        <div class="card-header card-text">
                            <h2 class="card-text">Create Item</h2>
                            <p class="card-text">Please Fill out This form to create item</p>
                        </div>

                        <div class="card-body" style="font-size: 14px;">
                            <div class="form-group">
                                <label for="name">Item Name<sub> * </sub></label>
                                <input type="text" name="item_name"
                                       class="form-control form-control-lg"
                                       value="">
                            </div>

                            <div class="form-group">
                                <label for="user_name">Description<sub> * </sub></label>
                                <input type="text" name="description"
                                       class="form-control form-control-lg"
                                       value="">
                            </div>

                            <div class="form-group">
                                <label for="password">Price<sub>*</sub></label>
                                <input type="number" name="price"
                                       class="form-control form-control-lg"
                                       value="">
                            </div>


                            <div class="form-group">
                                <label for="confirm_password">Type<sub>*</sub></label>
                                <select class="form-control" name="type" id="type" style="height: 45px;">
                                    <option value="Good">Good</option>
                                    <option value="Scrap">Scrap</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Image<sub>*</sub></label>
                                <input type="file" accept="image/*" class="form-control form-control-lg" id="image" name="image" />
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-success btn-block pull-left" name="submit"
                                                style="font-size: 14px;">Save <i class="fa fa-check-circle"></i> </button>
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
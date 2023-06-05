<?php
session_start();
include_once 'common/header.php';
include_once 'db/config.php';


if (isset($_POST['delete_class'])) {
    $id = $_POST['delete_class'];
    $isSuccess = mysqli_query($conn, "delete FROM `td_student` WHERE id='$id'");

    if ($isSuccess) {
        $_SESSION['delete'] = 1;
    } else {
        $_SESSION['delete'] = 2;
    }
}
$sql = mysqli_query($conn, "SELECT `id`, `name`, `description`, `price`, `type`, `image` FROM `item` WHERE 1");
?>


<section>
    <form class="card-body cardbody-color p-lg-5" name="form1" method="post" action="" enctype="multipart/form-data">
        <div class="container">
            <?php if($_SESSION['role'] == 'admin') { ?>
                <a href="add_item.php" class="btn btn-success left_align">Add New <i class="fa fa-plus-circle"></i>
                </a>
            <?php } ?>
            <hr/>
            <div class="row">
                <?php while ($rows = mysqli_fetch_array($sql)) { ?>
                    <div class="col-md-4" style="margin-bottom: 10px;">
                        <table border="1px solid black">
                            <tr>
                                <td><img src="<?php echo $rows['image']; ?>" width="100%" height="200px;"></td>

                            </tr>
                            <tr>
                                <td style="text-align: center"><strong><?php echo $rows['name']; ?></strong></td>
                            </tr>
                            <tr>
                                <td style="text-align: center"><?php echo $rows['price']; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center"><?php echo $rows['description']; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                <?php } ?>
            </div>

        </div>
        </div>
    </form>
</section>
</body>
</html>
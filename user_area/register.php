<?php
    include('../includes/connect.php');
    include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
    <div class="container-fluid">
        <h2 class="text-center m-3">Register</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline">
                        <!-- username -->
                        <label for="user_username" class="from-label">Username</label>
                        <input type="text" id="user_username" class="form-control mb-4" autocomplete="off" name="user_username">
                        <!-- email -->
                        <label for="user_useremail" class="from-label">Email</label>
                        <input type="email" id="user_useremail" class="form-control mb-4" autocomplete="off" name="user_useremail">
                        <!-- image -->
                        <label for="user_image" class="from-label">Image</label>
                        <input type="file" id="user_image" class="form-control mb-4" name="user_image">
                        <!-- password -->
                        <label for="user_password" class="from-label">Password</label>
                        <input type="text" id="user_password" class="form-control mb-4" autocomplete="off" name="user_password">
                        <!-- submit -->
                        <div class="text-center">
                            <input type="submit" value="Register" class="bg-info py-2 px-3" name="user_register">
                            <p>Already have an account ? <a href="login.php">Login</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

<!-- php codes -->
<?php
    if (isset($_POST['user_register'])) {
        $user_username=$_POST['user_username'];
        $user_useremail=$_POST['user_useremail'];
        $user_password=$_POST['user_password'];
        $hash_pass=password_hash($user_password, PASSWORD_DEFAULT);
        $user_image=$_FILES['user_image']['name'];
        $user_image_tmp=$_FILES['user_image']['tmp_name'];
        $user_ip=getIPAddress();

        // insert query
        $select_query="Select * from `user` where username='$user_username' or user_email='$user_useremail'";
        $result=mysqli_query($con, $select_query);
        $rows_count=mysqli_num_rows($result);

        if ($rows_count>0) {
            echo "<script>alert('Username or email already exist !')</script>";
        } else {
            move_uploaded_file($user_image_tmp, "./user_images/$user_image");
            $insert_query="insert into `user` (username, user_email, user_password, user_image, user_ip) values ('$user_username', '$user_useremail', '$hash_pass', '$user_image', '$user_ip')";
            $sql_exec=mysqli_query($con, $insert_query);

            if ($sql_exec) {
                echo "<script>alert('Data inserted successfully !')</script>";
            } else {
                die(mysqli_error($con));
            }
        }

        // selecting cart items
        $select_cart_items="Select * from `cart_detail` where ip_address='$user_ip'";
        $result_cart=mysqli_query($con, $select_cart_items);
        $rows_count=mysqli_num_rows($result_cart);

        if ($rows_count>0) {
            $_SESSION['username']=$user_username;
            echo "<script>alert('You have items in your cart')</script>";
            echo "<script>window.open('checkout.php', '_self')</script>";
        } else {
            echo "<script>window.open('../index.php', '_self')</script>";
        }
    }
?>
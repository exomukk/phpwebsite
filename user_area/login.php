<?php 
    include('../functions/common_function.php');
    include('../includes/connect.php');
    @session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
    <div class="container-fluid">
        <h2 class="text-center m-3">Login</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline">
                        <!-- username -->
                        <label for="user_username" class="from-label">Username</label>
                        <input type="text" id="user_username" class="form-control mb-4" autocomplete="off" name="user_username">
                        <!-- password -->
                        <label for="user_password" class="from-label">Password</label>
                        <input type="text" id="user_password" class="form-control mb-4" autocomplete="off" name="user_password">
                        <!-- submit -->
                        <div class="text-center">
                            <input type="submit" value="Login" class="bg-info py-2 px-3" name="user_login">
                            <p>Don't have an account ? <a href="register.php">Register</a></p>
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
    if (isset($_POST['user_login'])) {
        $user_ip=getIPAddress();
        $user_username=$_POST['user_username'];
        $user_password=$_POST['user_password'];
        
        $select_query="Select * from `user` where username='$user_username'";
        $result=mysqli_query($con, $select_query);
        $row_count=mysqli_num_rows($result);
        $row_data=mysqli_fetch_assoc($result);

        // cart item
        $select_query_cart="Select * from `cart_detail` where ip_address='$user_ip'";
        $select_cart=mysqli_query($con, $select_query_cart);
        $row_count_cart=mysqli_num_rows($select_cart);

        if ($row_count>0) {
            $_SESSION['username']=$user_username;
            if (password_verify($user_password, $row_data['user_password'])) {
                if ($row_count==1 and $row_count_cart==0) {
                    $_SESSION['username']=$user_username;
                    echo "<script>alert('Login successful !')</script>";
                    echo "<script>window.open('../index.php', '_self')</script>";
                } else {
                    $_SESSION['username']=$user_username;
                    echo "<script>alert('Login successful !')</script>";
                    echo "<script>window.open('payment.php', '_self')</script>";
                }
            } else {
                echo "<script>alert('Invalid username or password')</script>";
            }
        } else {
            echo "<script>alert('Invalid username or password')</script>";
        }
    }
?>
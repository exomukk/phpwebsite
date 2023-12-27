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
    <title>register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
    <div class="container-fluid">
        <h2 class="text-center m-3">Admin Login</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline">
                        <!-- username -->
                        <label for="admin_name" class="from-label">Username</label>
                        <input type="text" id="admin_name" class="form-control mb-4" autocomplete="off" name="admin_name">
                        <!-- password -->
                        <label for="admin_password" class="from-label">Password</label>
                        <input type="text" id="admin_password" class="form-control mb-4" autocomplete="off" name="admin_password">
                        <!-- submit -->
                        <div class="text-center">
                            <input type="submit" value="Login" class="bg-info py-2 px-3" name="admin_login">
                            <p>Don't have an account ? <a href="admin_register.php">Register</a></p>
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
    if (isset($_POST['admin_login'])) {
        $admin_name=$_POST['admin_name'];
        $admin_password=$_POST['admin_password'];
        
        $select_query="Select * from `admin` where admin_name='$admin_name'";
        $result=mysqli_query($con, $select_query);
        $row_count=mysqli_num_rows($result);
        $row_data=mysqli_fetch_assoc($result);

        if ($row_count>0) {
            $_SESSION['admin_name']=$admin_name;
            if (password_verify($admin_password, $row_data['admin_password'])) {
                if ($row_count==1) {
                    $_SESSION['admin_name']=$admin_name;
                    echo "<script>alert('Login successful !')</script>";
                    echo "<script>window.open('index.php', '_self')</script>";
                } else {
                    echo "<script>alert('Invalid username or password')</script>";
                }
            } else {
                echo "<script>alert('Invalid username or password')</script>";
            }
        } else {
            echo "<script>alert('Invalid username or password')</script>";
        }
    }
?>
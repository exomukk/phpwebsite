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
        <h2 class="text-center m-3">Admin Register</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline">
                        <!-- username -->
                        <label for="admin_name" class="from-label">Username</label>
                        <input type="text" id="admin_name" class="form-control mb-4" autocomplete="off" name="admin_name">
                        <!-- email -->
                        <label for="admin_email" class="from-label">Email</label>
                        <input type="email" id="admin_email" class="form-control mb-4" autocomplete="off" name="admin_email">
                        <!-- password -->
                        <label for="admin_password" class="from-label">Password</label>
                        <input type="text" id="admin_password" class="form-control mb-4" autocomplete="off" name="admin_password">
                        <!-- submit -->
                        <div class="text-center">
                            <input type="submit" value="Register" class="bg-info py-2 px-3" name="admin_register">
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
    if (isset($_POST['admin_register'])) {
        $admin_name=$_POST['admin_name'];
        $admin_email=$_POST['admin_email'];
        $admin_password=$_POST['admin_password'];
        $hash_pass=password_hash($admin_password, PASSWORD_DEFAULT);

        // insert query
        $select_query="Select * from `admin` where admin_name='$admin_name' or admin_email='$admin_email'";
        $result=mysqli_query($con, $select_query);
        $rows_count=mysqli_num_rows($result);

        if ($rows_count>0) {
            echo "<script>alert('Username or email already exist !')</script>";
        } else {
            $insert_query="insert into `admin` (admin_name, admin_email, admin_password) values ('$admin_name', '$admin_email', '$hash_pass')";
            $sql_exec=mysqli_query($con, $insert_query);

            if ($sql_exec) {
                echo "<script>alert('Data inserted successfully !')</script>";
                echo "<script>window.open('index.php', '_self')</script>";
            } else {
                die(mysqli_error($con));
            }
        }
    }
?>
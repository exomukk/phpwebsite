<?php
    if (isset($_GET['edit_account'])) {
        $username_session = $_SESSION['username'];
        $select_query = "Select * from `user` where username='$username_session'";
        $result_query = mysqli_query($con, $select_query);
        $row_fetch = mysqli_fetch_array($result_query);
        $user_id = $row_fetch['user_id'];
        $user_name = $row_fetch['username'];
        $user_email = $row_fetch['user_email'];
    }

    if (isset($_POST['user_update'])) {
        $update_id = $user_id;
        $user_name = $_POST['user_username'];
        $user_email = $_POST['user_useremail'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];

        move_uploaded_file($user_image_tmp, "./user_images/$user_image");

        // update query 
        $update_data = "update `user` set username='$user_name', user_email='$user_email', user_image='$user_image' where user_id=$user_id";
        $result_query_update = mysqli_query($con, $update_data);

        if ($result_query_update) {
            echo "<script>alert('Data updated successfully !')</script>";
            echo "<script>window.open('logout.php', '_self')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3 class="text-center mb-4">Edit account</h3>
    <form action="" method="post" enctype="multipart/form-data" class="text-center">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_name ?>" name="user_username">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" value="<?php echo $user_email ?>" name="user_useremail">
        </div>
        <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control m-auto" name="user_image">            
            <img src="./user_images/<?php echo $user_image ?>" alt="" style='width: 20vh; object-fit: contain; margin: auto; display: block'>
        </div>

        <input type="submit" values="Update" class="bg-info py-2 px-3 border-0" name="user_update">
    </form>
</body>
</html>
<?php
    if (isset($_GET['delete_user'])) {
        $delete_id = $_GET['delete_user'];
        $delete_user = "Delete from `user` where user_id=$delete_id";
        $result_user = mysqli_query($con, $delete_user);

        if ($result_user) {
            echo "<script>alert('User deleted !')</script>";
            echo "<script>window.open('index.php?all_user.php', '_self')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3 class="text-center text-success">All user</h3>
    <table class="table table-bordered mt-5">
        <thead>
            <?php
                $get_user = "Select * from `user`";
                $result = mysqli_query($con, $get_user);
                $row_count = mysqli_num_rows($result);
                echo "<tr>
                <th>No.</th>
                <th>Username</th>
                <th>Email</th>
                <th>Image</th>
                <th>Delete</th>
                </tr>
                </thead>
                <tbody>";
                if ($row_count == 0) {
                    echo "<h2 class='bg-danger text-center mt-5>No user yet</h2>'";
                } else {
                    $number = 0;
                    while ($row_data = mysqli_fetch_assoc($result)) {
                        $user_id = $row_data['user_id'];
                        $username = $row_data['username'];
                        $user_email = $row_data['user_email'];
                        $user_image = $row_data['user_image'];
                        $number++;
                        echo "<tr>
                        <td>$number</td>
                        <td>$username</td>
                        <td>$user_email</td>
                        <td><img src='../user_area/user_images/$user_image' style='width: 15%; object-contain: fit'/></td>
                        <td><a href='index.php?delete_user=$user_id' class='text-dark'>Click</a></td>
                        </tr>";
                    }
                }
        ?>
    </table>
</body>
</html>
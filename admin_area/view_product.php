<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style> body { overflow-x: hidden; } </style>
</head>
<body>
    <h3 class="text-center text-success">All products</h3>
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>No.</th>
                <th>Product title</th>
                <th>Product image</th>
                <th>Product price</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $get_product = "Select * from `products`";
                $result = mysqli_query($con, $get_product);
                $number = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_image = $row['product_image'];
                    $product_price = $row['product_price'];
                    $number++;
                    ?>
                        <tr class='text-center'>
                            <td><?php echo $number ?></td>
                            <td><?php echo $product_title ?></td>
                            <td><img src='./product_image/<?php echo $product_image ?>' style='width: 10%; object-contain: fit'/></td>
                            <td><?php echo $product_price ?></td>
                            <td><a href='index.php?edit_product=<?php echo $product_id ?>' class='text-dark'>Click</a></td>
                            <td><a href='index.php?delete_product=<?php echo $product_id ?>' class='text-dark'>Click</a></td>
                        </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</body>
</html>
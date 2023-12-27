<?php
include('../includes/connect.php');
if (isset($_POST['insert_product'])){
    $product_title=$_POST['product_title'];
    $product_price=$_POST['product_price'];

    // accessing image
    $product_image=$_FILES['product_image']['name'];

    // accessing image tmp names
    $temp_image=$_FILES['product_image']['tmp_name'];

    // checking empty ?
    if ($product_title=='' or $product_price=='' or $product_image=='') {
        echo "<script>alert('Please fill all the fields')</script>";
    } else {
        move_uploaded_file($temp_image, "./product_image/$product_image");        

        // insert query
        $insert_product="insert into `products` (product_title, product_image, product_price) values ('$product_title', '$product_image', '$product_price')";
        $result_query=mysqli_query($con, $insert_product);
        if ($result_query) {
            echo "<script>alert('Successfully inserted !')</script>";
            echo "<script>window.open('index.php?view_product.php', '_self')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert products</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>

        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- title -->
            <div class="form-outline mb-4">
                <label for="product_title" class="form-label">Product title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title here" autocomplete="off" require="required">
            </div>

            <!-- image -->
            <div class="form-outline mb-4">
                <label for="product_image" class="form-label">Product Image</label>
                <input type="file" name="product_image" id="product_image" class="form-control" require="required">
            </div>

            <!-- Price -->
            <div class="form-outline mb-4">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price here" require="required">
            </div>

            <!-- Submit btn -->
            <div class="form-outline mb-4">
                <input type="submit" name="insert_product" class="btn btn-info" value="Submit">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
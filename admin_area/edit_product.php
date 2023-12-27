<?php 
    if (isset($_GET['edit_product'])) {
        $edit_id = $_GET['edit_product'];
        $get_data = "Select * from `products` where product_id=$edit_id";
        $result = mysqli_query($con, $get_data);
        $row = mysqli_fetch_assoc($result);
        $product_title = $row['product_title'];
        $product_image = $row['product_image'];
        $product_price = $row['product_price'];
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
    <div class="container mt-5">
        <h1 class="text-center">Edit product</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline w-50 m-auto mb-4">
                <label for="" class="form-label">Product title</label>
                <input type="text" id="product_title" name="product_title" class="form-control" required="required" value="<?php echo $product_title ?>">
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="" class="form-label">Product image</label>
                <div class="d-flex">
                    <input type="file" id="product_image" name="product_image" class="form-control w-90 m-auto" required="required">
                    <img src="./product_image/<?php echo $product_image ?>" alt="" style="width: 20vh; object-fit: contain; margin: auto; display: block">
                </div>
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="" class="form-label">Product price</label>
                <input type="text" id="product_price" name="product_price" class="form-control" required="required" value="<?php echo $product_price ?>">
            </div>
            <div class="text-center">
                <input type="submit" name="edit_product" value="Update" class="btn btn-info px-3 mb-3">
            </div>
        </form>
    </div>
</body>
</html>

<!-- php codes edit product -->
<?php
    if (isset($_POST['edit_product'])) {
        $product_title = $_POST['product_title'];
        $product_image = $_FILES['product_image']['name'];
        $product_image_tmp = $_FILES['product_image']['tmp_name'];
        $product_price = $_POST['product_price'];

        // checking empty ? 
        if ($product_title == '' or $product_price == '' or $product_image == '') {
            echo "<script>alert('Please fill all the field')</script>";
        } else {
            move_uploaded_file($product_image_tmp, "./product_image/$product_image");
            // query update
            $update_product = "update `products` set product_title='$product_title', product_image='$product_image', product_price='$product_price' where product_id=$edit_id";
            $result_update = mysqli_query($con, $update_product);
            
            if ($result_update) {
                echo "<script>alert('Product update success !')</script>";
                echo "<script>window.open('index.php?view_product.php', '_self')</script>";
            }
        }
    }
?>
<?php 
    include('./includes/connect.php');                            
    include('./functions/common_function.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">HuyTran</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-disabled="true" href="./user_area/register.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-disabled="true" href="cart.php">Cart (<?php        
                                    cart_item_number();
                                ?>)</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- call cart function -->
        <?php
            cart();
        ?>

        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <?php
                    if (!isset($_SESSION['username'])) {
                        echo "<li class='nav-item'>
                            <a class='nav-link' href='#'>Welcome Guest</a>
                            </li>";
                    } else {
                        echo "<li class='nav-item'>
                            <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
                            </li>";
                    }

                    if (!isset($_SESSION['username'])) {
                        echo "<li class='nav-item'>
                            <a class='nav-link' href='./user_area/login.php'>Login</a>
                            </li>";
                    } else {
                        echo "<li class='nav-item'>
                            <a class='nav-link' href='./user_area/logout.php'>Logout</a>
                            </li>";
                    }
                ?>
            </ul>
        </nav>

        <!-- third child -->
        <div class="bg-light">
            <h3 class="text-center">Cart</h3>
        </div>

        <div class="container">
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Number</th>
                                <th>Price</th>
                                <th>Tick to Remove</th>
                                <th colspan="2">More</th>
                            </tr>
                        </thead>

                        <tbody>
                            <!-- dynamic data -->
                            <?php
                                $ip = getIPAddress();
                                $total=0;
                                $cart_query="Select * from `cart_detail` where ip_address='$ip'";
                                $result=mysqli_query($con,$cart_query);

                                while ($row=mysqli_fetch_array($result)) {
                                    $product_id=$row['product_id'];
                                    $select_product="Select * from `products` where product_id='$product_id'";
                                    $result_product=mysqli_query($con,$select_product);
                                
                                    while ($row_price=mysqli_fetch_array($result_product)) {
                                        $product_price=array($row_price['product_price']);
                                        $price_table=$row_price['product_price'];
                                        $product_title=$row_price['product_title'];
                                        $product_image=$row_price['product_image'];
                                        $product_values=array_sum($product_price);
                                        $total+=$product_values;
                            ?>
                            <tr>
                                <td><?php echo $product_title ?></td>
                                <td><img src="./admin_area/product_image/<?php echo $product_image ?>" alt="" class="cart_img" style="width: 15vh; height: 15vh; object: fit-contain;"></td>
                                <td><input type="text" name="numb" class="form-input w-50"></td>
                                <?php
                                    $ip = getIPAddress();
                                    if (isset($_POST['update_cart'])) {
                                        $numberss=$_POST['numb'];
                                        $update_cart="update `cart_detail` set number=$numberss where ip_address='$ip'";
                                        $result_product_num=mysqli_query($con,$update_cart);
                                        $total=$total*$numberss;
                                    }
                                ?>
                                <td><?php echo $product_values ?>$</td>
                                <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                                <td>
                                    <input type="submit" value="Update Cart" class="btn btn-info" name="update_cart">
                                    <input type="submit" value="Remove Cart" class="btn btn-info" name="remove_cart">
                                </td>
                            </tr>

                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>

                    <!-- sub total -->
                    <div class="d-flex">
                        <h4 class="px-3">Total: <?php echo $total ?>$</h4>
                        <button class="px-3"><a href="index.php">Continue Shopping</a></button>
                        <button class="px-3"><a href="./user_area/checkout.php">Checkout</a></button>
                    </div>              
                </form>

                <!-- remove item func -->
                <?php
                    function remove_item() {
                        global $con;
                        if (isset($_POST['remove_cart'])) {
                            foreach($_POST['removeitem'] as $remove_id) {
                                echo $remove_id;
                                $delete_query="Delete from `cart_detail` where product_id='$remove_id'";
                                $run_del=mysqli_query($con,$delete_query);
                                if ($run_del) {
                                    echo "<script>window.open('cart.php', '_self')</script>";
                                }
                            }
                        }
                    }

                    echo $remove_item=remove_item();
                ?>
            </div>
        </div>

        <!-- last child -->
        <!-- footer in the future :D -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
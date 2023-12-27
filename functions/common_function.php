<?php
   
// include connect file
// include('./includes/connect.php');

// getting products
function getProducts() {
    global $con;
    $select_query="Select * from `products` order by product_title";
    $result_query=mysqli_query($con, $select_query);
    while ($row=mysqli_fetch_assoc($result_query)) {
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_image=$row['product_image'];
        $product_price=$row['product_price'];
        echo "<div class='col-md-3 mb-2'>
                <div class='card' style='width: 18rem;'>
                    <img src='./admin_area/product_image/$product_image' class='card-img-top' alt='...'>
                    <div class='card-body'>
                        <h5 class='card-title'>$product_title</h5>
                        <p class='card-text'>$product_price$</p>
                        <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                    </div>
                </div>
            </div>";
    }
}

// getting ip address
function getIPAddress() {  
    //whether ip is from the share internet  
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
        $ip = $_SERVER['HTTP_CLIENT_IP'];  
    }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }  
    //whether ip is from the remote address  
    else {  
        $ip = $_SERVER['REMOTE_ADDR'];  
    }  
    return $ip;  
}  
  
// cart function
function cart() {
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $ip = getIPAddress();
        $get_product_id=$_GET['add_to_cart'];
        $select_query="Select * from `cart_detail` where ip_address='$ip' and product_id=$get_product_id";
        $result_query=mysqli_query($con, $select_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if ($num_of_rows > 0) {
            echo "<script>alert('This item is already present in your cart !')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            $insert_query="insert into `cart_detail` (product_id, ip_address, number) values ($get_product_id, '$ip', 0)";
            $result_query=mysqli_query($con, $insert_query);
            echo "<script>alert('Item added to cart !')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
    }
}

// dynamic cart item number
function cart_item_number() {
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $ip = getIPAddress(); 
        $select_query="Select * from `cart_detail` where ip_address='$ip'";
        $result_query=mysqli_query($con, $select_query);
        $cart_item_count=mysqli_num_rows($result_query);
    } else {
        global $con;
        $ip = getIPAddress(); 
        $select_query="Select * from `cart_detail` where ip_address='$ip'";
        $result_query=mysqli_query($con, $select_query);
        $cart_item_count=mysqli_num_rows($result_query);
    }
    echo $cart_item_count;
}

// total price
function total_price() {
    global $con;
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
            $product_values=array_sum($product_price);
            $total+=$product_values;
        }
    }
    echo $total;
}

// get user order detail
function get_uod() {
    global $con;
    $username = $_SESSION['username'];
    $get_detail = "Select * from `user` where username='$username'";
    $result_query = mysqli_query($con, $get_detail);

    while ($row_query = mysqli_fetch_array($result_query)) {
        $user_id = $row_query['user_id'];
        if (!isset($_GET['edit_account'])) {
            if (!isset($_GET['my_order'])) {
                if (!isset($_GET['delete_account'])) {
                    $get_orders = "Select * from `order` where user_id=$user_id and order_status='pending'";
                    $result_order_query = mysqli_query($con, $get_orders);
                    $row_count = mysqli_num_rows($result_order_query);
                    if ($row_count > 0) {
                        echo "<h3 class='text-center my-5'>You have <span class='text-danger'>$row_count</span> pending orders</h3>";
                        ?><p class="text-center"><a href="profile.php?my_order" class="text-dark">Order details</a></p><?php
                    } else {
                        echo "<h3 class='text-center my-5'>You have <span class='text-danger'>$row_count</span> pending orders</h3>";
                        ?><p class="text-center"><a href="../index.php" class="text-dark">Explore products</a></p><?php
                    }
                }
            }
        }
    }
}
?>
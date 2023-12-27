<?php 

    include('../includes/connect.php');                         
    include('../functions/common_function.php');

    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
    }

    // getting total item and total price of all time
    $get_ip_address = getIPAddress();
    $total_price = 0;
    $cart_query_price = "Select * from `cart_detail` where ip_address='$get_ip_address'";
    $result_cart_price = mysqli_query($con, $cart_query_price);
    $invoice_number = mt_rand();
    $status = 'pending';
    $count_product = mysqli_num_rows($result_cart_price);

    while ($row_price = mysqli_fetch_array($result_cart_price)) {
        $product_id = $row_price['product_id'];
        $cart_products = "Select * from `products` where product_id=$product_id";
        $run = mysqli_query($con, $cart_products);

        while ($row_product_price = mysqli_fetch_array($run)) {
            $product_price = array($row_product_price['product_price']);
            $product_values = array_sum($product_price);
            $total_price += $product_values;
        }
    }

    // getting quantity from cart
    $get_cart = "Select * from `cart_detail`";
    $run_cart = mysqli_query($con, $get_cart);
    $get_item_number = mysqli_fetch_array($run_cart);
    $item_numbers = $get_item_number['number'];

    if ($item_numbers == 0) {
        $item_numbers = 1;
        $subtotal = $total_price;
    } else {
        $item_numbers = $item_numbers;
        $subtotal = $total_price * $item_numbers;
    }

    $insert_orders = "Insert into `order` (user_id, amount_due, invoice_number, total_products, order_date, order_status) values ($user_id, $subtotal, $invoice_number, $count_product, NOW(), '$status')";
    $result_query = mysqli_query($con, $insert_orders);
    if ($result_query) {
        echo "<script>alert('Order submitted successful !')</script>";
        echo "<script>window.open('profile.php', '_self')</script>";
    }

    // order pending
    $insert_pending_orders = "Insert into `pending_order` (user_id, invoice_number, product_id, quantity, order_status) values ($user_id, $invoice_number, $product_id, $item_numbers, '$status')";
    $result_pending_query = mysqli_query($con, $insert_pending_orders);

    // delete item from cart
    $empty_cart = "Delete from `cart_detail` where ip_address='$get_ip_address'";
    $result_delete = mysqli_query($con, $empty_cart);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3 class="text-center text-success">All orders</h3>
    <table class="table table-bordered mt-5">
        <thead>
            <?php
                $get_order = "Select * from `order`";
                $result = mysqli_query($con, $get_order);
                $row_count = mysqli_num_rows($result);
                echo "<tr>
                <th>No.</th>
                <th>Amount due</th>
                <th>Invoice number</th>
                <th>Total product</th>
                <th>Order date</th>
                <th>Status</th>
                </tr>
                </thead>
                <tbody>";
                if ($row_count == 0) {
                    echo "<h2 class='bg-danger text-center mt-5>No order yet</h2>'";
                } else {
                    $number = 0;
                    while ($row_data = mysqli_fetch_assoc($result)) {
                        $order_id = $row_data['order_id'];
                        $user_id = $row_data['user_id'];
                        $amount_due = $row_data['amount_due'];
                        $invoice_number = $row_data['invoice_number'];
                        $total_product = $row_data['total_products'];
                        $order_date = $row_data['order_date'];
                        $order_status = $row_data['order_status'];
                        $number++;
                        echo "<tr>
                        <td>$number</td>
                        <td>$amount_due</td>
                        <td>$invoice_number</td>
                        <td>$total_product</td>
                        <td>$order_date</td>
                        <td>$order_status</td>
                        </tr>";
                    }
                }
        ?>
    </table>
</body>
</html>
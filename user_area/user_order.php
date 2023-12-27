<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $username = $_SESSION['username'];
        $get_user = "Select * from `user` where username='$username'";
        $result = mysqli_query($con, $get_user);
        $row_fetch = mysqli_fetch_array($result);
        $user_id = $row_fetch['user_id'];
    ?>
    <h3>All orders</h3>
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>No.</th>
                <th>Amount due</th>
                <th>Total product</th>
                <th>Invoice number</th>
                <th>Date</th>
                <th>Complete/Incomplete</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $get_order_detail = "Select * from `order` where user_id=$user_id";
                $result_order = mysqli_query($con, $get_order_detail);
                $number = 1;
                while ($row_order = mysqli_fetch_array($result_order)) {
                    $oid = $row_order['order_id'];
                    $amount_due = $row_order['amount_due'];
                    $invoice_number = $row_order['invoice_number'];
                    $total_products = $row_order['total_products'];
                    $order_status = $row_order['order_status'];

                    if ($order_status == 'pending') {
                        $order_status = 'Incomplete';
                    } else {
                        $order_status = 'Complete';
                    }

                    $order_date = $row_order['order_date'];

                    echo "<tr>
                            <td>$number</td>
                            <td>$amount_due</td>
                            <td>$total_products</td>
                            <td>$invoice_number</td>
                            <td>$order_date</td>
                            <td>$order_status</td>";
                ?>
                <?php
                    if ($order_status == 'Complete') {
                        echo "<td>Paid</td>";
                    } else {
                        echo "<td><a href='confirm_payment.php?order_id=$oid' class='text-dark'>Confirm</a></td>
                        </tr>";
                    }

                    $number++;
                }
            ?>
        </tbody>
    </table>
</body>
</html>
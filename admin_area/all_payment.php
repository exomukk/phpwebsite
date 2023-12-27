<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3 class="text-center text-success">All payment</h3>
    <table class="table table-bordered mt-5">
        <thead>
            <?php
                $get_payment = "Select * from `payment`";
                $result = mysqli_query($con, $get_payment);
                $row_count = mysqli_num_rows($result);
                echo "<tr>
                <th>No.</th>
                <th>Invoice number</th>
                <th>Amount due</th>
                <th>Mode</th>
                <th>Order date</th>
                </tr>
                </thead>
                <tbody>";
                if ($row_count == 0) {
                    echo "<h2 class='bg-danger text-center mt-5>No payment yet</h2>'";
                } else {
                    $number = 0;
                    while ($row_data = mysqli_fetch_assoc($result)) {
                        $order_id = $row_data['order_id'];
                        $payment_id = $row_data['payment_id'];
                        $amount = $row_data['amount'];
                        $invoice_number = $row_data['invoice_number'];
                        $payment_mode = $row_data['payment_mode'];
                        $date = $row_data['date'];
                        $number++;
                        echo "<tr>
                        <td>$number</td>
                        <td>$invoice_number</td>
                        <td>$amount</td>
                        <td>$payment_mode</td>
                        <td>$date</td>
                        </tr>";
                    }
                }
        ?>
    </table>
</body>
</html>
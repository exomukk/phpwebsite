<?php
    include ('../includes/connect.php');
    session_start();

    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
        $select_data = "Select * from `order` where order_id=$order_id";
        $result = mysqli_query($con, $select_data);
        $row_fetch = mysqli_fetch_assoc($result);
        $invoice_number = $row_fetch['invoice_number'];
        $amount_due = $row_fetch['amount_due'];
    }

    if (isset($_POST['confirm_payment'])) {
        $invoice_number = $_POST['invoice_number'];
        $amount_due = $_POST['amount'];
        $payment_mode = $_POST['payment_mode'];
        $insert_query = "insert into `payment` (order_id, invoice_number, amount, payment_mode) values ($order_id, $invoice_number, $amount_due, '$payment_mode')";
        $result = mysqli_query($con, $insert_query);

        if ($result) {
            echo "<script>alert('Successfully confirm payment !')</script>";
            echo "<script>window.open('profile.php', '_self')</script>";
        }

        $update_order = "update `order` set order_status='Complete' where order_id=$order_id";
        $result_order = mysqli_query($con, $update_order);

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confirm payment</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="bg-secondary">
    <div class="container my-5">
        <h1 class="text-light text-center">Confirm Payment</h1>

        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto">
                    <option>Select payment mode</option>
                    <option>Momo</option>
                    <option>Netbanking</option>
                    <option>Cash on delivery</option>
                    <option>Pay offline</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="bg-info py-2 px-3 border-0" value="Confirm" name="confirm_payment">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<?php 
    include('../includes/connect.php');                         
    include('../functions/common_function.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>
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
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-disabled="true" href="register.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-disabled="true" href="../cart.php">Cart (<?php           
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
                            <a class='nav-link' href='login.php'>Login</a>
                            </li>";
                    } else {
                        echo "<li class='nav-item'>
                            <a class='nav-link' href='logout.php'>Logout</a>
                            </li>";
                    }
                ?>
            </ul>
        </nav>

        <!-- third child -->
        <div class="bg-light">
            <h3 class="text-center">HuyTran's Store</h3>
        </div>

        <!-- fourth child -->
        <div class="row px-1">
            <div class="col-md-12">
                <div class="row">
                    <?php
                        if (!isset($_SESSION['username'])) {
                            echo "<script>alert('Please login first !')</script>";
                            echo "<script>window.open('login.php', '_self')</script>";
                        } else {
                            echo "<script>window.open('payment.php', '_self')</script>";
                        }
                    ?>
                </div>
            </div>
        </div>

        <!-- last child -->
        <!-- footer in the future :D -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
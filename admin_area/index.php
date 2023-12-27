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
    <title>admin</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">HuyTran</a>                
            </div>
            <nav class="navbar navbar-expand-lg">
                <ul class="navbar-nav">
                    <?php
                        if (!isset($_SESSION['admin_name'])) {
                            echo "<li class='nav-item'>
                                    <a href='admin_register.php' class='nav-link'>Welcome Guest</a>
                                </li>";
                        } else {
                            echo "<li class='nav-item'>
                                    <a href='#' class='nav-link'>Welcome ".$_SESSION['admin_name']."</a>
                                </li>";
                        }
                    ?>
                </ul>
            </nav>
        </nav>

        <!-- second child -->
        <div class="bg-light">
            <h3 class="text-center">Admin page</h3>
        </div>

        <!-- third child -->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-3">
                    <a href="#"><img src="../images/avatar.jpg" alt="" class="admin_image"></a>
                    <p class="text-light text-center">
                        <?php
                            if (!isset($_SESSION['admin_name'])) {
                                echo "Admin's name";
                            } else {
                                echo $_SESSION['admin_name'];
                            }
                        ?>
                    </p>
                </div>
                <div class="button text-center">
                    <button><a href="insert_products.php" class="nav-link my-1">Insert Products</a></button>
                    <button><a href="index.php?view_product" class="nav-link my-1">View Products</a></button>
                    <button><a href="index.php?all_order" class="nav-link my-1">All orders</a></button>
                    <button><a href="index.php?all_payment" class="nav-link my-1">All payments</a></button>
                    <button><a href="index.php?all_user" class="nav-link my-1">List users</a></button>
                    <button>
                        <?php
                            if (!isset($_SESSION['admin_name'])) {
                                echo "<a class='nav-link' href='admin_login.php'>Login</a>";
                            } else {
                                echo "<a class='nav-link' href='admin_logout.php'>Logout</a>";
                            }
                        ?>
                    </button>
                </div>
            </div>
        </div>

        <!-- fourth child -->
        <div class="container my-3">
            <?php
                if (isset($_GET['view_product'])) {
                    include('view_product.php');
                }
                if (isset($_GET['edit_product'])) {
                    include('edit_product.php');
                }
                if (isset($_GET['delete_product'])) {
                    include('delete_product.php');
                }
                if (isset($_GET['all_order'])) {
                    include('all_order.php');
                }
                if (isset($_GET['all_payment'])) {
                    include('all_payment.php');
                }
                if (isset($_GET['all_user'])) {
                    include('all_user.php');
                }
                if (isset($_GET['delete_user'])) {
                    include('delete_user.php');
                }
            ?>
        </div>

        <!-- last child -->
        <!-- footer in the future :D -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
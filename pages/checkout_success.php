<?php
unset($_SESSION['shopping_cart']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Phone Case Shop</title>
    <?php
    include "../page_incs/head.inc.php";
    ?>
</head>


<body>
<?php
include "../page_incs/nav.inc.php";
?>

<div class="container-fluid h-100 d-flex flex-column">
    <main class="flex-grow-1 w-100">

        <br class="row">
        <div class="col-sm">
        </div>

        <div class="col-sm">

            <div style="text-align:center">
                <img src="../images/checkout.gif" alt="checkout_success" height="300" width="400">

                <h1>Thank you for your purchase!</h1>
                <p>We'll email you an order confirmation email with details and tracking info very soon.</p>

                <br/>
                <a href="index.php?page=home" id="cart1" class="btn btn-info btn-lg">Back to shop</a>
            </div>
        </div>

        <div class="col-sm">
        </div>

</div>
</main>
<?php
include "../page_incs/footer.inc.php";
?>
</body>

</html>

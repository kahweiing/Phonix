<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            if ($values["item_id"] == $_GET["id"]) {
                unset($_SESSION["shopping_cart"][$keys]);
                //echo '<script>alert("Item Updated")</script>';
            }
        }
    }
}

if (isset($_POST['action']) && $_POST['action'] == "change") {
    foreach ($_SESSION["shopping_cart"] as &$value) {
        if ($value['item_id'] === $_POST["item_id"]) {
            $value['item_quantity'] = $_POST["quantity"];
            break; // Stop the loop after we've found the product
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopping Cart</title>
    <?php
    include "../page_incs/head.inc.php";
    ?>
</head>

<body>
<div id="container">
    <div id="header">
        <?php
        include "../page_incs/nav.inc.php";
        ?>
    </div>
    <div id="body">
        <div class="container" role="banner" style="text-align: center; margin-top: 5%;">
            <h3>Order Details</h3>
        </div>
        <main role="main" class="row flex-grow-1 w-100 align-items-center">
            <div class="col-8 mx-auto">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        if (!empty($_SESSION["shopping_cart"])) {
                            $total = 0;
                            foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $values["item_name"]; ?>
                                        <br/>
                                        <img src="../phone_cases_img/<?= $values["item_image"] ?>"
                                             alt="<?= $values["item_image"] ?>" height="200px" width="100px">
                                    </td>
                                    <td>
                                        <form method='post' action=''>
                                            <input type='hidden' name='item_id'
                                                   value="<?php echo $values["item_id"]; ?>"/>
                                            <input type='hidden' name='action' value="change"/>
                                            <input type="number" name="quantity" class='quantity' aria-label="Search"
                                                   value="<?php echo $values["item_quantity"]; ?>" min="1" required
                                                   onChange="this.form.submit()">
                                    </td>
                                    </form>
                                    </td>
                                    <td>$ <?php echo $values["item_price"]; ?></td>
                                    <td>
                                        $ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>

                                    <td>
                                        <a href="cartpage.php?action=delete&id=<?php echo $values["item_id"]; ?>"
                                           aria-label="Remove"><span
                                                    class="text-danger">Remove</span></a>
                                    </td>
                                </tr>
                                <?php
                                $total = $total + ($values["item_quantity"] * $values["item_price"]);
                            }
                            ?>
                            <tr>
                                <td colspan="3" align="right">Total</td>
                                <td align="right">$ <?php echo number_format($total, 2); ?></td>

                                <form method="POST">
                                    <td>
                                        <button type="input" type="submit" name="remove_cart" class="btn btn-danger">
                                            Empty Cart
                                        </button>
                                    </td>
                                </form>

                                <?php
                                // Clears shopping cart
                                if (isset($_POST['remove_cart'])) {
                                    unset($_SESSION['shopping_cart']);
                                    echo "<meta http-equiv='refresh' content='0'>";
                                }
                                ?>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
                <br/>

                <div class="form-group">
                    <a href="products.php" class="btn btn-info">Back to shop</a>

                    <?php

                    if (!empty($_SESSION["shopping_cart"])) {
                        echo '<a href="checkout.php" class="btn btn-info pull right">Proceed to Payment</a>';
                    }
                    ?>
                </div>


            </div>
        </main>
    </div>
    <div id="footer">
        <?php
        include "../page_incs/footer.inc.php";
        ?>
    </div>
</div>
</body>
</html>




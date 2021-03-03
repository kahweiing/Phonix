<!DOCTYPE html>
<html lang="en">

<?php
session_start();
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

var_dump($_SESSION);

if (isset($_SESSION['id'])) {
    include "../page_incs/db_onetimelogin.php";
    $id = $_SESSION['id'];
    $query = mysqli_query($con, "SELECT * FROM member where member_id='$id'") or die(mysqli_error());
    $row = mysqli_fetch_array($query);
} else {
    $row['fname'] = $row['lname'] = $row['email'] = $row['address'] = $row['address2'] = $row['pno'] = $row['country'] = $row['state'] = $row['zip'] = "";
}

?>

<head>
    <title>Phone Case Shop</title>
    <link rel='stylesheet' href='../css/checkoutcss.css' type='text/css' media='all'/>
    <?php
    include "../page_incs/head.inc.php";
    ?>
</head>

<body class="bg-light">
<main>

    <?php
    include "../page_incs/nav.inc.php";


    ?>

    <br/>
    <div class="container">

        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="../images/phonix_logo_black.png" alt="phonix_logo" width="125"
                 height="125">
            <h2>Phonix Checkout</h2>
        </div>


        <!--            User's checkout Cart -->
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h3 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-dark">Your cart</span>
                    <?php
                    if (!empty($_SESSION["shopping_cart"])) {
                        $cart_count = count(array_keys($_SESSION["shopping_cart"]));
                        ?>
                        <span class="badge badge-secondary badge-pill"><?php echo $cart_count; ?></span>
                        <?php
                    }
                    ?>
                </h3>

                <?php
                if (!empty($_SESSION["shopping_cart"]))
                {
                $total = 0;
                foreach ($_SESSION["shopping_cart"] as $keys => $values)
                {
                ?>

                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">

                        <div>
                            <img src="../phone_cases_img/<?= $values["item_image"] ?>"
                                 alt="<?= $values["item_image"] ?>" height="100" width="50">
                        </div>

                        <div>
                            <p><?php echo $values["item_name"]; ?></p>
                            <small class="text-dark">Quantity: <?php echo $values["item_quantity"]; ?></small>
                        </div>
                        <span class="text-dark">$<?php echo $values["item_price"]; ?></span>
                    </li>

                    <?php
                    $total = $total + ($values["item_quantity"] * $values["item_price"]);
                    }
                    ?>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (SGD)</span>
                        <strong>$<?php echo number_format($total, 2); ?></strong>
                    </li>
                </ul>

                <!--                Checkout form-->
            </div>
            <div class="col-md-8 order-md-1">
                <h3 class="mb-3">Billing address</h3>
                <form name="checkout_form" class="needs-validation" action="process_checkout.php" method="post"
                      novalidate>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fname">First name</label>
                            <input type="text" class="form-control" id="fname" name="fname"
                                   value="<?php echo $row['fname']; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lname">Last name</label>
                            <input type="text" class="form-control" id="lname" name="lname"
                                   value="<?php echo $row['lname']; ?>" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com"
                               value="<?php echo $row['email']; ?>" required>
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St"
                               value="<?php echo $row['address']; ?>" required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address2">Address 2 <span class="text-dark">(Optional)</span></label>
                        <input type="text" class="form-control" name="address2" id="address2"
                               placeholder="Apartment or suite" value="<?php echo $row['address2']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="contactNumber">Contact Number</label>
                        <input type="text" class="form-control" name="contactNumber" id="contactNumber"
                               placeholder="Contact number" value="<?php echo $row['pno']; ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select class="custom-select d-block w-100" name="country" id="country" required>
                                <option value="">Choose...</option>
                                <option value="Singapore" <?php if ($row['country'] == "Singapore") echo "selected"; ?> >
                                    Singapore
                                </option>
                                <option value="United States" <?php if ($row['country'] == "United States") echo "selected"; ?> >
                                    United States
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">State</label>
                            <select class="custom-select d-block w-100" name="state" id="state" required>
                                <option value="">Choose...</option>
                                <option value="Singapore" <?php if ($row['state'] == "Singapore") echo "selected"; ?> >
                                    Singapore
                                </option>
                                <option value="California" <?php if ($row['state'] == "California") echo "selected"; ?> >
                                    California
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" name="zip" id="zip" placeholder="Zip Code"
                                   value="<?php echo $row['zip']; ?>" required>
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <h4 class="mb-3">Payment</h4>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cc-name">Name on card</label>
                            <input type="text" class="form-control" id="cc-name" placeholder="" required>
                            <small class="text-dark">Full name as displayed on card</small>
                            <div class="invalid-feedback">
                                Name on card is required
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="cc-number">Credit card number</label>
                            <input type="text" class="form-control" id="cc-number" placeholder="" maxlength="19"
                                   required>
                            <div class="invalid-feedback">
                                Credit card number is required
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="cc-expiration">Expiration</label>
                            <input type="text" class="form-control" id="cc-expiration" maxlength="5" required>
                            <div class="invalid-feedback">
                                Expiration date required
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="cc-cvv">CVV</label>
                            <input type="text" class="form-control" id="cc-cvv" placeholder="" maxlength="3" required>
                            <div class="invalid-feedback">
                                Security code required
                            </div>
                        </div>

                    </div>
                    <hr class="mb-4">

                    <a class="btn btn-warning btn-lg" href="index.php?page=cartpage">Back to cart</a>
                    &nbsp;
                    <button class="btn btn-info btn-lg" id="checkoutButton" type="submit">Checkout</button>

                </form>
                <br/>
            </div>
        </div>

</main>
</div>
</body>

<?php
}
?>

<script>
    // JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict';

        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {

                    checkForms
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

</script>

<?php
include "../page_incs/footer.inc.php";
?>
</html>
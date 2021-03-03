<?php
session_start(); //start session
$fname = $lname = $email = $address = $address2 = $pno = $country = $state = $zip = $errorMsg = "";
$success = true;

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
} else {
    $user_id = "0";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["fname"])) {
        $fname = sanitize_input($_POST["fname"]);
    }
    if (empty($_POST["lname"])) {
        $errorMsg .= "Last name is required.<br>";
        $success = false;
    } else {
        $lname = sanitize_input($_POST["lname"]);
    }
    if (empty($_POST["email"])) {
        $errorMsg .= "Email is required.<br>";
        $success = false;
    } else {
        $email = sanitize_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "Invalid email format.<br>";
            $success = false;
        }
    }
    if (empty($_POST["address"])) {
        $errorMsg .= "Address is required.<br>";
        $success = false;
    } else {
        $address = sanitize_input($_POST["address"]);
    }
    if (!empty($_POST["address2"])) {
        $address2 = sanitize_input($_POST["address2"]);
    }
    if (!empty($_POST["pno"])) {
        $pno = sanitize_input($_POST["pno"]);
    }
    if (empty($_POST["country"])) {
        $errorMsg .= "Country is required.<br>";
        $success = false;
    } else {
        $country = sanitize_input($_POST["country"]);
    }
    if (empty($_POST["state"])) {
        $errorMsg .= "State is required.<br>";
        $success = false;
    } else {
        $state = sanitize_input($_POST["state"]);
    }
    if (empty($_POST["zip"])) {
        $errorMsg .= "Zipcode is required.<br>";
        $success = false;
    } else {
        $zip = sanitize_input($_POST["zip"]);
    }
} else {
    echo "<h2>This page is not meant to be run directly.</h2>";
    echo "<a href='index.php?page=home'>Go back to the homepage</a>";
    exit();
}

processCheckout();

// Helper function that checks input for malicious or unwanted content.
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function processCheckout()
{
    global $fname, $lname, $email, $address, $address2, $pno, $country, $state, $zip, $errorMsg, $success, $user_id;

// DB Login
    include "../page_incs/db_onetimelogin.php";

// Create connection
    // Check connection
    if ($con->connect_error) {
        $errorMsg = "Connection failed: " . $con->connect_error;
        $success = false;
    } else {
        // Prepare the statement:
        $stmt = $con->prepare("INSERT INTO customer_purchases (fname, lname, email, address, address2, pno, country, state, zip, member_id) VALUES (?, ?, ?, ?, ?, ? ,?, ? ,?, ?) ");

        // Bind & execute the query statement:
        $stmt->bind_param("ssssssssss", $fname, $lname, $email, $address, $address2, $pno, $country, $state, $zip, $user_id);
        $result = $stmt->execute();
        if ($result) {

        } else {
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $success = false;
        }
        $stmt->close();
    }
    $con->close();
}

?>

<html>
<head>
    <link rel='stylesheet' href='../css/checkoutcss.css' type='text/css' media='all'/>
    <title>Checkout Results</title>
    <?php
    include "../page_incs/head.inc.php";
    ?>
</head>
<body>
<?php
include "../page_incs/nav.inc.php";
?>

<div class="container-fluid h-100 d-flex flex-column">
    <main>

        <br class="row">
        <div class="col-sm">
        </div>


        <?php
        if ($success) { ?>
        <script type="text/javascript">
            setTimeout('Redirect()', 8000);

            function Redirect() {
                window.location.href = "index.php?page=checkout_success";
            }
        </script>

        <div class="col-sm">
            <div class="vcenter"></div>
            <div style="text-align:center">
                <div class="loader"></div>
                <br/>
                <h1>Processing Transaction</h1>
                <h2>Please wait.</h2>
            </div>
        </div>
</div>

<?php
} else {
    echo "<h3>Oops!</h3>";
    echo "<h4>The following input errors were detected:</h4>";
    echo "<p>" . $errorMsg . "</p>";
    echo "<a class=\"btn btn-danger\" href=index.php?page=cartpage>Return to Cart</a>";
    //echo '<button class="btn btn-danger hBack">Return to Sign Up</button>';
}
?>

<div class="col-sm">
</div>
</main>
</div>
<?php
include "../page_incs/footer.inc.php";
?>
</body>
</html>
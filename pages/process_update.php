<?php
//if(!isset($_SESSION)) 
// { 
session_start();
// }

$id = $_SESSION['id'];
$message = "";
$fname = $lname = $email = $pno = $address = $pwd_hashed = $errorMsg = $address2 = "";
$success = true;
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
        $address = sanitize_input($_POST["address"]);
    }
    if (empty($_POST["address2"])) {
        $address2 = sanitize_input($_POST["address2"]);
    }
    if (empty($_POST["pno"])) {
        $pno = sanitize_input($_POST["pno"]);
    }
    if (empty($_POST["country"])) {
        $pno = sanitize_input($_POST["country"]);
    }
    if (empty($_POST["state"])) {
        $pno = sanitize_input($_POST["state"]);
    }
    if (empty($_POST["zip"])) {
        $pno = sanitize_input($_POST["zip"]);
    }
}

// Helper function that checks input for malicious or unwanted content.
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function UpdateDB()
{
    global $id, $fname, $lname, $email, $address, $address2, $pno, $country, $state, $zip, $pwd_hashed, $errorMsg, $success;

//Login DB
    include "../page_incs/db_onetimelogin.php";


// Create connection
    //$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        $success = false;
    } else {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $address2 = $_POST['address2'];
        $pno = $_POST['pno'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];

        $sql = ("UPDATE member SET fname ='$fname', lname ='$lname', email ='$email', address ='$address', address2 = '$address2',pno ='$pno',country = '$country',state = '$state',zip = '$zip' WHERE member_id = '$id'");

//        header('Location:index.php?page=account');
    }
    if ($con->query($sql) === TRUE) {
        // echo "Record updated successfully";
        $message = "Record updated successfully";
        $_SESSION["message"] = $message;
    } else {
        //echo "Error updating record: " . $conn->error;
        $message = "Error updating record";
        $_SESSION["message"] = $message;
    }
    $con->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Results</title>
    <?php
    include "../page_incs/head.inc.php";
    ?>
</head>
<body>
<div id="header">
    <?php
    include "../page_incs/nav.inc.php";
    ?>
</div>
<div class="container-fluid h-100 d-flex flex-column p-0">

    <div class="row" style="margin-top: 200px;">
        <div class="col-sm">
        </div>

        <div class="col-sm">
            <?php
            if ($success) {
            UpdateDB();
            echo "
                                <div>
                                    <h3>Update successful!</h3>
                                    <p>You will be redirected back to account page.</p>
                                </div>";

            ?>
        </div>

        <div class="col-sm">
        </div>
    </div>

    <script type="text/javascript">

        function Redirect() {
            window.location = "index.php?page=account";
        }

        // document.write("You will be redirected back to account page.");
        setTimeout('Redirect()', 1000);
        //-->
    </script>
    <?php
    } else {
        echo "<h3>Oops!</h3>";
        echo "<h4>The following input errors were detected:</h4>";
        echo "<p>" . $errorMsg . "</p>";
        echo "<a class=\"btn btn-danger\" href=index.php?page=account>Return to Account</a>";
    }
    ?>

    <div id="footer">
        <?php
        include "../page_incs/footer.inc.php";
        ?>
    </div>
</div>
</main>
</body>
</html>
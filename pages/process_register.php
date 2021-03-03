<?php
session_start(); //start session
$fname = $lname = $email = $pwd_hashed = $errorMsg = "";
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
    if (empty($_POST["pwd"]) || empty($_POST["pwd_confirm"])) {
        $errorMsg .= "Password and confirmation are required.<br>";
        $success = false;
    } else {
        if ($_POST["pwd"] != $_POST["pwd_confirm"]) {
            $errorMsg .= "Passwords do not match.<br>";
            $success = false;
        } else {
            $pwd_hashed = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
        }
    }
} else {
    echo "<h2>This page is not meant to be run directly.</h2>";
    echo "<p>You can register at the link below:</p>";
    echo "<a href='index.php?page=register'>Go to Sign up page...</a>";
    exit();
}

// Helper function that checks input for malicious or unwanted content.
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function saveMemberToDB()
{
    global $id, $fname, $lname, $email, $pwd_hashed, $errorMsg, $success;

// DB Login
    include "../page_incs/db_onetimelogin.php";


// Create connection
    // $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($con->connect_error) {
        $errorMsg = "Connection failed: " . $con->connect_error;
        $success = false;
    } else {
        // Prepare the statement:
        $stmt = $con->prepare("INSERT INTO member (fname, lname, email, password) VALUES (?, ?, ?, ?)");
        // $id = mysqli_insert_id($conn);
        $_SESSION['username'] = $fname; //get fname after registration 
        $_SESSION["loggedin"] = true;
        // Bind & execute the query statement:
        $stmt->bind_param("ssss", $fname, $lname, $email, $pwd_hashed);
        $result = $stmt->execute();
        if ($result) {
            $id = $stmt->insert_id;
            $_SESSION['id'] = $id;
        } else {
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $success = false;
            $_SESSION["loggedin"] = false;
        }
        $stmt->close();
    }
    $con->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration Results</title>
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
        <main class="container">
            <?php
            if ($success) {
                saveMemberToDB();
                ?>
                <script type="text/javascript">
                    window.location.href = "index.php?page=welcome";
                </script>
                <?php
            } else {
                echo "<h3>Oops!</h3>";
                echo "<h4>The following input errors were detected:</h4>";
                echo "<p>" . $errorMsg . "</p>";
                echo "<a class=\"btn btn-danger\" href=index.php?page=register>Return to Account</a>";
                //echo '<button class="btn btn-danger hBack">Return to Sign Up</button>';
            }
            ?>
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
<?php
session_start(); //start session
?>

<?php
$email = $pwd_hashed = $errorMsg = "";
$success = true;
if (isset($_POST['login-submit'])) {
    if (empty($_POST["email"])) {
        $errorMsg .= "Email is required.<br>";
        $success = false;
    } else {
        $email = sanitize_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "Invalid email format.";
            $success = false;
        }
    }

    if (empty($_POST["pwd"])) {
        $errorMsg .= "Password are required.<br>";
        $success = false;
    } else {
        $pwd_hashed = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
    }
}

authenticateUser();

function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/*
 * Helper function to authenticate the login.
 */

function authenticateUser()
{
    global $fname, $lname, $email, $pwd_hashed, $errorMsg, $success;
// Create database connection.   
// DB Login
    include "../page_incs/db_onetimelogin.php";

// Create connection
    //$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection    
    if ($con->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        // Prepare the statement:        
        $stmt = $con->prepare("SELECT * FROM member WHERE email=?");
        // Bind & execute the query statement:        
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Note that email field is unique, so should only have       
            // one row in the result set.            
            $row = $result->fetch_assoc();
            $fname = $row["fname"];
            $lname = $row["lname"];
            $_SESSION["id"] = $row['member_id'];
            $_SESSION["email"] = $row['email'];
            $pwd_hashed = $row["password"];
            $_SESSION['username'] = $fname;
            $_SESSION["loggedin"] = true;
            // Check if the password matches:            
            if (!password_verify($_POST["pwd"], $pwd_hashed)) {
                // Don't be too specific with the error message - hackers don't                
                // need to know which one they got right or wrong. :)               
                $errorMsg = "Email not found or password doesn't match...";
                $_SESSION["loggedin"] = false;
                $success = false;
            }
        } else {
            $errorMsg = "Email not found or password doesn't match...";
            $success = false;
        }
        $stmt->close();
    }
    $con->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Status</title>
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
                echo "<h1>Login successful!</h1>";
                echo "<h2>Welcome back $fname</h2>";
                // echo "<a class=\"btn btn-success\" href=index.php?page=home>Return to Home</a>";
                ?>
                <script type="text/javascript">
                    <!--
                    function Redirect() {
                        window.location = "index.php?page=home";
                    }

                    document.write("You will be redirected back to home page.");
                    setTimeout('Redirect()', 1000);
                    //-->
                </script>
                <?php
            } else {
                echo "<h1>Oops!</h1>";
                echo "<h2>The following input errors were detected:</h2>";
                echo "<p>" . $errorMsg . "</p>";
                echo "<a class=\"btn btn-warning\" href=index.php?page=login>Return to Login</a>";
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
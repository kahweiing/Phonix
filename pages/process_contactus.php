<?php
$success = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["name"])) {
        $userName = sanitize_input($_POST["name"]);
    }
    if (empty($_POST["name"])) {
        $errorMsg .= "Name is required.<br>";
        $success = false;
    } else {
        $userName = sanitize_input($_POST["name"]);
    }
    if (empty($_POST["email"])) {
        $errorMsg .= "Email is required.<br>";
        $success = false;
    } else {
        $useremail = sanitize_input($_POST["email"]);
        if (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "Invalid email format.<br>";
            $success = false;
        }
    }

    if (empty($_POST["phoneno"])) {
        $errorMsg .= "Phone number is required is required.<br>";
        $success = false;
    } else {
        $userphoneno = sanitize_input($_POST["phoneno"]);
    }
} else {
    echo "<h2>This page is not meant to be run directly.</h2>";
    echo "<a href='contactus.php'>Go to Contact us page...</a>";
    exit();
}

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<html>
<head>
    <title>Feedback in progress</title>
    <?php
    include "../page_incs/head.inc.php";
    ?>
</head>
<body>
<?php
include "../page_incs/nav.inc.php";
?>
<main class="container">
    <?php
    /* Namespace alias. */
    //
    //            use PHPMailer\PHPMailer\PHPMailer;
    //            use PHPMailer\PHPMailer\SMTP;

    /* Include the Composer generated autoload.php file. */
    //            require 'C:\Users\tshuj\Desktop\SJ work\1004-web sys & tech\php-7.4.11-nts-Win32-vc15-x64\composer\vendor\autoload.php';
    //
    //            /* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
    //            $mail = new PHPMailer(TRUE);
    //            $mail->isSMTP();                                            // Send using SMTP
    //            $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
    //            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
    //            $mail->Username = 'tshujuan07@gmail.com';                     // SMTP username
    //            $mail->Password = 'S.Jay99607';                               // SMTP password
    //            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    //            $mail->Port = 587;
    //
    //            /* Open the try/catch block. */
    //            try {
    //                /* Set the mail sender. */
    //                $mail->setFrom($_POST["email"], $_POST["name"]);
    //
    //                /* Add a recipient. */
    //                $mail->addAddress('tshujuan07@gmail.com', 'Shu Juan');
    //
    //                /* Set the subject. */
    //                $mail->Subject = 'Enquiry';
    //
    //                /* Set the mail message body. */
    //                $mail->Body = "Sender's Name: " . $_POST["name"] . "\n" . "Sender's contact: " . $_POST["phoneno"] .
    //                        "\n" . "Sender's email: " . $_POST["email"] . "\n" . "Sender's comment: " . $_POST["comment"];
    //
    //                /* Finally send the mail. */
    //                $mail->send();

    //                if ($success) {
    //                    echo "<h4>Email Sent! Thank you for your feedback!<br></h4>";
    //                    echo "<a class=\"btn btn-success\" href=\"\pages\home.php\">Return to Home</a>";
    //                } else {
    //                    echo "<h4>Sorry, an error had occurred, Return to Contact Us.<br></h4>";
    //                    echo "<a class=\"btn btn-danger\" href=\"\pages\contactus.php\">Return to Contact Us</a>";
    //                }
    //            } catch (Exception $e) {
    //                /* PHPMailer exception. */
    //                echo $e->errorMessage();
    //            } catch (\Exception $e) {
    //                /* PHP exception (note the backslash to select the global namespace Exception class). */
    //                echo $e->getMessage();
    //            }
    ?>
</main>

<?php
include "../page_incs/footer.inc.php";
?>
</body>
</html>



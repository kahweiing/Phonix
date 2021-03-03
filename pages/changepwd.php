<?php
if (!isset($_SESSION)) {
    session_start();
}
$message = "";
include "../page_incs/db_onetimelogin.php";
$id = $_SESSION['id'];

// This will be called once form is submitted
if (isset($_POST["change_password"])) {
    // Get all input fields
    $current_password = $_POST["current_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Check if current password is correct
    $sql = "SELECT * FROM member WHERE member_id = '" . $id . "'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_object($result);

    if (password_verify($current_password, $row->password)) {
        // Check if password is same
        if ($new_password == $confirm_password) {
            // Change password
            $sql = "UPDATE member SET password = '" . password_hash($new_password, PASSWORD_DEFAULT) . "' WHERE member_id = '" . $id . "'";
            mysqli_query($con, $sql);

            $message = "Password has been changed";
        } else {
            $message = "Password does not match.";
        }
    } else {
        $message = "Password is not correct";
    }
}

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
<div class="container-fluid h-100 d-flex flex-column p-0">
    <main class="row flex-grow-1 w-100 align-items-center">
        <div class="mx-auto">
            <div class="layout-form">

                <form method="post">
                    <h3 class="mb-0 text-body">Change Password</h3>
                    <?php
                    echo "<span style=\"color:#000000\">$message</span>";
                    ?>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-body form-control-label">Current password</label>
                        <div class="col-lg-9">
                            <input type="password" class="form-control" aria-label="current_password" required
                                   name="current_password" placeholder="Current password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-body form-control-label">New password</label>
                        <div class="col-lg-9">
                            <input type="password" class="form-control" aria-label="new_password" required
                                   name="new_password" placeholder="New password" minlength="6">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-body form-control-label">Confirm password </label>
                        <div class="col-lg-9">
                            <input type="password" class="form-control" aria-label="confirm_password" required
                                   name="confirm_password" placeholder="Confirm password">
                        </div>
                    </div>
                    <button type="submit" name="change_password" class="btn btn-primary btn-lg">Change password</button>
                </form>
            </div>
        </div>
    </main>
</div>
<?php
include "../page_incs/footer.inc.php";
?>
</body>
</html>
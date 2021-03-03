<!DOCTYPE html>
<html lang="en">
<title>Register Account</title>
<?php
include "../page_incs/head.inc.php";
?>

<body>
<?php
include "../page_incs/nav.inc.php";
?>

<main class="row flex-grow-1 w-100 align-items-center">
    <div class="mx-auto">
        <div class="layout-form">
            <form action="process_register.php" method="post">
                <h2>Sign Up</h2>
                <p class="text-body">Please fill in this form to create an account!</p>
                <hr>
                <div class="form-group">
                    <div class="input-group">

                        <input class="form-control" type="text" id="fname"
                               required maxlength="45" name="fname" aria-label="fname" placeholder="Enter first name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">

                        <input class="form-control" type="text" id="lname"
                               required maxlength="45" name="lname" aria-label="lname"
                               placeholder="Enter last name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">

                        <input class="form-control" type="email" id="email" required name="email"
                               aria-label="email" placeholder="Enter email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">

                        <input class="form-control" type="password" id="pwd" required name="pwd"
                               aria-label="pwd" placeholder="Enter password" minlength="6">

                    </div>
                    <p class="help-block text-body"> Password should be at least 6 characters</p>
                </div>
                <div class="form-group">
                    <div class="input-group">

                        <input class="form-control" type="password" id="pwd_confirm" required name="pwd_confirm"
                               aria-label="pwd_confirm" placeholder="Confirm password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="checkbox-inline text-body"><input type="checkbox" required="required"> I accept the
                        Terms of Use &amp; Privacy Policy</label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg">Sign Up</button>
                </div>
            </form>
            <div class="text-center" style="margin-bottom: 5%;">
                Already have an account? <a href="index.php?page=login" style="color:black"><u>Login here</u></a>
            </div>
        </div>
    </div>
</main>
<?php
include "../page_incs/footer.inc.php";
?>
</body>
</html>

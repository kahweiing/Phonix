<?php
//session_start(); // start session
?>

<!DOCTYPE html>
<html lang="en">
<title>Login Account</title>
<!--HEAD-->
<?php
include "../page_incs/head.inc.php";
?>
<body>
<!--    NAV BAR-->
<?php
include "../page_incs/nav.inc.php";
?>

<!--MEMBER LOGIN FORM-->
<div class="container-fluid d-flex flex-column justify-content-center" style="height: 90%!important;">

    <main class="row flex-grow-1 w-100 align-items-center">
        <div class="mx-auto">
            <div class="layout-form">
                <form action="process_login.php" method="post">
                    <h2>Member Login</h2>
                    <hr>
                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control" type="email" id="email" required name="email"
                                   aria-label="email" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control" type="password" id="pwd" required name="pwd"
                                   aria-label="pwd" placeholder="Enter password">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-lg" name="login-submit">Login</button>
                    </div>
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

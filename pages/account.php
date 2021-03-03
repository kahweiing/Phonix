<?php
if (!isset($_SESSION)) {
    session_start();
}

include "../page_incs/db_onetimelogin.php";

$id = $_SESSION['id'];
$query = mysqli_query($con, "SELECT * FROM member where member_id='$id'") or die(mysqli_error());
$row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "../page_incs/head.inc.php";
    ?>
    <title>Update Account Information</title>
</head>
<body>
<div id="container">
    <div id="header">
        <?php
        include "../page_incs/nav.inc.php";
        ?>
    </div>
    <div id="body">
        <div class="container-fluid h-100 d-flex flex-column p-0">
            <main role="main" class="row flex-grow-1 w-100 align-items-center">
                <div class="mx-auto">
                    <!-- form user info -->
                    <div class="layout-form">
                        <form action="process_update.php" method="post">
                            <h3 p class="text-body">User Information</h3>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-body form-control-label">First name</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="fname" aria-label="fname"
                                           placeholder="Enter your First Name" value="<?php echo $row['fname']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-body form-control-label">Last name</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="lname" aria-label="lname"
                                           placeholder="Enter your Last Name" value="<?php echo $row['lname']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-body form-control-label">Email</label>
                                <div class="col-lg-9">
                                    <input type="email" class="form-control" name="email" aria-label="email"
                                           placeholder="Enter your Email" value="<?php echo $row['email']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-body form-control-label">Contact
                                    Number</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="pno" aria-label="pno"
                                           placeholder="Enter your Contact No" value="<?php echo $row['pno']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-body form-control-label">Address</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="address" aria-label="address"
                                           placeholder="Enter your Address" value="<?php echo $row['address']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-body form-control-label">Address 2</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="address2" aria-label="address2"
                                           placeholder="Apartment or Suite" value="<?php echo $row['address2']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-body form-control-label">Country</label>
                                <div class="col-lg-9">
                                    <select class="custom-select d-block w-100" name="country" id="country">
                                        <option value="">Choose...</option>
                                        <option value="Singapore" <?php if ($row['country'] == "Singapore") echo "selected"; ?> >
                                            Singapore
                                        </option>
                                        <option value="United States" <?php if ($row['country'] == "United States") echo "selected"; ?> >
                                            United States
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-body form-control-label">State</label>
                                <div class="col-lg-9">
                                    <select class="custom-select d-block w-100" name="state" id="state" required>
                                        <option value="">Choose...</option>
                                        <option value="Singapore" <?php if ($row['state'] == "Singapore") echo "selected"; ?> >
                                            Singapore
                                        </option>
                                        <option value="California" <?php if ($row['state'] == "California") echo "selected"; ?> >
                                            California
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-body form-control-label">Zip</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="zip" aria-label="zip"
                                           placeholder="Enter your zipcode" value="<?php echo $row['zip']; ?>"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-body form-control-label"></label>
                                <div class="col-lg-9">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Save Changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div id="footer">       <!-- /form user info -->
        <?php
        include "../page_incs/footer.inc.php";
        ?>
    </div>
</div>
</body>
</html>


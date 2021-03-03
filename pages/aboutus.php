<!DOCTYPE html>
<html lang="en">
<head>
    <title>About Phonix</title>
    <link rel="icon" href="../images/phonix_logo.PNG">
    <meta name="description" content="The best phone case out there">
    <meta name="keywords" content="Phone case, Contact, About">

    <?php include "../page_incs/head.inc.php"; ?>
    <link rel="stylesheet" href="../css/about_contact.css">


</head>
<body>
<?php
include "../page_incs/nav.inc.php";
?>
<div class="container-fluid h-100 d-flex flex-column" style="padding: 0px;">
    <main class="flex-grow-1 w-100">
        <div class="jumbotron parallax text-center">
            <div>
                <h1 class="display-4">About us </h1>
            </div>
        </div>

        <div class="container" id="aboutus">
            <div>
                <hr>
                <p>
                    Phonix, located in Ang Mo Kio, sells different types of phone cases for your phone protection
                    needs. Our phone case are made from high quality materials sources from great manufacturers.
                    Our products ensure environment sustainability and can be recycled. If there is no case to
                    your liking, drop us a message and we will try our best to put that on our product page!
                </p>
                <hr>
            </div>
        </div>

        <div class="container">
            <h2 style="text-align: center;">Get in Touch</h2>
            <hr>
            <div>
                <div id="contactusRow" class="row">
                    <div id="contactmap" class="col-md-8" style="height:400px;">
                        <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.665252371279!2d103.8466486145811!3d1.3775233989953357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da16e96db0a1ab%3A0x3d0be54fbbd6e1cd!2sSingapore%20Institute%20of%20Technology%20(SIT%40NYP)!5e0!3m2!1sen!2ssg!4v1570768423752!5m2!1sen!2ssg"
                                frameborder="0" style="border:0;" allowfullscreen="" title="google map of Phonix">
                        </iframe>
                    </div>
                    <form id="contactForm" action="../pages/home.php" method="post" class="col-md-4 ">
                        <div class="form-group">
                            <a>Name:</a>
                            <input aria-label="contactName" type="text" class="form-control" id="contactName"
                                   name="contactName" placeholder="Name" pattern="[A-z ]+" required>
                        </div>

                        <div class="form-group">
                            <a>Email:</a>
                            <input aria-label="email" type="email" class="form-control" id="email" name="email"
                                   placeholder="Email"
                                   pattern="/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/" required>
                        </div>

                        <div class="form-group">
                            <a>Contact Number:</a>
                            <input aria-label="contactNumber" type="tel" class="form-control" id="contactNumber"
                                   name="contactPhoneNumber" placeholder="Phone Number" maxlength="8" required>
                        </div>

                        <div class="form-group">
                            <a>Feedback/Message:</a>
                            <textarea aria-label="Feedbacks" class="form-control" id="feedback" name="contactMessage"
                                      placeholder="Message" required></textarea>
                        </div>

                        <button type="submit" id="btnSubmit" class="btn btn-default">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </main>
    <?php
    include "../page_incs/footer.inc.php";
    ?>
</div>
</body>
</html>

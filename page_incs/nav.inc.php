<nav class="navbar navbar-expand-sm navbar-light text-right" id="navbar">
    <a class="navbar-brand" href="../pages/home.php"><img src="../images/phonix_logo_black.png" alt="phonix"
                                                          height="40"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav ">
            <li class="nav-item active ">
                <a class="nav-link" href="../pages/home.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=aboutus">About Us</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false" aria-label="navbarDropdown">
                    Shop
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="navbarDropdown">
                    <a class="dropdown-item" href="index.php?page=products">All</a>
                    <a class="dropdown-item" href="index.php?page=apple">Apple</a>
                    <a class="dropdown-item" href="index.php?page=huawei">Huawei</a>
                    <a class="dropdown-item" href="index.php?page=oppo">Oppo</a>
                    <a class="dropdown-item" href="index.php?page=samsung">Samsung</a>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item center">
                <a class="nav-link" title="Shopping Cart" href="index.php?page=cartpage">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bag" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M8 1a2.5 2.5 0 0 0-2.5 2.5V4h5v-.5A2.5 2.5 0 0 0 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5H2z"/>
                    </svg>
                    <?php
                    if (!empty($_SESSION["shopping_cart"])) {
                    $cart_count = count(array_keys($_SESSION["shopping_cart"]));
                    ?>
                    <span><?php echo $cart_count; ?></span></a>
                <?php
                }
                ?>
                </a>
            </li>

            <?php
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) { //Means user is logged in display logout
                ?>
                <li class="nav-item center dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false" aria-label="navbarDropdown">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-check-fill"
                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9.854-2.854a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                        </svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php?page=account">Account</a>
                        <a class="dropdown-item" href="index.php?page=changepwd">Change Password</a>
                    </div>
                </li>
                <li class="nav-item center">
                    <a class="nav-link" title="Log out" href="index.php?page=logout">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-circle-fill"
                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-11.5.5a.5.5 0 0 1 0-1h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5z"/>
                        </svg>
                    </a>
                </li>
                <?php
            } else //User is not logged in diplay login/register
            {
                ?>
                <li class="nav-item center dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false" aria-label="navbarDropdown">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-square"
                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path fill-rule="evenodd"
                                  d="M2 15v-1c0-1 1-4 6-4s6 3 6 4v1H2zm6-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        </svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php?page=login">Log in</a>
                        <a class="dropdown-item" href="index.php?page=register">Register</a>
                    </div>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</nav>
<?php
if (!isset($_SESSION)) {
    session_start();
}
//   DB connection
include "../page_incs/db_onetimelogin.php";

// The amounts of products to show on each page
$num_products_on_each_page = 9;

// The current page, in the URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;

// Select products ordered by the date added
$stmt = $con->prepare("SELECT * FROM products ORDER BY p_price ASC LIMIT ?,?");

// bindValue will allow us to use integer in the SQL statement, we need to use for LIMIT
$var1 = (($current_page - 1) * $num_products_on_each_page);

$stmt->bind_param('ii', $var1, $num_products_on_each_page);
$stmt->execute();

// Fetch the products from the database and return the result as an Array
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);

// Get the total number of products
$total_products = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Phone Case Shop</title>
    <?php
    include "../page_incs/head.inc.php";
    ?>
    <style>

    </style>
</head>
<body>
<?php
include "../page_incs/nav.inc.php";
?>
<header class="jumbotron parallax text-center">
    <div>
        <h1 class="display-4">Welcome to <img id="logo" src="../images/phonix_logo.PNG" alt="logo"></h1>
        <br/>
        <a id="companyInfo" style="color:white">The premier place to buy your mobile phones and accessories</a>
    </div>
</header>
<main class="container" id="mainpage">

    <h2>Hot items</h2>
    <hr>
    <div class="owl-carousel owl-theme" id="mycarosell">
        <?php foreach ($products as $product): ?>
            <div class="item">
                <span class="out-of-stock">Hot</span>
                <img src="../phone_cases_img/<?= $product['p_img'] ?>" class="phone_image"
                     alt="<?= $product['p_name'] ?>">
            </div>
        <?php endforeach; ?>
    </div>

    <hr>

    <h3>Popular items</h3>
    <hr>
    <div class="d-flex flex-row flex-wrap justify-content-center my-flex-container" id="product-container">
        <?php foreach ($products as $product): ?>
            <div class="p-2 my-flex-item product-content">
                <div class="d-flex flex-column my-flex-container-column box"
                     onclick='location.href="index.php?page=product&id=<?= $product['product_id'] ?>"'
                     style="cursor: pointer;">
                    <div class="p-2 my-flex-item">
                        <a href="index.php?page=product&id=<?= $product['product_id'] ?>" class="product">
                            <img src="../phone_cases_img/<?= $product['p_img'] ?>" width="80" height="150"
                                 class="phone_image" alt="<?= $product['p_name'] ?>">
                        </a>
                    </div>
                    <div>
                        <a class="text-body"><?= $product['p_name'] ?></a>
                    </div>
                    <div>
                        <a class="text-danger">&dollar;<?= $product['p_price'] ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <hr>
    <div class="buttons">
        <?php if ($current_page > 1): ?>
            <a href="index.php?page=products&p=<?= $current_page - 1 ?>">Prev</a>
        <?php endif; ?>

        <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)): ?>
            <a href="index.php?page=products&p=<?= $current_page + 1 ?>">Next</a>
        <?php endif; ?>
    </div>

</main>
<?php
include "../page_incs/footer.inc.php";
?>
<script>$('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        dots: false,
        responsive: {
            0: {
                items: 3
            },
            600: {
                items: 4
            },
            1000: {
                items: 6
            }
        }
    })</script>
<script>
    //highlight boxes on hover
    $('.box').mouseover(function () {
        $(this).css("background", "#A9D4C5");
    });
    $(".box").mouseout(function () {
        $(".box").css("background", "white");
    });
</script>
</body>
</html>
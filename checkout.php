<?php
session_start();
include('includes/DB.php');
include('function/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/style.css" media="all"/>
</head>
<body>
    <!-- main container starts -->
    <div class="main_wrapper">
        <!-- header section starts -->
        <header class="header_wrapper">
            <a href="index.php"><img src="images/logo.jpg" alt="Logo" style="float:left;width:30%;height:100px"></a>
            <img src="images/banner.jpg" alt="Logo" style="float:right;width:70%;height:100px">
        </header>
        <!-- header section ends -->

       <!-- navigation bar starts -->
        <nav class="navbar">
            <!-- menu starts here -->
            <menu>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="all_products.php">All Products</a></li>
                    <li><a href="my_account.php">My Account</a></li>
                    <li><a href="uaer_registeration.php">Sign Up</a></li>
                    <li><a href="cart.php">shopping cart</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </menu>
            <!-- menu ends here -->

            <!-- search form starts here-->
            <div class="search_form">
                <form method="get" action="results.php"  enctype="multipart/form-data">
                    <input type="text" name="user_serach" placeholder="Search a Product"/>
                    <input type="submit" name="search" value="Search"/>
                </form>
            </div>
            <!-- search form ends heres-->
        </nav>
       <!-- navigation bar ends -->

       <!-- content area starts -->
        <section class="content_area">
            <div id="left_sidebar">
                <!-- title of sidebar -->
                <div class="sidebar_title">Categories</div>
                <!-- sidebar items start-->
                <ul id="menu_item">
                    <?php
                        getCategories()
                    ?>
                </ul>
                <!-- sidebar items ends -->

                <!-- title of sidebar -->
                <div class="sidebar_title">Brands</div>
                <!-- sidebar items start-->
                <ul id="menu_item">
                    <?php
                    getBrands();
                    ?>
         </ul>
                <!-- sidebar items ends -->

            </div>
            <div id="right_content_area">
                <!-- for shopping details headlines-->
                <?php
                cart();
                ?>
                <div id="headline">
                    <div id="headline_content">
                        <div>Welcome Guest!<b style="color:yellow">Shopping Cart</b><span> -Total Items [<?php items()?>]- Price [<?php getPrice()?>]<a href="cart.php" style="color:yellow">Go to Cart</a></span>
                        <?php
                        if(isset($_SESSION['customer_email']))
                        {
                            echo "<a href='customer/logout.php' style='color:#dddddd'>Logout</a>";
                        }
                        else
                        {
                            echo "<a href='checkout.php' style='color:#dddddd'>Login</a>";
                        }
                        
                        ?>
                        </div>
                    </div>
                </div>
                <!-- for product list boxes -->
                <div class="products_box">
                    <?php
                    if(!isset($_SESSION['customer_email'])){
                        include("customer/customer_login.php");
                    }else{
                        include("payment_options.php");
                    }
                    ?>
                </div>
            </div>
        </section>
       <!-- content area ends -->

       <!-- footer section starts -->
        <footer class="footer">
            footer section
        </footer>
       <!-- footer section ends -->

    </div>
     <!-- main container end -->
     <a href="admin_area/insert_product.php">click here</a>
</body>
</html>
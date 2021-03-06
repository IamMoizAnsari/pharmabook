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
                    <li><a href="all_products.phps">All Products</a></li>
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
                        $get_products = "select * from products order by rand()";
                        $run_products = mysqli_query($db,$get_products);
                        $count = mysqli_num_rows($run_products);
                        if($count == 0){
                            echo "<h2>No product found !<h2/>";
                        }else{
                            while($row_products = mysqli_fetch_array($run_products)){
                            $product_id = $row_products['product_id'];
                            $cat_id = $row_products['cat_id'];
                            $brand_id = $row_products['brand_id'];
                            $product_title = $row_products['product_title'];
                            $product_img1 = $row_products['product_img1'];
                            $product_price = $row_products['product_price'];
                            $product_desc = $row_products['product_desc'];
                            // shows a product box
                            echo" 
                                <div id='single_product'>
                                    <h1>$product_title</h1>
                                    <img src='admin_area/products_images/img.jpg' alt='' width='70%' height='100px'>
                                    <br/>
                                    <b>price :- $product_price RS</b>
                                    <br/>
                                    <a href='details.php?pro_id=$product_id' style='float:left'>Details</a>
                                    <a href='index.php?add_cart=$product_id'><button style='float:right'>Add to Cart</button></a>          
                                </div>";                        
                            }
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
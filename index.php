<?php
include('includes/DB.php');
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
            <img src="images/logo.jpg" alt="Logo" style="float:left;width:30%;height:100px">
            <img src="images/banner.jpg" alt="Logo" style="float:right;width:70%;height:100px">
        </header>
        <!-- header section ends -->

       <!-- navigation bar starts -->
        <nav class="navbar">
            <!-- menu starts here -->
            <menu>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">All Products</a></li>
                    <li><a href="#">My Account</a></li>
                    <li><a href="#">Sign Up</a></li>
                    <li><a href="#">shopping cart</a></li>
                    <li><a href="#">Contact Us</a></li>
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
                    $get_cats_query = "select * from categories";
                    $run_cats = mysqli_query($con,$get_cats_query);
                    while($row_cat = mysqli_fetch_array($run_cats))
                    {
                        $cat_id = $row_cat['cat_id'];
                        $cat_title = $row_cat['cat_title'];
                        echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
                    }
                    
                    ?>
                </ul>
                <!-- sidebar items ends -->

                <!-- title of sidebar -->
                <div class="sidebar_title">Brands</div>
                <!-- sidebar items start-->
                <ul id="menu_item">
                    <?php
                    $get_brand_query = 'select * from brands';
                    $run_brand_query = mysqli_query($con,$get_brand_query);
                    while($row_brand = mysqli_fetch_array($run_brand_query))
                    {
                        $brand_id = $row_brand['brand_id'];
                        $brand_title = $row_brand['brand_name'];
                        echo "<li><a href='index.php?brand_id=$brand_id'>$brand_title</a></li>";
                    }
                    
                    ?>
         </ul>
                <!-- sidebar items ends -->

            </div>
            <div id="right_content_area">content area</div>
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
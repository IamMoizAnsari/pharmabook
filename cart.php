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
                    
                <form action="cart.php" method="post" enctype="multipart/form-data">
                    <table width="90%" style="align:center;background:#0099cc;border:3px solid black">
                        <tr style="align:center;border:2px solid black">
                            <td style="border:3px solid black;height:30px">Remove</td>
                            <td style="border:3px solid black;height:30px">Product(s)</td>
                            <td style="border:3px solid black;height:30px">Quantity</td>
                            <td style="border:3px solid black;height:30px">Price</td>
                            <td style="border:3px solid black;height:30px">Total Price</td>
                        </tr>
<!--  -->
                    <?php
                        $ip = getIpAddress();
                        $total = 0;
                        $get_pro_id = "select * from cart where ip_add='$ip'";
                        $run_get_pro_id = mysqli_query($con,$get_pro_id);
                        while($record = mysqli_fetch_array($run_get_pro_id)){
                            $pro_id = $record['p_id'];
                            $qty = $record['qty'];
                            $get_pro_price = "select * from products where product_id = '$pro_id'";
                            $run_pro_price = mysqli_query($con,$get_pro_price);
                            while($each_record = mysqli_fetch_array($run_pro_price))
                            {
                                
                                $product_price = array($each_record['product_price']);
                                $values = array_sum($product_price);
                                $total += $values;
                                $product_id= $each_record['product_id'];
                                $product_title= $each_record['product_title'];
                                $product_img= $each_record['product_img1'];
                                $product_id= $each_record['product_id'];
                                $only_price =  $each_record['product_price'];
                                // $total_cost = $product_price * $qty;
                           
                    ?>
<!--  -->

                        <tr >
                            <td style="border:2px solid black"><input type="checkbox" name="remove[]" value="<?php echo $pro_id?>"></td>
                            <td style="border:2px solid black"><?php echo $product_title?><br><img src="admin_area/products_images/img.jpg" alt="product image" width="50px" height="40px"/></td>
                            <td style="border:2px solid black"><input type="text" name="qty" value="<?php echo $qty?> "></td>
                            <?php
                            if(isset($_POST['update']))
                            {
                                if(isset($_POST['qty']))
                                {
                                    echo "<script>console.log('yes')</script>";
                                    $qty = $_POST['qty'];
                                    $update_qty = "update cart set qty='$qty' where p_id='$product_id'";
                                    $run_update_qty = mysqli_query($con,$update_qty);
                                    // echo "<script>window.open('cart.php','_self')</script>";
                                }
                            }
                            ?>
                            <td style="border:2px solid black"><?php echo $only_price;?></td>
                            <td style="border:2px solid black"><?php echo $only_price*$qty;?></td>
                        </tr>
                        
                            <?php }}?>
                        <tr>
                            <td colspan="3"><b>Sub Total :-</b></td>
                            <td><?php echo $total;?></td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="2"><input type="submit" name="update" value="Update Cart"></td>
                            <td><input type="submit" name="continue" value="Continue Shopping"></td>
                            <td><button><a href="checkout.php" style="text-decoration:none;color:red">Checkout</a></button></td>
                        </tr>

                    </table>
                </form>
                    <?php
                    if(isset($_POST['update']))
                    {
                        if(isset($_POST['qty']))
                        {
                            $qty = $_POST['qty'];
                            $update_qty = "update cart set qty='$qty' ";
                            $run_update_qty = mysqli_query($con,$update_qty);
                            echo "<script>window.open('cart.php','_self')</script>";
                        }
                        foreach($_POST['remove'] as $remove_id){
                            $remove_item = "delete from cart where p_id = '$remove_id'"; 
                            $run_delete = mysqli_query($con,$remove_item);
                            if($run_delete)
                            { 
                                echo "<script>window.open('cart.php','_self')</script>";
                            }
                        }
                    }
                    if(isset($_POST['continue']))
                    {
                        echo "<script>window.open('index.php','_self')</script>";
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
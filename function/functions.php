<?php

 $db = mysqli_connect("localhost","root","","pharmabook");

function getPro(){
    global $db;
    if(!isset($_GET['cat'])){
        if(!isset($_GET['brand_id'])){
            $get_products = "select * from products order by rand() LIMIT 0,6";
    $run_products = mysqli_query($db,$get_products);
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
    }
    
}
// get product according categories

function getCatPro(){
    global $db;
    if(isset($_GET['cat'])){
        $cat_id = $_GET['cat'];
        $get_products = "select * from products where cat_id = '$cat_id'";
        $run_products = mysqli_query($db,$get_products);
        $count = mysqli_num_rows($run_products);
        if($count == 0){
            echo "<h2>No product found in this category</h2>";

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
        

        
    }
    
}

//get products according to brands 
function getBrandPro(){
    global $db;
    if(isset($_GET['brand_id'])){
        $brand_id = $_GET['brand_id'];
        $get_products = "select * from products where brand_id = '$brand_id'";
        $run_products = mysqli_query($db,$get_products);
        $count = mysqli_num_rows($run_products);
        if($count == 0){
            echo "<h2>No product found in this Brand type.<h2/>";
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
    }
}
// function to get categories
function getCategories()
{
    global $db;
    $get_cats_query = "select * from categories";
    $run_cats = mysqli_query($db,$get_cats_query);
    while($row_cat = mysqli_fetch_array($run_cats))
    {
        $cat_id = $row_cat['cat_id'];
        $cat_title = $row_cat['cat_title'];
        echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
    }
                    
}

// function to get brands
function getBrands(){
    global $db;
    $get_brand_query = 'select * from brands';
    $run_brand_query = mysqli_query($db,$get_brand_query);
    while($row_brand = mysqli_fetch_array($run_brand_query))
    {
        $brand_id = $row_brand['brand_id'];
        $brand_title = $row_brand['brand_name'];
        echo "<li><a href='index.php?brand_id=$brand_id'>$brand_title</a></li>";
    }
                    
}
?>
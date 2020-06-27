<?php
include ("../includes/DB.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="styles/style.css" rel="stylesheet" media="all"/>
</head>
<body>
    <div>
    <form method="post" action="insert_product.php" enctype="multipart/form-data">
        <table class="table">
            <tr>
                <td colspan="2">
                    <h2>Insert new product</h2>
                </td>
            </tr>
            <tr>
                <td style="align:right;"><b>Product Title</b></td>
                <td><input type="text" name="product_title"></td>
            </tr>
            <tr>
            <td><b>Product Category</b></td>
                <td>
                    <select name="product_cat" id="">
                        <option >select a category</option>
                        <!-- get categories from database -->
                        <?php
                            $get_cats_query = "select * from categories";
                            $run_cats = mysqli_query($con,$get_cats_query);
                            while($row_cat = mysqli_fetch_array($run_cats))
                            {
                                $cat_id = $row_cat['cat_id'];
                                $cat_title = $row_cat['cat_title'];
                                echo "<option value='$cat_id'>$cat_title</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
            <td><b>Product Brand</b></td>
                <td>
                <select name="product_brand" id="">
                        <option >select a brand</option>
                        <!-- get brands from database -->
                        <?php
                            $get_brands_query = "select * from brands";
                            $run_brands = mysqli_query($con,$get_brands_query);
                            while($row_brand = mysqli_fetch_array($run_brands))
                            {
                                $brand_id = $row_brand['brand_id'];
                                $brand_title = $row_brand['brand_name'];
                                echo "<option value='$brand_id'>$brand_title</option>";
                            }
                        ?>
                    </select>

                </td>
            </tr>
            <tr>
                <td><b>Product Image(1)</b></td>
                <td><input type="file" name="product_img1"></td>
            </tr>
            <tr>
                <td><b>Product Image(2)</b></td>
                <td><input type="file" name="product_img2"></td>
            </tr>
            <tr>
                <td><b>Product Image(3)</b></td>
                <td><input type="file" name="product_img3"></td>
            </tr>
            <tr>
                <td><b>Product Price</b></td>
                <td><input type="text" name="product_price"></td>
            </tr>
            <tr>
                <td><b>Product Description</b></td>
                <td><textarea  cols="20" rows="10" name="product_desc"></textarea></td>
            </tr>
            <tr>
                <td><b>Product Keywords</b></td>
                <td><input type="text" name="product_keywords"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="insert_product" value="Insert Product"></td>
            </tr>
        </table>

    </form>
    </div>
</body>
</html>

<!-- logic to add product -->
<?php
if(isset($_POST['insert_product'])){

    $product_title  = $_POST['product_title'];
    $product_cat  = $_POST['product_cat'];
    $product_brand  = $_POST['product_brand'];
    $product_price  = $_POST['product_price'];
    $product_desc  = $_POST['product_desc'];
    $product_key  = $_POST['product_keywords'];
    $status = 'on';
    // image names
    $product_Img1  = $_FILES['product_img1']['name'];
    $product_Img2  = $_FILES['product_img2']['name'];
    $product_Img3  = $_FILES['product_img3']['name'];
    // images temporary names
    $temp_name1  = $_FILES['product_img1']['tmp_name'];
    $temp_name2  = $_FILES['product_img2']['tmp_name'];
    $temp_name3  = $_FILES['product_img3']['tmp_name'];

    if($product_title == '' OR $product_cat =='' OR $product_brand =='' OR $product_price =='' OR $product_desc =='' OR $product_key =='' ){
        echo "<script>alert('Please fill all the fields')</script>";
        exit();
    }else{
            // upload images to its folder
            move_uploaded_file($temp_name1,"products_images/$product_Img1");
            move_uploaded_file($temp_name2,"products_images/$product_Img2");
            move_uploaded_file($temp_name3,"products_images/$product_Img3");
        // query creation
        // for date either we can use current_timestamp() or NOW() function in php
        $insert_product = "INSERT INTO `products` (cat_id , brand_id , date, product_title, product_img1, product_img2, product_img3, product_price, product_desc, status) VALUES ('$product_cat', '$product_brand', current_timestamp(), '$product_title', '$product_Img1', '$product_Img2', '$product_Img3', '$product_price', '$product_desc', '$status')";
        $run_product = mysqli_query($con,$insert_product);
        if($run_product)
        {
            echo "<script>alert('product inserted successfully!')</script>";
        }
        else{
            echo "<script>alert('Error')</script>";
        }

    }

}

?>
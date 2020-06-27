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
    <form method="post" action="insert_product.php" enctype="multipart/from-data">
        <table class="table">
            <tr>
                <td colspan="2">
                    <h2>Insert new product</h2>
                </td>
            </tr>
            <tr>
                <td style="align:right;"><b>Product Title</b></td>
                <td><input type="text" name="product_titile"></td>
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
                <td colspan="2"><input type="submit" name="product_submit"></td>
            </tr>
        </table>

    </form>
    </div>
</body>
</html>
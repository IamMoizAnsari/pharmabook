<?php
include ("../includes/DB.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style/style.css" rel="stylesheet" media="all"/>
</head>
<body>
    <div>
    <form method="post" action="customer_registration.php" enctype="multipart/form-data">
        <table class="table">
            <tr>
                <td colspan="2">
                    <h2>Register Here</h2>
                </td>
            </tr>
            <tr>
                <td style="align:right;"><b>Your Name</b></td>
                <td><input type="text" name="cutomer_name"></td>
            </tr>
            <tr>
            <td style="align:right;"><b>Your Email</b></td>
            <td><input type="email" name="cutomer_email"></td>
            </tr>
            <tr>
            <td style="align:right;"><b>Your Password</b></td>
                <td><input type="password" name="cutomer_pass"></td></tr>
            <tr>
                <td><b>Select Profile Picture</b></td>
                <td><input type="file" name="customer_image"></td>
            </tr>
            <tr>
                <td><b>Contact</b></td>
                <td><input type="number" name="customer_contact"></td>
            </tr>
            <tr>
                <td><b>Address</b></td>
                <td><textarea  cols="20" rows="10" name="customer_address"></textarea></td>
            </tr>
            <tr>
                <td><b>City</b></td>
                <td><input type="text" name="customer_city"></td>
            </tr>
            <tr>
                <td><b>Country</b></td>
                <td><input type="text" name="customer_country"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="create_user" value="Create"></td>
            </tr>
        </table>

    </form>
    </div>
</body>
</html>


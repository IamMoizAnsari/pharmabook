<?php
@session_start();
?>
<div>
    <h2>Login Or Register</h2>
    <form action="checkout.php" method="post">
        <b>Your Email</b><input type="text" name="c_email" placeholder="Enter your email">
        <b>Your Password</b><input type="password" name="c_pass" placeholder="Enter your password">
        <a href="forgot_pass.php">Forgote Password Click here !</a>
        <br/>
        <input type="submit" name="c_login" value="Login">
    </form>
    <h2><a href="customer/customer_registration.php">New Registration Here!</a></h2>
</div>
<?php
if(isset($_POST['c_login'])){
    $email = $_POST['c_email'];
    $pass = $_POST['c_pass'];
    $con= mysqli_connect("localhost","root","","pharmabook");
    $sel_customer = "select * from customers where customer_email ='$email' AND customer_password='$pass'";
    $run_sel_customer = mysqli_query($con,$sel_customer);
    $check_customer = mysqli_num_rows($run_sel_customer);
    $ip = getIpAddress();
    $sel_cart = "select * from cart where ip_add ='$$ip'";
    $run_cart = mysqli_query($con,$sel_cart);
    $check_cart = mysqli_num_rows($run_cart);
// if customer is not exist then again goes to login page.
    if($check_customer ==0){
        echo "<script>alert('Email address or Password is not correct , Try again !')</script>";
        exit();
    }else{
// if customer exist
    if($check_customer==1 AND $check_cart==0){
        // customer exist but no items into the cart then go to account page
        $_SESSION['customer_email'] = $email;
        echo "<script>window.open('customer/my_account.php','_self')</script>";
    }else{
        // customer exist and have items into the cart then go to payment page
        $_SESSION['customer_email'] = $email;
        echo "<script>window.open('checkout.php','_self')</script>";
    }
}
}

?>
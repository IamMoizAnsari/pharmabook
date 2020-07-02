<?php
$email = $_SESSION['customer_email'];
$customer_query  = "select * from customers where customer_email='$email'";
$run_cutomer_query = mysqli_query($con,$customer_query);
$customer = mysqli_fetch_array($run_cutomer_query);
$c_id = $customer['customer_id'];
?>
<div style="align:center;padding:20px">
    <h2>Payment option for you</h2>
    <b>Pay with</b>
    <a href="http://www.praypal.com"><img src="images/logo.jpg" alt="Payment Gatway" style="width:30%;height:30%"></a>
    <h2><a href="order.php?c_id=<?php echo $c_id;?>">Pay Offline</a></h2>
    <b>if you selected "Pay Offline" option then check your Email or Account to find the Invoice Number for your order.</b>
</div>
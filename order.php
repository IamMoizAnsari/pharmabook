<?php
// include function file
include("function/functions.php");
include("includes/DB.php");
// getting customer id
if(isset($_GET['c_id'])){
    $customer_id = $_GET['c_id'];
}
// gettting product price and product Quantity
$ip = getIpAddress();
$total = 0;
$get_pro_id ="select * from cart where ip_add ='$ip'";
$run_get_pro_id = mysqli_query($con,$get_pro_id);
$status = 'pending';
$invoice_no = mt_rand();
$count_pro = mysqli_num_rows($run_get_pro_id);
while($record = mysqli_fetch_array($run_get_pro_id)){
    echo "<h1>inside</h1>";
    $pro_id = $record['p_id'];
    $pro_detail = "select * from products where product_id='$pro_id'";
    $run_pro_detail = mysqli_query($con,$pro_detail);
    while($pro = mysqli_fetch_array($run_pro_detail)){
        $product_price = array($pro['product_price']);
        $values = array_sum($product_price);
        $total += $values;
    }
}
// gettting Quantity form the cart
$get_cart = "select * from cart";
$run_cart = mysqli_query($con,$get_cart);
$get_qty = mysqli_fetch_array($run_cart);
$qty =  $get_qty['qty'];
if($qty==0){
    $qty = 1;
    $sub_total = $total;
}else{
    $qty = $qty;
    $sub_total = $total*$qty;

}
$insert_order = "insert into customers_orders(customer_id,due_ammont,invoice_no, total_products,oreder_date, oreder_status) VALUES ('$customer_id','$sub_total','$invoice_no','$count_pro',current_timestamp(),'$status')";
$run_order = mysqli_query($con,$insert_order);

if($run_order){
    echo "<script>alert('Order successfully submitted, Thanks !')</script>";
    $empty_cart = "delete from cart where ip_add = '$ip'";
    $run_empty_cart = mysqli_query($con,$empty_cart);
    $insert_to_pending_orders= "insert into pending_order (customer_id,invoice_no,product_id,qty,order_status) VALUES ('$customer_id','$invoice_no','$pro_id','$qty','$status')";
    $run_insert_peOrder = mysqli_query($con,$insert_to_pending_orders);
    echo "<script>window.open('customer/my_account.php','_self')</script>";
}

?>
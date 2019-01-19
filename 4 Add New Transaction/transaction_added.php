<html>
<head>
<title>Transaction Added</title>
  <style>
body  {
    background-image: url("../Home Page/home.jpg");
	background-repeat: no-repeat;
    background-size: 1600px 800px;
	  background-color:transparent;
}
</style>
</head
<body>



<?php
$host="localhost";
$user = "a_gupta";  // your user name
$pass = "A00428533";  // your password
$db = "a_gupta";  // the name of your database

$customer_id=$_POST["customer_id"];
$item_id=$_POST["item_id"];
$no_of_items=$_POST["no_of_items"];
$price=substr($item_id, strrpos($item_id, '/' )+2);
$discount_code="";

$link = mysqli_connect($host, $user, $pass);
if (!$link) die("Couldn't connect to MySQL");

mysqli_select_db($link, $db)
	or die("Couldn't open $db: ".mysqli_error($link));

$sum=0;
$result=mysqli_query($link, "SELECT * FROM TRANSACT WHERE c_id=$customer_id AND date_of_trans BETWEEN DATE_ADD(NOW(), INTERVAL -5 YEAR) AND (NOW())");

if (!$result) print("ERROR: ".mysqli_error($link));
else {
    while ($row = mysqli_fetch_array($result)){
    $sum += $row['total_price'];
}
}

if($result){
if ($sum >= 500) $discount_code=5;
if ($sum >= 400 AND $sum <500) $discount_code=4;
if ($sum >= 300 AND $sum <400) $discount_code=3;
if ($sum >= 200 AND $sum <300) $discount_code=2;
if ($sum >= 100 AND $sum <200) $discount_code=1;
if ($sum <100) $discount_code=0;

$total_price=($price*$no_of_items)*(1-(2.5*($discount_code/100)));
$sql_insert="INSERT INTO `TRANSACT` VALUES (NULL,NOW(),$total_price,'$customer_id','$no_of_items')";
if (mysqli_query($link, $sql_insert)) {
    //update Customer discount code status in Customer Table
	$new_discount_code=0;
	$new_total_price=$total_price+$sum;
	$loyalty='REGULAR';
	if ($new_total_price >= 500) {
		$discount_code=5;
		$loyalty='LOYAL';
	}
	if ($new_total_price >= 400 AND $new_total_price <500) $new_discount_code=4;
	if ($new_total_price >= 300 AND $new_total_price <400) $new_discount_code=3;
	if ($new_total_price >= 200 AND $new_total_price <300) $new_discount_code=2;
	if ($new_total_price >= 100 AND $new_total_price <200) $new_discount_code=1;
	if ($new_total_price <100) $new_discount_code=0;
	$sql_update="UPDATE `CUSTOMER` SET `status` = '$loyalty', `discount_code` = '$new_discount_code' WHERE `CUSTOMER`.`_id` = $customer_id";
	if (mysqli_query($link, $sql_update)) {
    print "<h2 align=\"center\" color=\"green\"><b>Successfully Added the New Transaction Details..</b></h2>";
}
} else {
    echo "Error: " . $sql_insert . "<p>" . mysqli_error($link);
}


}else{
	print "Failed<p>";
}

?>


</body>
</html>
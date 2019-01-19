

<html>
<style>
body  {
    background-image: url("../Home Page/home.jpg");
	background-repeat: no-repeat;
    background-size: 1600px 800px;
	  background-color:transparent;
}
</style>
<title>Add new Customer</title>
<form method='post' action="Customer.php" style="border:1px solid #ccc">
  <div class="container">
      <h1>Enter the new Customer Details</h1>
    <hr>
  <TABLE BORDER="1">
  <TR>
		
		<TD>First Name</TD>
			<TD>
				 <input type="text" placeholder="Enter First Name" name="fname" required>
			</TD>
		</TR>
		
		<TD>Last Name</TD>
			<TD>
				<input type="text" placeholder="Enter Last Name" name="lname" required>
			</TD>
		</TR>
		
		<TD>Email</TD>
			<TD>
				<input type="text" placeholder="Enter Email" name="email" required>
			</TD>
		</TR>
		
		<TD>Status</TD>
			<TD>
				    <input id="status" type="text" placeholder="For loyal Customer" name="status" value="REGULAR" readonly required>
			</TD>
		</TR>
  
  </TABLE>
	     
	
	<div class="clearfix">
      <button id="button" type="submit"  name="submit" value="customer">Submit</button>
    </div>
	  </div>
</form>
</html>


<?php
function prtable($link) {
  
  $custId = $_POST['custId'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $status = $_POST['status'];
  $discountCode = $_POST['discountCode'];
  $table = "CUSTOMER";
  if(isset($_POST['submit']))
  {

    if(strlen($fname)==0 )
	{
		print "<p><p>!!! Cannot Add customer as First Name is null  !!!";
	}
	elseif(strlen($lname)==0)
	{
		print "<p><p>!!! Cannot Add customer as Last Name is null   !!!";
	}

   elseif(strlen($email)==0)
    {
		print "<p><p>!!! Cannot Add customer as Email is null  !!!";
	}

   elseif(strlen($status)==0)
    {
		print "<p><p>!!! Cannot Add customer as Status is null !!!";
	}
	

   else
    {
     $result = mysqli_query($link, "SELECT * FROM $table WHERE lname='$_POST[lname]' and fname='$_POST[fname]' ") or die(mysql_error());
	   if(mysqli_num_rows($result) > 0)
	 {		 
         print "<p><p>!!! Already a existing customer with first name and last name. Please try with other irst Name or Last Name !!!";
   }
   else{
	   $query = mysqli_query($link, "INSERT INTO $table (_id,lname,fname,email,status,discount_code) VALUES (NULL,'$lname','$fname','$email','$status',0)");
     $ok = mysqli_query($link, $query);
     //print "Record Successfully inserted in database";
	  $redirect_location = "ViewCustomer.php";
  header("Location:".$redirect_location);
   }
 }

  }

}

define('DB_SERVER', 'dev.cs.smu.ca:3306');
define('DB_USERNAME', 'a_gupta');
define('DB_PASSWORD', 'A00428533');
define('DB_DATABASE', 'a_gupta');
$link = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
if (!$link) die("Couldn't connect to MySQL");

mysqli_select_db($link, DB_DATABASE)
or die("Couldn't open $db: ".mysqli_error($link));

if(isset($_POST['submit']))
{
  prtable($link);
}
mysqli_close($link);

?>
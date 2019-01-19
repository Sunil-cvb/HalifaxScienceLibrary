<html>
  <style>
body  {
    background-image: url("../Home Page/home.jpg");
  background-repeat: no-repeat;
    background-size: 1600px 800px;
    background-color:transparent;
}
</style>
<title>Delete transaction</title>
<form method='post' action="transaction.php" style="border:1px solid #ccc">
  <div class="container">
      <h1>Enter the Transaction ID for which you want to delete the data</h1>
    <hr>

    <label for="id"><b>Transaction ID</b></label>
    <input type="text" placeholder="Enter ID" name="id" required>
	<div class="clearfix">
      <button id="button" type="submit"  name="submit" value="transaction">Submit</button>
    </div>
	  </div>
</form>
</html>


<?php
function prtable($link) {
  
  $id = $_POST['id'];
  $table = "TRANSACT";
  if(isset($_POST['submit']))
  {
    if(strlen($id)==0 )
    {
      print "<p><p>!!! Cannot Register as Id is null  !!!";
    }
    else
    {
     $result = mysqli_query($link, "select * from TRANSACT  WHERE _id='$_POST[id]' and date_of_trans >= CURRENT_DATE - INTERVAL 30 DAY ") or die(mysql_error());
	 if(mysqli_num_rows($result) > 0)
	 {		 
	 if(mysqli_num_rows($result) > 0) {
	$query = mysqli_query($link, "Delete from TRANSACT_ITEMS WHERE t_id='$_POST[id]'")or die(mysql_error());
	 if(mysqli_num_rows($result) > 0) {
	 	$abc = mysqli_query($link, "Delete from  $table  WHERE _id='$_POST[id]'")or die(mysql_error());
	 }
     print "Record Successfully DELETED in database";
	  $redirect_location = "ViewTransaction.php";
  header("Location:".$redirect_location); 
   }
   else{
	      print "Not a valid id";
  
   }
 }
 else{
	 print "Not a valid id or the date of transaction is less then 30 days";
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
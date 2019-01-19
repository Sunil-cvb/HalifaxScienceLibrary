<?php 
include "conf.php";
?>
<!doctype html>
<html>
<head>
    <title>Add new transaction</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="jquery-1.12.0.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        function setPrice(price){
          
          var abc = price.substring(price.lastIndexOf("/")+2,price.length);
          document.getElementById('item_price').value=abc;
          document.getElementById('item_price').disabled=true;
        }
    </script>
      <style>
body  {
    background-image: url("../Home Page/home.jpg");
  background-repeat: no-repeat;
    background-size: 1600px 800px;
    background-color:transparent;
}
</style>
</head>
<body>

<?php
$host="localhost";
$user = "a_gupta";  // your user name
$pass = "A00428533";  // your password
$db = "a_gupta";  // the name of your database

$link = mysqli_connect($host, $user, $pass);
if (!$link) die("Couldn't connect to MySQL");

mysqli_select_db($link, $db)
  or die("Couldn't open $db: ".mysqli_error($link));

$result = mysqli_query($link, "SELECT * FROM `CUSTOMER`");
if (!$result) print("ERROR: ".mysqli_error($link));
else {
    $num_rows = mysqli_num_rows($result);
}
 print "<h2 align=\"center\"><b>Enter the Transaction Details..</b></h2>";
print "<form action=\"transaction_added.php\" method=\"POST\">\n";
print "<table border=1 >\n";

$id_list = "";
while($row2 = mysqli_fetch_array($result))
{
    $id_list = $id_list."<option>$row2[0]</option>";
}
print "<tr><td>Customer ID  :</td><td>";
print "<select name=\"customer_id\">";
echo $id_list;
print "</select>";
print "</td></tr>";

$item_qry = mysqli_query($link, "SELECT * FROM `ITEM`");
$item_list = "";
$item_price = "";
while($row_data = mysqli_fetch_array($item_qry))
{
    $item_list = $item_list."<option>$row_data[0] / $row_data[2]</option>";
}
print "<tr><td>ITEM ID  / (PRICE) :</td><td>";
print "<select name=\"item_id\" onChange=\"setPrice(this.value);\">";
echo $item_list;
print "</select>";
print "</td></tr>";

print "<tr><td>ITEM PRICE  :</td><td>";
print "<input type=\"text\" id=\"item_price\" name=\"item_price\">";
print "</td></tr>";

print "<tr><td>NO OF ITEMS  :</td><td>";
print "<input type=\"text\" id=\"no_of_items\" name=\"no_of_items\">";
print "</td></tr>";

print "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Submit\" /></td></tr>";

print "</table></form>";


?>

</body>
</html>


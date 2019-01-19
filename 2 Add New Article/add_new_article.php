<html>
<head>
<title>Add New Article</title>
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

$link = mysqli_connect($host, $user, $pass);
if (!$link) die("Couldn't connect to MySQL");

mysqli_select_db($link, $db)
	or die("Couldn't open $db: ".mysqli_error($link));

$result = mysqli_query($link, "SELECT * FROM `MAGAZINE`");
if (!$result) print("ERROR: ".mysqli_error($link));
else {
    $num_rows = mysqli_num_rows($result);
}
print "<h2><b>Enter the Article Details.<b><h2>";
print "<form action=\"article_added.php\" method=\"POST\">\n";
print "<table border=1>\n";
print "<tr>";
print "<td>Title  :</td><td><input type=\"text\" name=\"title\" /></td></tr>";

$magazine_list = "";
while($row2 = mysqli_fetch_array($result))
{
    $magazine_list = $magazine_list."<option>$row2[0]</option>";
}
print "<tr><td>Magazine ID  :</td><td>";
print "<select name=\"magazine_id\">";
echo $magazine_list;
print "</select>";
print "</td></tr>";

print "<tr><td>Volume Number  :</td>";
print "<td><input type=\"text\" name=\"volume_number\" />";
print "</td></tr>";

print "<tr><td>Page Number  :</td>";
print "<td><input type=\"text\" name=\"page_num\" />";
print "</td></tr>";

$author_qry = mysqli_query($link, "SELECT * FROM `AUTHOR`");
$author_list = "";
while($row_data = mysqli_fetch_array($author_qry))
{
    $author_list = $author_list."<option>$row_data[0] $row_data[2] $row_data[1]</option>";
}
print "<tr><td>Authors  :</td><td>";
print "<select name=\"author_name\">";
echo $author_list;
print "</select>";
print "</td></tr>";


print "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Submit\" /></td></tr>";

print "</table></form>";


?>


</body>
</html>
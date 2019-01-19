<html>
<head>
<title>
print_table_data.php
</title>
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

$table = $_POST["table_name"];
print "<h2>Table name ::: \"$table\"<h2><p>";

function prtable($table) {
	print "<table border=1>\n";
	while ($a_row = mysqli_fetch_row($table)) {
		print "<tr>";
		foreach ($a_row as $field) print "<td>$field</td>";
		print "</tr>";
	}
	print "</table>";
}


$link = mysqli_connect($host, $user, $pass);
if (!$link) die("Couldn't connect to MySQL");

mysqli_select_db($link, $db)
	or die("Couldn't open $db: ".mysqli_error($link));

$result = mysqli_query($link, "select * from $table");

if (!$result) print("ERROR: ".mysqli_error($link));
else {
    $num_rows = mysqli_num_rows($result);
    print "There are $num_rows rows in the table<p>";
    prtable($result);
}

mysqli_close($link);

?>

<p>
<a href="ShowTables.php"> back </a><br>

</body>
</html>



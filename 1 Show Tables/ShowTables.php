<html>
<head>
<title>Show All Tables</title>
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

$result = mysqli_query($link, "SELECT table_name FROM information_schema.tables WHERE table_schema ='a_gupta' AND table_name NOT IN ('SignUp','history','person','transaction') ");

if (!$result) print("ERROR: ".mysqli_error($link));
else {
    $num_rows = mysqli_num_rows($result);
    
    print "<h3>Total number of tables in Halifax Science Library ::: \"$num_rows\"</h3><p>";
    printTable($result);
}

function printTable($table) {
	print "Select any Table to view the Table Data";
	print "<table border=1 >\n";
	while ($a_row = mysqli_fetch_row($table)) {
		print "<tr>";
		foreach ($a_row as $field) print "<td><form method=\"POST\" action=\"print_table_data.php\"><input type=\"hidden\" name=\"table_name\" value=\"$field\"/><input type=\"submit\" value=\"$field\"/></form></td>";
		print "</tr>";
	}
	print "</table>";
}









?>


</body>
</html>
<html>
<head>
<title>New Article Added</title>
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

$title=$_POST["title"];
$magazine_id=$_POST["magazine_id"];
$volume_number=$_POST["volume_number"];
$page_num=$_POST["page_num"];
$author_name=$_POST["author_name"];
$author_id=preg_replace('/[^0-9]/', '', $author_name);


$link = mysqli_connect($host, $user, $pass);
if (!$link) die("Couldn't connect to MySQL");

mysqli_select_db($link, $db)
	or die("Couldn't open $db: ".mysqli_error($link));

$sql_insert="INSERT INTO `ARTICLES` VALUES (NULL,'$title','$page_num','$magazine_id','$author_id')";
$sql_update="UPDATE MAGAZINE SET volume='11', no_of_articles=no_of_articles+1 WHERE _id='$magazine_id'";

if (mysqli_query($link, $sql_insert)) {
   if (mysqli_query($link, $sql_update)) {
    print "<h2 align=\"center\"><b>Successfully Created the New Article</h2></b><p>";
} else {
    echo "Error: " . $sql_update . "<p>" . mysqli_error($link) . "<p>";
}
} else {
    echo "Error: " . $sql_insert . "<p>" . mysqli_error($link);
}




?>


</body>
</html>
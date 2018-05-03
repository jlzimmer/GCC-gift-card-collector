<?php
addcard.php
$host="localhost"; // Host name
$username="ec2user"; // Mysql username
$password="Mizzou_CS3380_SP18"; // Mysql password
$db_name="3380_Final"; // Database name
//not sure on this one
$tbl_name="test_mysql"; // Table name

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

// Get values from form
$location=$_POST['location'];
$balance=$_POST['balance'];
$serial=$_POST['serial'];
$expiration=$_POST['expiration'];

// Insert data into mysql
$sql="INSERT INTO $tbl_name(location, balance, serial, expiration)VALUES('$location', '$balance', '$serial', '$expiration')";
$result=mysql_query($sql);

// if successfully insert data into database, displays message "Successful".
if($result){
echo "Successful";
echo "<BR>";
    //Change this to whatever homepage is
echo "<a href='index.php'>Back to main page</a>";
}
else {
echo "ERROR";
}
?>

<?php
// close connection
mysql_close();
?>
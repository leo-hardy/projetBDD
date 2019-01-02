<?php

$bdd = 'livres'; 

// connect to the MySQL server
$conn = new mysqli('localhost', 'root', '');

// check connection
if (mysqli_connect_errno()) {
	exit('Connect failed: '. mysqli_connect_error());
}

// sql query with CREATE DATABASE
$sql = "CREATE DATABASE $bdd DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$sql2 = "DROP DATABASE $bdd";

if ($conn->query($sql2) == TRUE){
	echo 'Database with the same name removed <br/>'."\n";
}

// Performs the $sql query on the server to create the database
if ($conn->query($sql) === TRUE) {
	echo 'Database successfully created<br/>'."\n";
}
else {
	echo 'Error: '. $conn->error;
}

$conn->close();
?>
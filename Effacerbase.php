<?php

$bdd = 'livres'; 

// connect to the MySQL server
$conn = new mysqli('localhost', 'root', '');

// check connection
if (mysqli_connect_errno()) {
	exit('Connect failed: '. mysqli_connect_error());
}

// sql query with CREATE DATABASE
$sql = "DROP DATABASE $bdd";


// Performs the $sql query on the server to create the database
if ($conn->query($sql) == TRUE) {
	echo 'Database successfully erased<br/>'."\n";
}
else {
	echo 'Error: '. $conn->error;
}

$conn->close();


?>
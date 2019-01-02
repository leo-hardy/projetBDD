﻿<?php

$bdd = 'livres'; 

// connect to the MySQL server
$conn = new mysqli('localhost', 'root', '');

// check connection
if (mysqli_connect_errno()) {
	exit('Connect failed: '. mysqli_connect_error());
}

// sql query with CREATE DATABASE
$sql = "CREATE DATABASE $bdd DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";

//si on veut supprimer la bdd quand le nom est deja pris
$sql2 = "DROP DATABASE $bdd";
if ($conn->query($sql2) == TRUE){
	echo 'Database with the same name removed <br/>'."\n";
}


// Performs the $sql query on the server to create the database
if ($conn->query($sql) == TRUE) {
	echo 'Database successfully created<br/>'."\n";
}
else {
	echo 'Error: '. $conn->error;
}



//création des tables
$sql1 = "CREATE TABLE IF NOT EXISTS `livres`.`TABLE 1` (`COL 1` varchar(71)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$sql2 = "CREATE TABLE IF NOT EXISTS `livres`.`TABLE 2` (`COL 1` varchar(20)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci"; 
$sql3 = "CREATE TABLE IF NOT EXISTS `livres`.`TABLE 3` (`COL 1` varchar(20)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$sql4 = "CREATE TABLE IF NOT EXISTS `livres`.`TABLE 4` (`COL 1` varchar(36)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$sql5 = "CREATE TABLE IF NOT EXISTS `livres`.`TABLE 5` (`COL 1` varchar(65)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$rename1 = "RENAME TABLE `livres`.`table 1`\n"."TO `livres`.`auteur`";
$rename2 = "RENAME TABLE `livres`.`table 2`\n"."TO `livres`.`ecrit_par`";
$rename3 = "RENAME TABLE `livres`.`table 3`\n"."TO `livres`.`edite_par`";
$rename4 = "RENAME TABLE `livres`.`table 4`\n"."TO `livres`.`editeur`";
$rename5 = "RENAME TABLE `livres`.`table 5`\n"."TO `livres`.`livre`";
$conn->query($sql1); $conn->query($rename1);
$conn->query($sql2); $conn->query($rename2);
$conn->query($sql3); $conn->query($rename3);
$conn->query($sql4); $conn->query($rename4);
$conn->query($sql5); $conn->query($rename5);

//remplissage des tables
$info1 = "INSERT INTO `livres`.`auteur` (`COL 1`) VALUES ('id_auteur ;nom_auteur ;pre_nom_auteur ;naissance ;deces ;nationalite_ '), ('1;Nothomb ;Ame_lie ;09/07/1966;- ;belge '), ('2;Houellebecq ;Michel ;26/02/1956;- ;franc_ais ')";
$info2 = "INSERT INTO `livres`.`ecrit_par` (`COL 1`) VALUES ('id_auteur ;id_livre '), ('2;2'), ('3;3'), ('3;4'), ('3;1')";
$info3 = "INSERT INTO `livres`.`edite_par` (`COL 1`) VALUES ('id_editeur ;id_livre '), ('1;1'), ('2;3'), ('3;2'), ('5;4')";
$info4 = "INSERT INTO `livres`.`editeur` (`COL 1`) VALUES ('id_editeur ;nom_e_diteur ;site_web '), ('1;J\'ai Lu ;www.jailu.com '), ('2;Gallimard ;www.gallimard.fr '), ('3;LGF ;- '), ('4;Albin Michel ;www.albin-michel.fr ')";
$info5 = " INSERT INTO `livres`.`livre` (`COL 1`) VALUES ('id_livre ;titre_livre ;genre ;parution ;nature ;langue '), ('1;Le cycle des robots ;science-__ction ;1950;nouvelle ;anglais '), ('2;La possibilite d\'une ile ;sentimental ;2005;roman ;franc_ais '), ('3;Fondation ;science-__ction ;1942;roman ;anglais ')" ;
$conn->query($info1);mysqli_query($conn,$info2);$conn->query($info3);$conn->query($info4);$conn->query($info5);


 



$conn->close();

?>
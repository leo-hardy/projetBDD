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
$sql1 = "CREATE TABLE IF NOT EXISTS `livres`.`TABLE 1` (`id_auteur` varchar(10), `nom_auteur` varchar(40), `prenom_auteur` varchar(40), `naissance` varchar(10), `deces` varchar(10), `nationnalite`	 varchar(20)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$sql2 = "CREATE TABLE IF NOT EXISTS `livres`.`TABLE 2` (`id_auteur` varchar(10), `id_livre` varchar(10)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci"; 
$sql3 = "CREATE TABLE IF NOT EXISTS `livres`.`TABLE 3` (`id_editeur` varchar(10), `id_livre` varchar(10)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$sql4 = "CREATE TABLE IF NOT EXISTS `livres`.`TABLE 4` (`id_editeur` varchar(10), `nom_editeur` varchar(40), `site_web` varchar(100)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$sql5 = "CREATE TABLE IF NOT EXISTS `livres`.`TABLE 5` (`id_livre` varchar(10), `titre_livre` varchar(40), `genre` varchar(40), `parution` varchar(10), `nature` varchar(40), `langue` varchar(20)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
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
$info1 = "INSERT INTO `livres`.`auteur` (`id_auteur`, `nom_auteur`, `prenom_auteur`, `naissance`, `deces`, `nationnalite`) VALUES ('1','Nothomb','Ame_lie','09/07/1966','-','belge'), ('2','Houellebecq','Michel','26/02/1956','-','franc_ais')";
$info2 = "INSERT INTO `livres`.`ecrit_par` (`id_auteur`,`id_livre`) VALUES ('2','2'), ('3','3'), ('3','4'), ('3','1')";
$info3 = "INSERT INTO `livres`.`edite_par` (`id_editeur`,`id_livre`) VALUES ('1','1'), ('2','3'), ('3','2'), ('5','4')";
$info4 = "INSERT INTO `livres`.`editeur` (`id_editeur`,`nom_editeur`,`site_web`) VALUES ('1','J\'ai Lu','www.jailu.com '), ('2','Gallimard','www.gallimard.fr'), ('3','LGF','-'), ('4','Albin Michel','www.albin-michel.fr')";
$info5 = " INSERT INTO `livres`.`livre` (`id_livre`,`titre_livre`,`genre`,`parution`,`nature`,`langue`) VALUES ('1','Le cycle des robots','science-__ction','1950','nouvelle','anglais'), ('2','La possibilite d\'une ile','sentimental','2005','roman','franc_ais'), ('3','Fondation','science-__ction','1942','roman','anglais')" ;
$conn->query($info1);mysqli_query($conn,$info2);$conn->query($info3);$conn->query($info4);$conn->query($info5);


 



$conn->close();

?>
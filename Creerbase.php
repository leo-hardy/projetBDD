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
$sql1 = "CREATE TABLE IF NOT EXISTS `livres`.`TABLE 1` (`id_auteur` varchar(10), `nom_auteur` varchar(40), `prenom_auteur` varchar(40), `naissance` varchar(10), `deces` varchar(10), `nationalite` varchar(20)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$sql2 = "CREATE TABLE IF NOT EXISTS `livres`.`TABLE 2` (`id_auteur` varchar(10), `id_livre` varchar(10)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci"; 
$sql3 = "CREATE TABLE IF NOT EXISTS `livres`.`TABLE 3` (`id_editeur` varchar(10), `id_livre` varchar(10)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$sql4 = "CREATE TABLE IF NOT EXISTS `livres`.`TABLE 4` (`id_editeur` varchar(10), `nom_editeur` varchar(40), `site_web` varchar(100)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$sql5 = "CREATE TABLE IF NOT EXISTS `livres`.`TABLE 5` (`id_livre` varchar(10), `titre_livre` varchar(40), `genre` varchar(40), `parution` varchar(10), `nature` varchar(40), `langue` varchar(20)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$rename1 = "RENAME TABLE `livres`.`TABLE 1`\n"."TO `livres`.`auteur`";
$rename2 = "RENAME TABLE `livres`.`TABLE 2`\n"."TO `livres`.`ecrit_par`";
$rename3 = "RENAME TABLE `livres`.`TABLE 3`\n"."TO `livres`.`edite_par`";
$rename4 = "RENAME TABLE `livres`.`TABLE 4`\n"."TO `livres`.`editeur`";
$rename5 = "RENAME TABLE `livres`.`TABLE 5`\n"."TO `livres`.`livre`";
$conn->query($sql1); $conn->query($rename1);
$conn->query($sql2); $conn->query($rename2);
$conn->query($sql3); $conn->query($rename3);
$conn->query($sql4); $conn->query($rename4);
$conn->query($sql5); $conn->query($rename5);

//remplissage des tables
$arrayCSV = [0 => "Auteur.csv", 1 => "Ecrit_par.csv", 2 => "Edite_par.csv", 3 => "Editeur.csv", 4 => "Livre.csv"];
$arrayNames = ["Auteur.csv" => "auteur", "Ecrit_par.csv" => "ecrit_par", "Edite_par.csv" => "edite_par",
    "Editeur.csv" => "editeur", "Livre.csv" => "livre"];

$arrayAuteur = [0 => "id_auteur", 1 => "nom_auteur", 2 => "prenom_auteur",
    3 => "naissance", 4 => "deces", 5 => "nationalite"];
$arrayEditeur = [0 => "id_editeur", 1 => "nom_editeur", 2 => "site_web"];
$arrayEcritPar = [0 => "id_auteur", 1 => "id_livre"];
$arrayEditePar = [0 => "id_editeur", 1 => "id_livre"];
$arrayLivre = [0 => "id_livre", 1 => "titre_livre", 2 => "genre", 3 => "parution",
    4 => "nature", 5 => "langue"];

$arrayLongueurs = ["auteur" => 6, "editeur" => 3, "ecrit_par" => 2, "edite_par" => 2, "livre" => 6];

$arrayArray = ["auteur" => $arrayAuteur, "livre" => $arrayLivre, "ecrit_par" => $arrayEcritPar,
    "edite_par" => $arrayEditePar, "editeur" => $arrayEditeur];

for ($i = 0 ; $i < 5 ; $i++){
    if (($handle = fopen($arrayCSV[$i], "r")) !== FALSE) {
        $data = fgetcsv($handle, 1000, ";");
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $addInfo = "INSERT INTO `livres`.`".$arrayNames[$arrayCSV[$i]]."` (";
            for ($j = 0 ; $j < $arrayLongueurs[$arrayNames[$arrayCSV[$i]]] ; $j++){
                $addInfo = $addInfo."`".$arrayArray[$arrayNames[$arrayCSV[$i]]][$j]."`";
                if ($j < $arrayLongueurs[$arrayNames[$arrayCSV[$i]]] - 1){
                    $addInfo = $addInfo.",";
                } else {
                    $addInfo = $addInfo.") VALUES (";
                }
            }
            for ($c = 0 ; $c < $arrayLongueurs[$arrayNames[$arrayCSV[$i]]] ; $c++) {
                $withoutUnprotectedSpaces = preg_replace("/'/", "\'", $data[$c]);
                $addInfo = $addInfo."'".$withoutUnprotectedSpaces."'";
                if ($c < $arrayLongueurs[$arrayNames[$arrayCSV[$i]]] - 1){
                    $addInfo = $addInfo.",";
                } else {
                    $addInfo = $addInfo.")";
                }
            }
            $conn->query($addInfo);
            $addInfo = null;
        }
        fclose($handle);
    }
}








$conn->close();

?>
<html>
    <head>

<?php

if (!isset($_POST["requete"])){
    echo "Problème : page accédée de manière interdite";
}

?>

        <title>
            Résultat de la requête
        </title>


    </head>

    <body>

    <h1>
        Résultat de la requête

    </h1>
    <br>

 
<?php

    $bdd = 'livres'; 

    // connect to the MySQL server
    $conn = new mysqli('localhost', 'root', '');

    // check connection
    if (mysqli_connect_errno()) {
        exit('Connect failed: '. mysqli_connect_error());
    }

    $sql1 = "SELECT titre_livre,genre,parution,nature,langue FROM `livres`.`livre`";
    $sql2 = "SELECT nom_auteur, prenom_auteur, naissance, deces, nationnalite FROM `livres`.`auteur`";
    $sql3 = "SELECT nom_editeur, site_web FROM `livres`.`editeur`";
    $sql4 = "SELECT titre_livre,nom_editeur 
            FROM `livres`.`livre` JOIN `livres`.`edite_par` ON `livre`.`id_livre` = `edite_par`.`id_livre` 
            JOIN `livres`.`editeur` ON `edite_par`.`id_editeur` = `editeur`.`id_editeur` " ;
    $sql5 = "SELECT titre_livre,nom_editeur, nom_auteur
            FROM `livres`.`livre` JOIN `livres`.`edite_par` ON `livre`.`id_livre` = `edite_par`.`id_livre` 
            JOIN `livres`.`editeur` ON `edite_par`.`id_editeur` = `editeur`.`id_editeur`
            JOIN `livres`.`ecrit_par` ON ecrit_par.id_livre = livre.id_livre
            JOIN `livres`.`auteur` ON auteur.id_auteur = ecrit_par.id_auteur ";
    
    $sql6 ="SELECT titre_livre FROM `livres`.`auteur`JOIN `livres`.`ecrit_par` ON ecrit_par.id_auteur = auteur.id_auteur
            JOIN `livres`.`livre` ON livre.id_livre = ecrit_par.id_livre 
            WHERE nom_auteur = 'Asimov' AND prenom_auteur = 'Isaac' " ;
    /*
    $sql7 = ;
    $sql8 = ;
    $sql9 = ;
    $sql10 = ;
    $sql11 = ;
    $sql12 = ;
    $sql13 = ;
    $sql14 = ;
    $sql15 = ;
    $sql16 = ;
    $sql17 = ;
    $sql18 = ;
    $sql19 = ;
    */
    $arraysql = array("r1" => $sql1, "r2"=>$sql2, "r3"=>$sql3, "r4"=>$sql4, "r5"=>$sql5, "r6"=>$sql6) ;


    if (isset($arraysql[$_POST["requete"]])){
        $sql = $arraysql[$_POST["requete"]] ;
        $req = mysqli_query($conn,$sql) or die('Erreur SQL !<br />'.$sql.'<br/>'.mysqli_error($conn));
        while($row = mysqli_fetch_array($req)){
            for($i=0; $i<sizeof($row)/2;$i++){
                echo $row[$i]." ";
            }
            echo "<br>";
        }
    } else {
        echo "Requête non traitée";
    }


    $conn->close();

?>
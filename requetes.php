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

    <body style="background-color:#078c90;"> 

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
    $sql2 = "SELECT nom_auteur, prenom_auteur, naissance, deces, nationalite FROM `livres`.`auteur`";
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
    
    $sql7 = " SELECT DISTINCT nom_auteur FROM `livres`.`auteur` JOIN `livres`.`ecrit_par` ON auteur.id_auteur = ecrit_par.id_auteur
            JOIN `livres`.`livre` ON livre.id_livre = ecrit_par.id_livre
            JOIN `livres`.`edite_par` ON livre.id_livre = edite_par.id_livre
            JOIN `livres`.`editeur` ON editeur.id_editeur = edite_par.id_editeur
            WHERE nom_editeur =  \"J\'ai Lu\" " ;

    $sql8 = "SELECT titre_livre FROM `livres`.`auteur`JOIN `livres`.`ecrit_par` ON ecrit_par.id_auteur = auteur.id_auteur
            JOIN `livres`.`livre` ON livre.id_livre = ecrit_par.id_livre 
            WHERE nom_auteur = 'Nothomb' AND prenom_auteur = 'Amélie' " ;

    $sql9 = "SELECT nom_editeur, count(*) FROM `livres`.`livre` JOIN `livres`.`edite_par` ON livre.id_livre = edite_par.id_livre 
            JOIN `livres`.`editeur` ON edite_par.id_editeur = editeur.id_editeur
            GROUP BY editeur.id_editeur ";

    $sql10 = "SELECT titre_livre FROM `livres`.`livre` JOIN `livres`.`ecrit_par` ON livre.id_livre = ecrit_par.id_livre 
            JOIN `livres`.`auteur` ON ecrit_par.id_auteur = auteur.id_auteur
            WHERE nom_auteur != 'Asimov' AND genre = 'science-fiction' ";

    $sql11 = "";

    $sql12 = "SELECT titre_livre FROM `livres`.`auteur` JOIN `livres`.`ecrit_par` ON auteur.id_auteur = ecrit_par.id_auteur
    JOIN `livres`.`livre` ON livre.id_livre = ecrit_par.id_livre
    JOIN `livres`.`edite_par` ON livre.id_livre = edite_par.id_livre
    JOIN `livres`.`editeur` ON editeur.id_editeur = edite_par.id_editeur 
    WHERE nom_auteur = 'Asimov' AND prenom_auteur = 'Isaac' AND genre='science-fiction' AND nom_editeur != 'Gallimard' " ;

    
    $sql13 = "SELECT titre_livre FROM `livres`.`auteur` JOIN `livres`.`ecrit_par` ON auteur.id_auteur = ecrit_par.id_auteur
                JOIN `livres`.`livre` ON ecrit_par.id_livre = livre.id_livre
                WHERE deces != '-' ";

    $sql14 ="" ; 

    $sql15 = " SELECT nom_auteur, count(*) AS nombre_livres FROM `livres`.`auteur` JOIN `livres`.`ecrit_par` ON auteur.id_auteur = ecrit_par.id_auteur
            JOIN `livres`.`livre` ON livre.id_livre = ecrit_par.id_livre 
            GROUP BY auteur.id_auteur
            HAVING count(*) >1 ";

    $sql16 = "SELECT parution, titre_livre, nom_editeur FROM `livres`.`auteur` JOIN `livres`.`ecrit_par` ON auteur.id_auteur = ecrit_par.id_auteur
                JOIN `livres`.`livre` ON livre.id_livre = ecrit_par.id_livre
                JOIN `livres`.`edite_par` ON livre.id_livre = edite_par.id_livre
                JOIN `livres`.`editeur` ON editeur.id_editeur = edite_par.id_editeur 
                HAVING nom_editeur = 'Gallimard' " ;

    $sql17 = "SELECT nom_auteur, prenom_auteur, count(*) AS nb_livre FROM `livres`.`auteur` JOIN `livres`.`ecrit_par` ON auteur.id_auteur = ecrit_par.id_auteur
             JOIN `livres`.`livre` ON livre.id_livre = ecrit_par.id_livre
             GROUP BY auteur.id_auteur";

    $sql18 = "SELECT titre_livre, nom_auteur, langue, nationalite AS nationalite_auteur FROM `livres`.`auteur` JOIN `livres`.`ecrit_par` ON auteur.id_auteur = ecrit_par.id_auteur
            JOIN `livres`.`livre` ON livre.id_livre = ecrit_par.id_livre
            WHERE langue = 'anglais' AND nationalite NOT IN('anglais','americain') ";

    $sql19 = "SELECT nom_auteur, count(*) AS nombre_sf FROM `livres`.`auteur` JOIN `livres`.`ecrit_par` ON auteur.id_auteur = ecrit_par.id_auteur
            JOIN `livres`.`livre` ON livre.id_livre = ecrit_par.id_livre 
            WHERE genre = 'science-fiction'
            HAVING count(*) > 1 " ;

    $arraysql = array("r1" => $sql1, "r2"=>$sql2, "r3"=>$sql3, "r4"=>$sql4, "r5"=>$sql5, "r6"=>$sql6, "r7"=>$sql7, "r8"=>$sql8, "r9"=>$sql9,
            "r10"=>$sql10, "r11"=>$sql11, "r12"=>$sql12, "r13"=>$sql13, "r14"=>$sql14, "r15"=>$sql15, "r16"=>$sql16, "r17"=>$sql17,
            "r18"=>$sql18, "r19"=>$sql19) ;


    if (isset($arraysql[$_POST["requete"]])){
        $sql = $arraysql[$_POST["requete"]] ;
        $req = mysqli_query($conn, $sql) or die('Erreur SQL !<br />'.$sql.'<br/>'.mysqli_error($conn));
        while($row = mysqli_fetch_array($req)){
            for($i = 0 ; $i < sizeof($row)/2 ; $i++){
                echo $row[$i]." ";
            }
            echo "<br>";
        }
    } else {
        echo "Requête non traitée";
    }


    $conn->close();

?>
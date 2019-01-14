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
    /*/$sql2 = ;
    $sql3 = ;
    $sql4 = ;
    $sql5 = ;
    $sql6 = ;
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
    $arraysql = array("r1" => $sql1) ;

    $sql = $arraysql[$_POST["requete"]] ; 
    if (isset($sql)){
        $req = mysqli_query($conn,$sql) or die('Erreur SQL !<br />'.$sql.'<br/>'.mysqli_error($conn));
        $data = mysqli_fetch_array($req) ;
        mysqli_free_result ($req);
        for($i=0 ; $i< sizeof($data) ; $i++){
            printf ("%s\n", $data[$i]);
        }
    }


    $conn->close();

?>
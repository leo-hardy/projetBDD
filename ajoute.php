<?php
$conn = new mysqli('localhost', 'root', '');

$arrayLongueurs = ["auteur" => 6, "editeur" => 3, "ecrit_par" => 2, "edite_par" => 2, "livre" => 6];

$arrayAuteur = [0 => "id_auteur", 1 => "nom_auteur", 2 => "pre_nom_auteur",
    3 => "naissance", 4 => "deces", 5 => "nationalite"];
$arrayEditeur = [0 => "id_editeur", 1 => "nom_e_diteur", 2 => "site_web"];
$arrayEcritPar = [0 => "id_auteur", 1=> "id_livre"];
$arrayEditePar = [0 => "id_editeur", 1 => "id_livre"];
$arrayLivre = [0 => "id_livre", 1 => "titre_livre", 2 => "genre", 3 => "parution",
    4 => "nature", 5 => "langue"];

$arrayArray = ["auteur" => $arrayAuteur, "livre" => $arrayLivre, "ecrit_par" => $arrayEcritPar,
    "edite_par" => $arrayEditePar, "editeur" => $arrayEditeur];

$inser = "INSERT INTO `livres`."."`".$_POST["tableChoisie"]."` VALUES (";
for ($i = 0 ; $i < $arrayLongueurs[$_POST["tableChoisie"]] ; $i++){
    $inser = $inser."'";
    $inser = $inser.$_POST[$arrayArray[$_POST["tableChoisie"]][$i]];
    $inser = $inser."'";
    if ($i < $arrayLongueurs[$_POST["tableChoisie"]] - 1){
        $inser = $inser.",";
    } else {
        $inser = $inser.")";
    }
}
$conn->query($inser);
echo "Insertion effectuée.<br>";
$conn->close();
?>

<form>
    <input type='button' value='Retour page principale' onclick=window.location.href='Modifbdd.html'>
</form>

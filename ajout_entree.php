<html>
    <head>

<?php

if (!isset($_POST["tableChoisie"])){
    echo "Problème : page accédée de manière interdite";
}

?>

        <title>
            Insertion d'enregistrement
        </title>


    </head>

    <body>

    <h1>
        Insertion d'enregistrement dans
        <i>
        <?php
        echo "livres.";
        echo $_POST["tableChoisie"];
        ?>
        </i>
    </h1>
    <br>

    <i>
        Veuillez remplir tous les champs.
    </i>

    <form>
        <fieldset>
            <legend>Champs</legend>
            <?php
            $arrayAuteur = [0 => "id_auteur", 1 => "nom_auteur", 2 => "pre_nom_auteur",
                3 => "naissance", 4 => "deces", 5 => "nationalite"];
            $arrayEditeur = [0 => "id_editeur", 1 => "nom_e_diteur", 2 => "site_web"];
            $arrayEcritPar = [0 => "id_auteur", 1=> "id_livre"];
            $arrayEditePar = [0 => "id_editeur", 1 => "id_livre"];
            $arrayLivre = [0 => "id_livre", 1 => "titre_livre", 2 => "genre", 3 => "parution",
                4 => "nature", 5 => "langue"];

            if ($_POST["tableChoisie"] == "livre"){
                for ($i = 0 ; $i < 6 ; $i++){
                    echo $arrayLivre[$i]." : <br>";
                    echo "<input type='text' name=$arrayLivre[$i]>";
                    echo "<br><br>";
                }
            } elseif ($_POST["tableChoisie"] == "auteur"){
                for ($i = 0 ; $i < 6 ; $i++){
                    echo $arrayAuteur[$i]." : <br>";
                    echo "<input type='text' name=$arrayAuteur[$i]>";
                    echo "<br><br>";
                }
            } elseif ($_POST["tableChoisie"] == "ecrit_par"){
                for ($i = 0 ; $i < 2 ; $i++){
                    echo $arrayEcritPar[$i]." : <br>";
                    echo "<input type='text' name=$arrayEcritPar[$i]>";
                    echo "<br><br>";
                }
            } elseif ($_POST["tableChoisie"] == "edite_par"){
                for ($i = 0 ; $i < 2 ; $i++){
                    echo $arrayEditePar[$i]." : <br>";
                    echo "<input type='text' name=$arrayEditePar[$i]>";
                    echo "<br><br>";
                }
            } elseif ($_POST["tableChoisie"] == "editeur"){
                for ($i = 0 ; $i < 3 ; $i++){
                    echo $arrayEditeur[$i]." : <br>";
                    echo "<input type='text' name=$arrayEditeur[$i]>";
                    echo "<br><br>";
                }
            } else {
                echo "Table inexistante";
            }
            ?>
            <input type="submit" value="Envoyer">
        </fieldset>
    </form>

    </body>
</html>

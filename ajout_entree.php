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

    <body style="background-color:#078c90;">

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
<?php
    echo "<form action='ajoute.php' method='post'>
        <fieldset>
            <legend>Champs</legend>";

            $arrayLongueurs = ["auteur" => 6, "editeur" => 3, "ecrit_par" => 2, "edite_par" => 2, "livre" => 6];

            $arrayAuteur = [0 => "id_auteur", 1 => "nom_auteur", 2 => "prenom_auteur",
                3 => "naissance", 4 => "deces", 5 => "nationalite"];
            $arrayEditeur = [0 => "id_editeur", 1 => "nom_editeur", 2 => "site_web"];
            $arrayEcritPar = [0 => "id_auteur", 1=> "id_livre"];
            $arrayEditePar = [0 => "id_editeur", 1 => "id_livre"];
            $arrayLivre = [0 => "id_livre", 1 => "titre_livre", 2 => "genre", 3 => "parution",
                4 => "nature", 5 => "langue"];

            $arrayArray = ["auteur" => $arrayAuteur, "livre" => $arrayLivre, "ecrit_par" => $arrayEcritPar,
                "edite_par" => $arrayEditePar, "editeur" => $arrayEditeur];

            if (isset($arrayArray[$_POST["tableChoisie"]])){
                for ($i = 0 ; $i < $arrayLongueurs[$_POST["tableChoisie"]] ; $i++) {
                    echo $arrayArray[$_POST["tableChoisie"]][$i] . " : ";
                    echo '<input type="text" name='.$arrayArray[$_POST["tableChoisie"]][$i].'>';
                    echo "<br><br>";
                }
                $table = $_POST["tableChoisie"];
                echo "<br><br>Table choisie (NE PAS MODIFIER) : ";
                echo '<input type="text" name="tableChoisie" value='.$table.'>';
                echo "<br><br>";
            } else {
                echo "Table inexistante";
            }
            echo "<input type='submit' value='Envoyer'/>
        </fieldset>
    </form>

    <br><br>";

            ?>
    </body>

    <form id="form2" name="form2" method="post" action="ajout_entree.php">
        <label>Nouvelle insertion : choix de la table : </label>
        <select name="tableChoisie">
            <option value="livre">Livre</option>
            <option value="ecrit_par">Ecrit_par</option>
            <option value="edite_par">Edité_par</option>
            <option value="editeur">Editeur</option>
            <option value="auteur">Auteur</option>
        </select>
        <br/>
        <input type="submit">
    </form>

    <p>&nbsp;</p>

    <form id="form3" name="form3" method="post" action="modif_entree.php">
        <label>Nouvelle modification : choix de la table : </label>
        <select name="tableChoisie">
            <option value="livre">Livre</option>
            <option value="ecrit_par">Ecrit_par</option>
            <option value="edite_par">Edité_par</option>
            <option value="editeur">Editeur</option>
            <option value="auteur">Auteur</option>
        </select>
        <br/>
        <input type="submit">
    </form>

    <p>&nbsp;</p>

    <form>
        <input type='button' value='Retour page principale' onclick=window.location.href='Modifbdd.html'>
    </form>
</html>

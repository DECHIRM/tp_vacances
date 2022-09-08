<?php 
    session_start();
    require_once 'config.php'; // ajout connexion bdd 
   // si la session existe pas soit si l'on est pas connecté on redirige
    if(!isset($_SESSION['user'])){
        header('Location:index.php');
        die();
    }
    // On récupere les données de l'utilisateur
    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();

?>

<!doctype html>
<html lang="fr">
  <head>
    <title>Ajouter !</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
      
       <div class="text-center">
            <h1 >Bonjour <?php echo $data['pseudo']; ?> ! <a href="deconnexion.php" >Déconnexion</a></h1>
            <hr />
            <a href="home.php" >Afficher recette</a>
            <a href="add.php" >Ajouter recette</a>
            <a href="del.php" >Suprimer recette</a>
        </div>    

        <select name="idFilm" id="pet-select">
        <?php
             $reponses = $bdd->query('SELECT * FROM Film');
             while ($donnees = $reponses->fetch())
             {
                 echo '<option  value="'.$donnees['id']  .'">'. $donnees['Nom'] . '</option>';
             } 
        ?>

    </select>
        <label for="name">Id du film </label>   
    </div> 
    <div class="form-example">
        <label for="email">Note </label>
        <input type="text" name="Note" id="note" required>
    </div>
    <div class="form-example">
        <input type="submit" value="noté !" name="btnNote">
    </div>
    </form>

    <?php
    if (isset($_POST["btnRecette"])) 
    {
        $Titre = $_POST["Titre"];
        $nomRecette = $_POST["nomRecette"];
        $req = "insert into Note (`commentaire`,`recette`) values ('".$idFilm."','".$Note."')";
        echo "<p>".$req."</p>";
        $reponses = $bdd->query($req);
    } 

    $Req = $bdd->query("SELECT * FROM recette");
    ?>
        <table>
            <tr>
                <th>Titre</th>
            </tr>
            <?php
            while ($tab = $Req->fetch()) {
            ?>
                <tr>
                    <td><?php echo $tab["Titre"]; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
  </body>
</html>
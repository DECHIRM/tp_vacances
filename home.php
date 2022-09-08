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
    <title>A table !</title>
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

    <h1>Affichage des recettes</h1>
    <?php
    $Req =  $bdd->query("SELECT recette.Titre,commentaire.commentaire,utilisateurs.pseudo FROM recette,commentaire,utilisateurs WHERE recette.IdRecette = commentaire.Idcommentaire");
    ?>              
        <table>
            <tr>
                <th>Titre</th>
                <th>Commentaire</th>
                <th>Créateur</th>
            </tr>
            <?php
            while ($tab = $Req->fetch()) {
            ?>
                <tr>
                    <td><?php echo $tab["Titre"]; ?></td>
                    <td><?php echo $tab["commentaire"]; ?></td>
                    <td><?php echo $tab["pseudo"]; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
  </body>
</html>
<?php
// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=Blog;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$id_billet = $_POST['id_billet'];

// Insertion du message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO commentaires (auteur, commentaire, date_commentaire, id_billet) VALUES(?, ?, NOW(), ?)');
$req->execute(array($_POST['auteur'], $_POST['commentaire'], $_POST['id_billet']));

// Redirection du visiteur vers la page du minichat
header('Location: ../commentaires.php?billet='.$id_billet.'');

?>
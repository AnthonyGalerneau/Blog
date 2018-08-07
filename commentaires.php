<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Blog</title>
</head>
<body>
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à l'accueil</a></p>

<?php 
$bdd = new PDO('mysql:host=localhost;dbname=Blog', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$reponse = $bdd->prepare('SELECT id, titre, contenu, date_creation FROM billets WHERE id = ?'); 
$reponse->execute(array($_GET['billet']));
$donnees = $reponse->fetch();
?>
<div id="billet">
	<h3>
	<?php
		echo htmlspecialchars($donnees['titre'] . ' - ' . $donnees['date_creation']);
	?>
	</h3>
	<p>
	<?php
		echo htmlspecialchars($donnees['contenu']);
	?>
	</p>
</div>
<h2>Commentaires :</h2>
<?php
$reponse->closeCursor();
$bdd = new PDO('mysql:host=localhost;dbname=Blog', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$reponse = $bdd->prepare('SELECT auteur, commentaire, date_commentaire FROM commentaires WHERE id_billet = ?'); 
$reponse->execute(array($_GET['billet']));
while ($donnees = $reponse->fetch())
{
?>
<div id="espace_commentaire">
	<h3>
	<?php
		echo htmlspecialchars($donnees['auteur'] . ' - ' . $donnees['date_commentaire']);
	?>
	</h3>
	<p>
	<?php
		echo htmlspecialchars($donnees['commentaire']);
	?>
	</p>
</div>
<?php
}
$reponse->closeCursor();
?>
</body>
</html>
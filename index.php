<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Blog</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<h1>Mon super blog !</h1>
		<p>Derniers billets du blog</p>
	</header>
<?php 
$bdd = new PDO('mysql:host=localhost;dbname=Blog', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$reponse = $bdd->query('SELECT * FROM billets'); 
while ($donnees = $reponse->fetch())
{
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
	<p>
		<a href="commentaires.php?billet=<?php echo $donnees['id']; ?>">Commentaires</a> 
	</p>
</div>
<?php
}
$reponse->closeCursor();
?>
</body>
</html>
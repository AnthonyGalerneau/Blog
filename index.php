<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Blog</title>
</head>
<body>
	<h1>Mon super blog !</h1>
	<p>Derniers billets du blog</p>
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
	}
	?>
	</p>
</div>
</body>
</html>
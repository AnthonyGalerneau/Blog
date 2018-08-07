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
$bdd = new PDO('mysql:host=localhost;dbname=Blog', 'root', 'root');
$reponse = $bdd->query('SELECT * FROM billets'); 
while ($donnees = $reponse->fetch())
{
	echo '<p>' . $donnees['titre'] . ' ' . $donnees['date_creation'] . '</p>';
	echo '<p>' . $donnees['contenu'] . '</p>';
}


?>

</body>
</html>
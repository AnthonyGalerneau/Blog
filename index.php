
<?php 

//Récupération des données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=Blog', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%i\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5');

?>

<!-- AFffichage -->

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
	while ($donnees = $req->fetch())
	{
	?>
	<div id="billet">
		<h3>
		<?php
			echo htmlspecialchars($donnees['titre'] . ' - ' . $donnees['date_creation_fr']);
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
	$req->closeCursor();
	?>
</body>
</html>
<?php
$bdd = new PDO('mysql:host=localhost;dbname=Blog', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$reponse = $bdd->prepare('SELECT id, titre, contenu, date_creation FROM billets WHERE id = ?');
$reponse->execute(array($_GET['billet']));
$billet = $reponse->fetch();

$reponse->closeCursor();

$reponse = $bdd->prepare('SELECT auteur, commentaire, date_commentaire FROM commentaires WHERE id_billet = ?');
$reponse->execute(array($_GET['billet']));
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Blog</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à l'accueil</a></p>
<?php
if ((isset($_GET['billet'])) AND (!empty($billet)))
{
?>
    <div id="billet">
        <h3>
            <?php
            echo htmlspecialchars($billet['titre'] . ' - ' . $billet['date_creation']);
            ?>
        </h3>
        <p>
            <?php
            echo htmlspecialchars($billet['contenu']);
            ?>
        </p>
    </div>
	<h2>Commentaires :</h2>
	<?php
	while ($commentaire = $reponse->fetch())
	{
	?>
	<div id="espace_commentaire">
		<h3>
		<?php
			echo htmlspecialchars($commentaire['auteur'] . ' - ' . $commentaire['date_commentaire']);
		?>
		</h3>
		<p>
		<?php
			echo htmlspecialchars($commentaire['commentaire']);
		?>
		</p>
	</div>
	<?php
	}
	$reponse->closeCursor();
}
else
{
	echo '<div> <h2>Page introuvable ! </h2></div>';
}
?>
<div id="formulaire_commentaire">
	<form action="commentaires_post.php" method="POST">
		<p><label for="auteur"> Pseudo :<input type="text" name="auteur" id="auteur" /></label></p>
		<p><label for="commentaire">  Commentaire : <textarea name="commentaire" rows="4" cols="30" id="commentaire"></textarea></label></p>
		<p><input type="submit" /></p> 
		<input type="hidden" for="date_commentaire" name="date_commentaire" id="date_commentaire" value="<?php echo '' . time();?>" /> 
		<input for="id_billet" type="hidden" name="id_billet" id="id_billet" value="<?php echo $_GET['billet']; ?>" />  
    </form>
</div>
</body>
</html>
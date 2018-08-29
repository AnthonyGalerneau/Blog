<?php ob_start(); ?>
Modifier le commentaire
<?php $title = ob_get_clean(); ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>
 
 
<h2>Editer le commentaire</h2>
 
<form action="index.php?action=addModifComment&amp;postId=<?= $post['id'] ?>&id=<?= $comment['id'] ?>" method="post">
		<p><label for="author"> Pseudo :<input type="text" name="author" id="author" value="<?php echo $comment['author'] ?>"></label></p>
        <p><label for="comment">Nouveau commentaire</label><br />
        <textarea id="comment" name="comment"><?php echo $comment['comment'] ?></textarea></p>
    <div>
        <p><input type="Submit" /></p>
    </div>
</form>
<?php
$content = ob_get_clean(); ?>
 
<?php require('template.php'); ?>


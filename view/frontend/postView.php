<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </h3>
    
    <p>
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </p>
</div>

<h3>Commentaires</h3>

<?php
while ($comment = $comments->fetch())
{
?>
    <div class="affichComment">
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?><a href="index.php?action=modifComment&amp;postId=<?= $post['id'] ?>&id=<?= $comment['id'] ?>"> (modifier)</a></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    </div>
<?php
}
?>

<div id="formulaire_commentaire">
    <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
	<p><label for="author"> Pseudo :<input type="text" name="author" id="author" /></label></p>
	<p><label for="comment">  Commentaire : <textarea name="comment" rows="4" cols="30" id="comment"></textarea></label></p>
	<p><input type="submit" /></p> 
	<input type="hidden" for="comment_date" name="comment_date" id="comment_date value="<?php echo '' . time();?>" /> 
	<input for="id_post" type="hidden" name="id_post" id="id_post" value="<?php echo $_GET['post']; ?>" />  
</form>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>

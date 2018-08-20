<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
        <link href="style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <h1>Mon super blog !</h1>
        <p>Derniers billets du blog :</p>
 
        
        <?php
        while ($data = $posts->fetch())
        {
        ?>
            <div class="post">
                <h3>
                    <?= htmlspecialchars($data['title']) ?>
                    le <?= $data['creation_date_fr'] ?>
                </h3>
                
                <p>
                    <?= nl2br(htmlspecialchars($data['content'])) ?>
                    <br />
                    <a href="post.php?id=<?= $data['id'] ?>">Commentaires</a>
                </p>
            </div>
        <?php
        }
        $posts->closeCursor();
        ?>
    </body>
</html>
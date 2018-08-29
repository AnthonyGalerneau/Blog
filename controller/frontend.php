<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts()
{
    $postManager = new \AnthonyGalerneau\Blog\Model\PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new \AnthonyGalerneau\Blog\Model\PostManager();
    $commentManager = new \AnthonyGalerneau\Blog\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new \AnthonyGalerneau\Blog\Model\CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function modifComment($postId, $id)
{
    $commentManager = new \AnthonyGalerneau\Blog\Model\CommentManager();
    $postManager = new \AnthonyGalerneau\Blog\Model\PostManager();

    $modifComment = $commentManager->getModifComment($postId, $id);
    $post = $postManager->getPost($postId);
    $comment = $modifComment->fetch();
    if ($comment === false) 
    {
        throw new Exception('Commentaire introuvable !');
    } else {
        require('view/frontend/commentView.php');
    }
   
}

function addModifComment($postId, $id, $author, $comment)
{
    $commentManager = new \AnthonyGalerneau\Blog\Model\CommentManager();
    $req = $commentManager->addModifComment($postId, $id, $author, $comment); 

   if ($req === false) 
   {
        throw new Exception('Impossible de modifier le commentaire !');
    } else 
    {
        header('Location: index.php?action=post&id=' . $postId);
    }
}






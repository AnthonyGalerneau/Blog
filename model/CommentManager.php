<?php

namespace AnthonyGalerneau\Blog\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
	public function getComments($postId)
	{
	    $db = $this->dbConnect();
	    $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr FROM comments WHERE id_post = ? ORDER BY comment_date DESC LIMIT 0, 5');
	    $comments->execute(array($postId));

	    return $comments;
	}

	public function postComment($postId, $author, $comment)
	{
	    $db = $this->dbConnect();
	    $comments = $db->prepare('INSERT INTO comments(id_post, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
	    $affectedLines = $comments->execute(array($postId, $author, $comment));

	    return $affectedLines;
	}

	public function getModifComment($postId, $id)
    {
       $db = $this->dbConnect();
        $comments = $db->prepare('SELECT * FROM comments WHERE id = ? and post_id = ?');
        $comments->execute(array($postId, $id));
        $modifComment = $comments->fetch();
        $comments->closeCursor();
        return $modifComment;
    }
    
    public function addModifComment($postId, $id, $author, $comment)
    {
    	$id = (int)$id;
    	var_dump($id, $comment);
        $db = $this->dbConnect();
        $req= $db->prepare('UPDATE comments SET author = ?, comment = ? WHERE id = ? and id_post = ?');
        $req->execute(array($author, $comment, $id, $postId));
        return $req;
    }
}

<?php

class CommentManager
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

	private function dbConnect()
	{
	    $db = new PDO('mysql:host=localhost;dbname=Blog;charset=utf8', 'root', 'root');
	    return $db;
	}
}

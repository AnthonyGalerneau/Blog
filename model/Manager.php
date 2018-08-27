<?php

namespace AnthonyGalerneau\Blog\Model;

class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=Blog;charset=utf8', 'root', 'root');
        return $db;
    }
}
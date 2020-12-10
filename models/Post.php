<?php

class Post extends Database
{
  private $db;
  public function __construct()

  {
    $this->db = new Database();
  }

  public function getPosts()
  {
    $this->db->query('SELECT * FROM posts');
    $results  = $this->db->resultSet();
    return $results;
  }
}
<?php
class Database
{
  private $server_name = DB_HOST;
  private $db_user = DB_USER;
  private $pass = DB_PASS;
  private $db_name = DB_NAME;

  private $dbh;
  private $stmt;
  private $err_msg;


  public function __construct()
  {
    $conn = 'mysql:host=' . $this->server_name  . ';dbname=' . $this->db_name;
    $options = array(
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

    );
    try {
      //code...
      $this->dbh = new PDO($conn, $this->user, $this->pass, $options);
    } catch (PDOException $e) {
      //throw $th;
      $this->err_msg = $e->getMessage();
      echo $this->err_msg;
    }
  }

  public function query($sql)
  {
    $this->stmt = $this->dbh->prepare($sql);
  }

  public function bind($param, $value, $type = null)
  {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
      }
    }
    $this->stmt->bindValue($param, $value, $type);
  }

  public function execute()
  {
    return $this->stmt->execute();
  }
  //  get all rows 
  public function resultSet()
  {
    $this->stmt->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
  }
  // get single row 
  public function single()
  {
    $this->stmt->execute();
    return $this->stmt->fetch(PDO::FETCH_OBJ);
  }

  public function rowCount()
  {
    return $this->stmt->rowCount();
  }


  public function lastInsertedId()
  {

    return $this->stmt->lastInsertedId();
  }
};
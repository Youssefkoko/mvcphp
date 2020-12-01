<?php

/**
 * DB PDO CLASS 
 * Connect to db 
 * Create prepare stmt
 * Bind Values
 * return rows
 * 
 **/

class Database
{
  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $dbname = DB_NAME;

  private $dbh;
  private $stmt;
  private $error;

  public function __construct()
  {
    // SET DSN 
    $dsn = "mysql:host=" . $this->host . ";db_name=" . $this->dbname;
    $options = array(
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    );
    // Create PDO instance  
    try {
      $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
    } catch (PDOException $e) {
      $this->error = $e->getMessage();
      echo $this->error;
    }
    // END OF CONTRUCT 
  }
  public function query($sql)
  {
    $this->stmt = $this->dbh->prepare($sql);
  }
  // Bind values 
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
        case is_NULL($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
      }
    }
    $this->stmt->bind($param, $value, $type);
  }
  // Excute the prepare statmanet 
  public function execute()
  {
    return $this->stmt->execute();
  }
  // get result set as array of Objects
  public function resultSet()
  {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
  }
  // Get single record as an OBJECT 
  public function single()
  {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_OBJ);
  }
  public function rowCount()
  {
    return $this->stmt->rowCount();
  }
}

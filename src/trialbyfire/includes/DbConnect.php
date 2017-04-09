<?php

class DbConnect
{
  private $conn;

  function __construct()
  {
  }

  // Establishing database connection_aborted
  //@return database connection handler
  function connect()
  {
    require_once 'config.php';

    //Connecting to mysql database
    $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    //Check for database connection Error
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    //returning connection resource
    return $this->conn;
  }
}




?>

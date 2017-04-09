<?php

class DbOperation
{
  private $conn;

  //Constructor
  function __construct()
  {
    require_once dirname(__FILE__) . '/config.php';
    require_once dirname(__FILE__) . '/DbConnect.php';
    // opening db connection
    $db = new DbConnect();
    $this->conn = $db->connect();
  }

  //Function to create a new user
  public function createUser($fnameOut, $phoneOut, $emailOut, $passOut)
  {

    if($stmt = $this->conn->prepare("INSERT INTO userbase2(fname, phone,email,pass) VALUES(?,?,?,?)"))
    {

      $stmt->bind_param('siss', $fnameOut, $phoneOut, $emailOut, $passOut);
      $result = $stmt->execute();
      $stmt->close();

      if($result) {
        return true;
      } else {
        return false;
      }
    }

  }
}

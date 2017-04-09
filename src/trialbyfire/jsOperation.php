<?php

class jsOperation
{
  private $conn;

  //Constructor
  function __construct()
  {
    require_once dirname(__FILE__) . '/includes/config.php';
    require_once dirname(__FILE__) . '/includes/DbConnect.php';
    // opening db connection
    $db = new DbConnect();
    $this->conn = $db->connect();
  }

  //Function to create a new user
  public function createEntry($activity, $address, $time, $description)
  {

    if($stmt = $this->conn->prepare("INSERT INTO activityBase(activity, address, timeOccur, descrip) VALUES(?,?,?,?)"))
    {

      $stmt->bind_param('ssss', $activity, $address, $time, $description);
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

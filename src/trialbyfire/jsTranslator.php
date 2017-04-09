<?php
$response = array();

if($_SERVER['REQUEST_METHOD']=='GET')
{
  var_dump($_GET);
    //getting values
    $activity = isset($_GET['w1']) ? $_GET['w1'] : '';
    $address = isset($_GET['w2']) ? $_GET['w2'] : '';
    $time = isset($_GET['w3']) ? $_GET['w3'] : '';
    $description = isset($_GET['w4']) ? $_GET['w4'] : '';

    //including the db operation file
    require_once '/jsOperation.php';

    $db = new jsOperation();

    //inserting values
    if($db->createEntry($activity, $address, $time, $description))
    {
        $response['error']=false;
        $response['message']='Entry added successfully';
        header("location: ./crimeReport.php");
    }
    else
    {
        $response['error']=true;
        $response['message']='Could not add entry';
        header("location: ./crimeReport.php");
    }

  }
  else{
    $response['error']=true;
    $response['message']='You are not authorized';
  }
  echo json_encode($response);
  ?>

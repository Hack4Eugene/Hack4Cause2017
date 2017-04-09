<?php

//creating response array
$response = array();

if($_SERVER['REQUEST_METHOD']=='GET')
{
  var_dump($_GET);
    //getting values
    $fnameOut = isset($_GET['fname']) ? $_GET['fname'] : '';
    $phoneOut = isset($_GET['phone']) ? $_GET['phone'] : '';
    $emailOut = isset($_GET['email']) ? $_GET['email'] : '';
    $passOut = isset($_GET['pass']) ? $_GET['pass'] : '';

    //including the db operation file
    require_once '../includes/DbOperation.php';

    $db = new DbOperation();

    //inserting values
    if($db->createUser($fnameOut, $phoneOut, $emailOut, $passOut))
    {
        $response['error']=false;
        $response['message']='User added successfully';
        header("location: ../login.php");
    }
    else
    {
        $response['error']=true;
        $response['message']='Could not add user';
        header("location: ../login.php");
    }

}
else{
    $response['error']=true;
    $response['message']='You are not authorized';
}
echo json_encode($response);
?>

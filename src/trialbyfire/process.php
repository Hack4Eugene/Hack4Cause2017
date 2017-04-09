
<?php
  // Get Values passed from form in login.php file
  $email = $_POST['email'];
  $password = $_POST['pass'];

  //connect to the server and select database
  $connection = mysqli_connect("localhost", "root", "", "hackathon");

  //Query the database for user
  $result = mysqli_query($connection, "SELECT * FROM userbase2 where email = '$email' and pass = '$password'")
          or die("Failed to query database ".mysql_error());

  $row = mysqli_fetch_array($result);
  if($row['email'] == $email && $row['pass'] == $password && ("" !== $email || "" !== $password))
  {

//this is the arrary!!
    $person = $row;
    print_r($person);
    header("location: crimeReport.php");
  }
  else {
    echo "Failed to login.";
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <p>
      <a href="./login.php">Go Back</a>
    </p>
  </body>
</html>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css?<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Cinzel|Oswald" rel="stylesheet">
  </head>
  <body>
    <h1>ViaVitae</h1>
    <div id="frm">
      <form action="process.php" method="POST">
        <p>
          <label>Email:</label>
          <br>
          <input type="email" id="email" name="email" />
        </p>
        <p>
          <label>Password:</label>
          <input type="password" id="pass" name="pass" />
        </p>
        <p>
          <input type="submit" id="btn" value="Login" />
        </p>
		<p><a href="./Registration.php"> Haven't Registered Yet?</a></p>
      </form>
    </div>
  </body>
</html>

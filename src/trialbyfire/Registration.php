
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="header">
      <h1> Register</h1>
    </div>
    <form action="./api/createUser.php" method="GET">
      <table>
        <tr>
          <td>Name:</td>
          <td><input type="text" name="fname" class="textInput"></td>
        </tr>
        <tr>
          <td>Phone Number:</td>
          <td><input type="tel" name="phone" class="textInput"></td>
        </tr>
        <tr>
          <td>Email:</td>
          <td><input type="email" name="email" class="textInput"></td>
        </tr>
        <tr>
          <td>Password:</td>
          <td><input type="password" name="pass" class="textInput"></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" name="register_btn" value="Register"></td>
        </tr>
      </table>
    </form>
  </body>
</html>

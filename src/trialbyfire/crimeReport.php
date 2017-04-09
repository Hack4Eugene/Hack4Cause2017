<!DOCTYPE html>
<html>
  <head>
    <title>Crime Report</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="icon" href="https://www.brandsoftheworld.com/sites/default/files/styles/logo-thumbnail/public/022013/neighborhood-watch.png?itok=ONbLXpd_">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css?<?php echo time(); ?>" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Cinzel|Oswald" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLLGhjWO-W-Gzd1KmhSpAETJcEl3IBgzs&callback=initMap">
    </script>
    <script type="text/javascript" src="https://cdn.emailjs.com/dist/email.min.js"></script>
    <script type="text/javascript">(function(){emailjs.init("user_eSuEnYqCcLzyf6g4he7KR");})();</script>
  </head>
  <body>
    <div class="container">
    <hr>
      <h1 id="mainHeadline">ViaVitae</h1>
    <h3 id="mapHeadline">Witnessed Incident Map</h3>
    <div id="map"></div>
      <hr>
      <form id="dataEntry" action="submit.php">
        <div class="form-group">
          <div class="row">
            <div class="col-sm-4">
              <label>Severity of Activity Witnessed:</label>
              <br>
              <select id="activity" required>
                <option value="" selected>Select a Category...</option>
                <option value="assault">Suspicious</option>
                <option value="harrassment">Disturbing</option>
                <option value="sexualHarrassment">Extremely Disturbing</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label>Address where Incident Occurred:</label>
              <br>
              <input id="address" type="textbox" placeholder="Enter an address..." required>
            </div>
            <div class="col-sm-4">
              <label>Time Incident was Witnessed:</label>
              <br>
              <input id="time" type="time" name="time" required>
            </div>
          </div>
          <h4>A brief, optional description can be entered below to help the process:</h4>
          <div id="stubbornColumn">
            <input id="description" type="text" maxlength="125">
          </div>
        </div>
        </form>
        <input id="submit" type="submit" value="Submit">
        <br>
        <br>
        <a href="aboutUs.php"><h4>For other safety resources and more information about ViaVitae, click here</h4></a>
    </div>
  </body>
</html>

<?php
error_reporting(0);
$name = "";
$error = "";
$success = "";
$api = "3f0578c87edd6b2e9d67bb1d648e6d2e";
if ($_POST) {
  $name = $_POST["city"];
  if ($name != "") {
    $exists = false;
    try {
      $contents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$name."&appid=".$api);
      $exists = true;
    } catch (Exception $e) {
      $error = "<div class='alert alert-danger' role='alert'> <p>We could not find that city.</p> </div>";
    }
    if ($exists) {
      $summary = json_decode($contents, true);
      $weather = "The weather in ".$name." is currently: ".$summary['weather'][0]['description'].". ";
      $tempInFahrenheit = ($summary['main']['temp'] - 273) * (9/5) + 32;
      $weather .= "The temperature is ".round($tempInFahrenheit, 1)." Fahrenheit ";
      $humidity = $summary['main']['humidity'];
      $weather .= "and the humidity is ".$humidity."%. ";
      $wind = $summary['wind']['speed'] * 2.23694;
      $weather .= "The wind speed is ".round($wind, 1)." MPH. ";
      if ($summary == "" ) {
        $error = "<div class='alert alert-danger' role='alert'> <p>We could not find that city.</p> </div>";
      } else {
        $success = '<div class="alert alert-success" role="alert"> <p>'.$weather.'</p></div>';
      }
    }
  } else {
    $error = "<div class='alert alert-danger' role='alert'> <p>You did not enter a city name.</p> </div>";
  }
}

?>


<!doctype html>

<html lang="en">

  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/d9f1cd4ae3.js" crossorigin="anonymous"></script>

    <title>Weather!</title>

    <style type="text/css">
      body {
        position: relative;
        background-image: url("background.jpg");
        background-size: cover;
      }

      #wrap {
        padding: 20px;
        margin-top: 100px;
        color: white;
        text-shadow: 3px 3px 2px black;
        border-radius: 10px;
        background-color: rgb(100, 100, 100, 0.5);
      }

      #messages {
        text-shadow: 0px 0px black;
      }

    </style>

  </head>

  <body>

    <div class="container text-center" id="wrap">
      <h1>What's The Weather?</h1>
      <br>
      <h5>Enter the name of a city.</h5>
      <br><br><br>
      <form method="post">
        <div class="form-group">
          <input type="text" class="form-control" name="city" placeholder="Dubai, Tokyo, etc.">
        </div>
        <br>
        <button type="submit" class="btn btn-info">Find out</button>
      </form>
      <br>
      <div class="mb-2">
        <a href="http://www.davidlynch.me/projects.html">Go back</a>
      </div>
      <br>
      <div id="messages">
        <?php echo $error; ?>
        <?php echo $success; ?>
      </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>


    <script type="text/javascript">



    </script>

  </body>
</html>

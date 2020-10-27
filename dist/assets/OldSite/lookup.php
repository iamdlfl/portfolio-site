<?php

include('keys.php');
$lookupURL = '';
$address = '';
$success = '';
$error = '';
if ($_POST) {
  if (array_key_exists('houseNumber', $_POST) && $_POST['houseNumber'] != '') {
    foreach ($_POST as $key => $value) {
      $address .= str_replace(' ', '+', $value);
      if ($key == 'houseNumber' || $key == 'city') {
        $address .= ',+';
      }
    }
    $lookupURL = "https://maps.googleapis.com/maps/api/geocode/json?address=".$address."&key=".$googleGeoKey;
    $response = file_get_contents($lookupURL);
    $contents = json_decode($response, true);
    $components = $contents['results'][0]['address_components'];
    foreach ($components as $item) {
      if ($item['types'][0] == 'postal_code') {
        $success .= $item['long_name'];
      } else if ($item['types'][0] == 'postal_code_suffix') {
        $success .= "-";
        $success .= $item['long_name'];
      }
    }
  } else {
    $error .= 'You must put in at least part of a street address.';
  }
  if ($success != "") {
    $success = '<div class="alert alert-success align-middle" id="success">Your zipcode is: '.$success.'</div>';
  } else {
    if ($error != '') {
      $error .= "<br><br>";
    }
    $error .= "We could not find the postal code for this address. Sorry! Consider providing more information or double-checking what you have put in.";
  }
  if ($error != '') {
    $error = '<div class="alert alert-danger align-middle" id="error">'.$error.'</div>';
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

    <title>Look Up Your Zip Code</title>

    <style type="text/css">
      body {
        position: relative;
        background-image: url("fishing.jpg");
        background-size: cover;
      }

      #wrap {
        background-color: rgba(200, 255, 255, 0.4);
        width: 900px;
        height: 500px;
        border-radius: 5px;
        margin-top: 60px;
        text-shadow: 1px 1px 3px white;
        color: black;
        font-weight: bold
      }
      .form-control {
        width: 400px;
      }

      #messages {
        margin-top: 160px;
      }

      #form {
        margin-top: 50px;
      }

    </style>

  </head>

  <body>

    <div class="container" id='wrap'>
      <h1 class="text-center">Put your address in here</h1>
      <div class="row">
        <div class="col-sm-6" id="form">
          <form method="post">
            <div class="form-group">
              <label for="houseNumber">Street Address</label>
              <input type="text" name="houseNumber" placeholder="1500 W University Ave" class="form-control">
            </div>
            <div class="form-group">
              <label for="city">City</label>
              <input type="text" name="city" placeholder="Gainesville" value="" class="form-control">
            </div>
            <div class="form-group">
              <label for="state">State</label>
              <input type="text" name="state" placeholder="FL" value="" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        <div class="col-sm-6 align-middle" id='messages'>
          <? echo $error; ?>
          <? echo $success; ?>
        </div>
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

<?php
$error = "";
$success = "";

if ($_POST) {
  // VALIDATION
  if (!$_POST["subject"]) {
    $error .= "Subject is required.<br>";
  }

  if (!$_POST["body"]) {
    $error .= "Body is required.<br>";
  }

  if (!$_POST["email"]) {
    $error .= "Email is required.<br>";
  }

  $emailFrom = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
  if ($_POST["email"] && filter_var($emailFrom, FILTER_VALIDATE_EMAIL) === false) {
    $error .= "Email not valid.<br>";
  }

  if ($error != "") {
    $error = '<div class="alert alert-danger" role="alert">'.$error.'</div>';
  }

  //SET EMAIL INFO
  $emailTo = "davidjlynch1017@gmail.com";
  $subject = $_POST["subject"];
  $body = "From: ".$emailFrom."\n"."\nBody: ".$_POST["body"];
  $headers = "From: contactpage@davidlynch-me.stackstaging.com";

  if ($error == "") {
    //SEND EMAIL
    if (mail($emailTo, $subject, $body, $headers)) {
      $success='<div class="alert alert-success" role="alert">Success!</div>';
    }
    else {
      $error = '<div class="alert alert-danger" role="alert">Something went wrong...</div>';
    }
  }
}
 ?>

 <!doctype html>

 <html lang="en">

   <head>

     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


     <title>David Lynch</title>



   </head>

   <body>
    <nav class="navbar" id="myNavbar">
      <a href="index.html" class="navbar__brand navbar__brand--black">
        DL
      </a>
      <div class="navbar__toggler" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <div class="navbar__toggler__middle"></div>
      </div>
      <div class="collapse navbar__collapse">
        <ul class="nav navbar__nav">
          <li class="nav__item">
            <a href="index.html">Home</a>
          </li>
          <li class="nav__item">
            <a href="projects.html">Projects</a>
          </li>
          <li class="nav__item">
            <a href="about_me.html">About</a>
          </li>
          <li class="nav__item">
            <a href="education.html">Education</a>
          </li>
          <li class="nav__item">
            <a href="contact.php">Contact</a>
          </li>
        </ul>
      </div>
    </nav>
     <div class="container text-section" id="contactme">
       <h1 class="center">Contact Page</h1>
       <p>Welcome to my contact page, feel free to contact me through email or via
         <a href="https://www.linkedin.com/in/david-lynch-8435a0141">LinkedIn</a>,
         <a href="https://github.com/iamdlfl">GitHub</a> or the contact form below.</p>
       <p>My e-mail address: <a href="mailto: davidjlynch1017@gmail.com">davidjlynch1017@gmail.com</a></p>
     </div>

    <div class="container" id="contactform">
      <h3>Get in touch!</h3>
      <div class="container" id="messages">
        <? echo $success; ?>
        <? echo $error; ?>
        <div class="alert alert-danger" role="alert" id="errors">

        </div>
        <div class="alert alert-success" role="alert" id="success">
          Successful submission!
        </div>
      </div>
      <form method="post" id="myform">
        <div class="form-group">
          <label for="email">Your email address</label>
          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
          <small id="emailHelp" class="form-text text-muted">I'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="subject">Subject</label>
          <input type="text" class="form-control" id="subject" name="subject" aria-label="subject">
        </div>
        <div class="form-group">
          <label class="form-check-label" for="body">Body of the message here</label>
          <textarea id="body" name="body" class="form-control" aria-label="Body"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
      </form>
    </div>

  <footer class="footer"></footer>


    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript">

        function isEmail(email) {

          var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

          return regex.test(email);

        }

        //JS VALIDATION
        $("form").submit(function(e) {

            var errorMessage = "";
            var fieldsMissing = "";

            if ($("#email").val() == "") {
              fieldsMissing += "<br>-Email";
            }
            if ($("#subject").val() == "") {
              fieldsMissing += "<br>-Subject";
            }
            if ($("#body").val() == "") {
              fieldsMissing += "<br>-Body";
            }

            if (fieldsMissing != "") {
              errorMessage += "<h6>The following field(s) are missing: </h6><p>" + fieldsMissing + "</p>";
            }

            if (isEmail($("#email").val()) == false) {
              errorMessage += "<p>Your email address is not valid</p>";
            }

            if (errorMessage != "") {
              $("#success").hide();
              $("#errors").html(errorMessage);
              $("#errors").show();
              return false;
            } else {
              $("#errors").hide();
              $("#success").show();
              return true;
            }
          });

    </script>

  </body>
</html>

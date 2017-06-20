<?php
session_start();
?>

<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
  //This is all for smooth scrolling
  $(document).ready(function(){
    // Add smooth scrolling to all links
    $("a").on('click', function(event) {

      // Make sure this.hash has a value before overriding default behavior
      if (this.hash !== "") {
        // Prevent default anchor click behavior
        event.preventDefault();

        // Store hash
        var hash = this.hash;

        // Using jQuery's animate() method to add smooth page scroll
        // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
        $('html, body').animate({
          scrollTop: $(hash).offset().top
        }, 800, function(){

          // Add hash (#) to URL when done scrolling (default click behavior)
          window.location.hash = hash;
        });
      } // End if
    });
  });
  //end of smooth scrolling.
  </script>

  <?php include 'includes.php'; ?>
  <title> AuxiliumHub: Where you find help </title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="../style/assets/css/main.css"/>
</head>
<body>
  <?php
    $sEmailErr = $sPassErr = $rEmailErr = $rEmailConfErr = $rPassErr =
    $rPassConfErr = "";

    $errDetection = false;

    $sEmail = $rEmail = $sPassword = $rPassword = "";

    $conn = mysqli_connect($DBserver, $DBusername, $DBpassword, $DBdb);
    if (!$conn)
        die( "Connection failed: " . mysqli_connect_error( ) );

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if($_POST["type"] == "signin") {

        if(empty( $_POST["email"] )) {
          $sEmailErr = "Missing email address";
          $errDetection = true;
        }
        else
          $sEmail = test_input( $_POST["email"] );

        if(empty( $_POST["password"] )){
          $sPassErr = "Missing password";
          $errDetection = true;
        }
        else
          $sPassword = test_input( $_POST["password"] );

        if(!$errDetection){
          $sql = "SELECT * From Accounts WHERE Email='". $sEmail ."'";
          $result = mysqli_query($conn, $sql);

          if(mysqli_num_rows( $result ) > 0) {

            $result = mysqli_fetch_assoc($result);

            if($result["Password"] == $sPassword) {
              $_SESSION["loggedin"] = true;
              $_SESSION["Email"] = $sEmail;
              $_SESSION["UserID"] = $result["id"];
            }

            else {
              $sPassErr = "Wrong redentials";
              $errDetection = true;
            }

          } else {
            $sPassErr = "Wrong credentials";
            $errDetection = true;
          }
        }

      } else {

        if(empty( $_POST["email"] )) {
          $rEmailErr = "Missing email address";
          $errDetection = true;
        }
        else
          $rEmail = test_input( $_POST["email"] );

        if (mysqli_num_rows( mysqli_query($conn, "SELECT Email FROM Accounts WHERE Email='". $rEmail ."'" ) ) > 0) { //to be improved
          $rEmailErr = "This email address already exists";
          $errDetection = true;
        }

        if(empty( $_POST["password"] )) {
          $rPassErr = "Missing password";
          $errDetection = true;
        }
        else
          $rPassword = test_input( $_POST["password"] );

        if($_POST["email"] != $_POST["emailConf"]) {
          $rEmailConfErr = "Emails do not match";
          $errDetection = true;
        }

        if($_POST["password"] != $_POST["passwordConf"]) {
          $rPassConfErr = "Passwords do not match";
          $errDetection = true;
        }

        if(empty( $_POST["emailConf"] )) {
          $rEmailConfErr = "Missing email address confirmation";
          $errDetection = true;
        }

        if(empty( $_POST["passwordConf"] )) {
          $rPassConfErr = "Missing password confirmation";
          $errDetection = true;
        }

        if(!$errDetection) {
          $sql = "INSERT INTO Accounts (Email, Password) VALUES ('". $rEmail ."', '". $rPassword ."')";
          if(!( mysqli_query($conn, $sql) )) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          } else {
            echo "<script>alert('Congratulations! Your signup was successful. Enjoy your time here!')</script>";
          }
        }

      }
    }
    mysqli_close($conn);
  ?>


  <!-- Menu/Header -->
  <?php showMenu(); ?>

  <!-- Banner -->
  <section id="banner">
    <div class="inner">
      <h1>Auxilium: <span>Find help as a student<br />
      or help a student as a tutor</span></h1>
      <ul class="actions">
        <?php //session_start(); ?>
        <?php
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
        ?>
        <li><a onclick="alert('Thank you for visiting us, good luck!')" href="logout.php" class="button alt">Sign Out</a></li>
        <?php }
        else { ?>
        <li><a onclick="showForm('signin')" href="#signin" class="button alt">Login</a></li>
        <li><a onclick="showForm('register')" href="#register" class="button alt">Register</a></li>
        <?php } ?>
      </ul>
    </div>
  </section>

  <!-- Mission -->
  <section id="one">
    <div class="inner">
      <header>
        <h2>Who are we?</h2>
      </header>
      <p>
        Our mission is one: <strong>Connect you with a tutor in-person.</strong>
        In AuxiliumHub you can either signup to be a tutor, a student or both. As a student
        you get to post on our website to look for a tutor to help you with whatever you need.
        As a tutor you respond to posts in hope you will get the job!. Think of our website as craigslist
        but for finding tutors in your campus.<br/>
        This website is free to use as a Student or Tutor. We do not hire anyone, we do not pay anyone. We
        simply match a student with a tutor and whatever happen between them is none of our business and never will be.
        Want to know more how it works?
      </p>
      <ul class="actions">
        <li><a href="moreinfo.php" class="button alt">Learn More</a></li>
      </ul>
    </div>
  </section >

  <section id="main" style="display: none">
    <div class="inner">
      <div class="row">
        <div class="6u 12u$(xsmall)" id="signin" style="display: none;">
          <div class="table-wrapper">
            <table class ="alt">
              <tbody><tr><td>
                <h3>Log In</h3>
                  <form method="post" action"#">
                    <div class="field">
                      <h6><?php echo $sEmailErr; ?></h6>
                      <input type="email" name="email" id="demo-name" value="<?php echo $sEmail; ?>" placeholder="Email" />
                    </div>
                    <div class="field">
                        <h6><?php echo $sPassErr; ?></h6>
                      <input type="password" name="password" id="demo-email" value="" placeholder="Password" minlength="6"/>
                    </div>
                      <input type="hidden" name="type" value="signin"/>
                    <div class="12u$">
                      <ul class="actions">
                        <li><input type="submit" value="Log In" class="special" /></li>
                        <li><a onclick="showForm('signin')" href="#banner" class="button">Cancel</a></li>
                      </ul>
                    </div>
                  </form>
              </td></tr></tbody>
            </table>
          </div>
        </div>
        <div class="6u$ 12u$(xsmall)" id="register" style="display: none;">
          <table class ="alt">
            <tbody><tr><td>
              <h3>Register</h3>
                <form method="post" action"index.php">
                  <div class="field">
                      <h6><?php echo $rEmailErr; ?></h6>
                    <input type="email" name="email" id="demo-name" value="<?php echo $rEmail; ?>" placeholder="Email" />
                  </div>
                  <div class="field">
                    <h6><?php echo $rEmailConfErr; ?></h6>
                    <input type="email" name="emailConf" id="demo-name" value="" placeholder="Retype Email" />
                  </div>
                  <div class="field">
                    <h6><?php echo $rPassErr; ?></h6>
                    <input type="password" name="password" id="demo-email" value="" placeholder="Password" minlength="6"/>
                  </div>
                  <div class="field">
                    <h6><?php echo $rPassConfErr; ?></h6>
                    <input type="password" name="passwordConf" id="demo-email" value="" placeholder="Retype Password" minlength="6"/>
                  </div>
                    <input type="hidden" name="type" value="register"/>
                  <div class="12u$">
                    <ul class="actions">
                      <li><input type="submit" value="Register" class="special" /></li>
                      <li><a onclick="showForm('register')" href="#banner" class="button">Cancel</a></li>
                    </ul>
                  </div>
                </form>
            </td></tr></tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <script>
    function showForm(id) {
      console.log(id);
      document.getElementById("main").style.display = "block";

      var el = document.getElementById(id);

      if(el.style.display == "none")
        el.style.display = "block";
      else
        el.style.display = "none";
    }
  </script>
  <?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && $errDetection) {
      echo '<script> showForm("'. $_POST["type"] .'");</script>';
    }
  ?>
</body>
</html>

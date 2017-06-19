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

  <!-- Menu/Header -->
  <?php showMenu(); ?>

  <!-- Banner -->
  <section id="banner">
    <div class="inner">
      <h1>Auxilium: <span>Find help as a student<br />
      or help a student as a tutor</span></h1>
      <ul class="actions">
        <?php session_start( ); ?>
        <?php if(session_status( ) == PHP_SESSION_ACTIVE) {
          ?>
        <li><a onclick="" href="logout.php" class="button alt">Sign Out</a></li>
        <?php }
        else { ?>
        <li><a onclick="hider('loginDIV')" href="#loginDIV" class="button alt">Login</a></li>
        <li><a onclick="hider('signupDIV')" href="#signupDIV" class="button alt">Register</a></li>
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
        <li><a href="#" class="button alt">Learn More</a></li>
      </ul>
    </div>
  </section >

  <span align="center" id="loginDIV" style="display: none;">
    <section >
      <h3>Log In</h3>
      <form align="center"method="post" action="#">
        <div class="row uniform 50%">
          <div class="6u 12u$(xsmall)">
            <input type="email" name="email" id="demo-name" value="" placeholder="Email" />
          </div><br><br>
          <div class="6u$ 12u$(xsmall)">
            <input type="password" name="password" id="demo-email" value="" placeholder="Password" />
          </div><br><br>
          <div class="12u$">
            <ul class="actions">
              <li><input type="submit" value="Log In" class="special" /></li>
              <li><input type="submit" value="Cancel" /></li>
            </ul>
          </div>
        </div>
      </form>
    </section>
  </span>


  </span>

  <span align="center"id="signupDIV" style="display: none;">
    <section>
      <h3>Register</h3>
      <form align="center"method="post" action="#"align="center">
        <div class="row uniform 50%"  >
          <div class="6u 12u$(xsmall)">
            <input type="email" name="email" id="demo-name" value="" placeholder="Email" />
          </div><br><br>
          <div class="6u 12u$(xsmall)">
            <input type="email" name="email2" id="demo-name" value="" placeholder="Retype Email" />
          </div><br><br>
          <div class="6u$ 12u$(xsmall)">
            <input type="password" name="password" id="demo-email" value="" placeholder="Password" />
          </div>
          <div class="6u$ 12u$(xsmall)">
            <input type="password" name="password2" id="demo-email" value="" placeholder="Retype Password" />
          </div>
          <div class="6u 12u$(xsmall)">
            <input type="text" name="username" id="demo-name" value="" placeholder="Username" />
          </div>
          <div class="12u$">
            <ul class="actions">
              <li><input type="submit" value="Register" class="special" /></li>
              <li><input type="submit" value="Cancel" /></li>
            </ul>
          </div>
        </div>
      </form>
    </section>
    </span>


  </span>

  <script>
    function hider(id) {
      console.log(id);
      var el = document.getElementById(id);
      if(el.style.display == "none")
        el.style.display = "block";

      else
        el.style.display = "none";
    }
  </script>

</body>
</html>

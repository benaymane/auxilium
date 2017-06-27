<?php
$DBusername = "id2017014_root";
$DBpassword = "DontHackMePlz";
$DBserver = "localhost";
$DBdb = "id2017014_auxiliumdb";
?>

<?php
//Adds all important links to page
function preloads( ) {
?>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="../style/assets/css/main.css"/>
	<script src="../style/assets/js/jquery.min.js"></script>
	<script src="../style/assets/js/skel.min.js"></script>
	<script src="../style/assets/js/util.js"></script>
	<script src="../style/assets/js/main.js"></script>
<?php
} //end preloads

//shows the black menu at the top
function showMenu( ) {
?>
	<!-- Header -->
	<header id="header">
	  <div class="inner">
		<a href="index.php" class="logo">auxilium</a>
		<nav id="nav">
		  <a href="index.php">Home</a>
		  <a href="posts.php">Posts</a>
		  <?php
			if( isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true ) {
			  echo "<a href='profile.php'>Profile</a>"."<a style=\"text-transform: none;\"><strong>Welcome Back, ". $_SESSION["Username"] ."!</strong></a>";
			}
		  ?>
		</nav>
	  </div>
	</header>
	<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>
<?php
} //end showMenu

//shows the pink footer at the end of the page
function showFooter() {
?>
  <section id="footer">
    <div class="inner">
      <header>
        <h3>Credit</h3>
      </header>
      
      <div class="copyright">
        &copy; Auxilium Corp. alrights reserved. 2017.<br/>
          Using <a href="https://templated.co/">TEMPLATED</a>.
      </div>
    </div>
  </section>
<?php
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

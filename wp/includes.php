<?php
$DBusername = "root";
$DBpassword = "";
$DBserver = "localhost";
$DBdb = "auxiliumDB";


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
          echo "<a href='moreinfo.php'>Profile</a>"."<p><strong>You are logged in as: \"".$_SESSION["Email"]."\"</strong></p>";
        }
      ?>
    </nav>
  </div>
</header>
<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>
<?php
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<?php session_start(); ?>
<html>
<head>
  <title> AuxiliumHub: Where you find help </title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="./scripts/smooth-scrolling.js"></script>
  <?php
	include 'includes.php'; 
	preloads( );
  ?>
</head>
<body>
  <?php 
  if(isset($_GET["u"]) && $_GET["u"] == "t") {
	$conn = mysqli_connect($DBserver, $DBusername, $DBpassword, $DBdb);
  
	if (!$conn)
		die( "Connection failed: " . mysqli_connect_error( ) );
	$_SESSION["Tutor"] = ($_GET["v"] == "t") ? 1 : 0;
	$sql = "UPDATE Profile SET Tutor='". $_SESSION["Tutor"] ."' WHERE AccountID='". $_SESSION["UserID"] ."'";
	
	if (!mysqli_query($conn, $sql))
		echo "Error updating record: " . mysqli_error($conn);

  }
  ?>
  <?php showMenu( ); ?>
  
  <section id="banner" style="background-image: url('../style/images/image-ab.jpg');">
    <div class="inner">
      <h1>Profile: <span>Modify it!</span></h1>
	  
	  <ul class="actions">
		<?php 
			if ( $_SESSION["Tutor"] == 1 ) 
				echo "<li><a onclick=\"sad()\" href=\"profile.php?u=t&v=f\" class=\"button alt\">Unsubscribe!</a></li>".
					"<strong><span style=\"color:green\"> You are currently SUBSCRIBED as a tutor.</span></strong>";
			else 
				echo "<li><a onclick=\"congratulate()\" href=\"profile.php?u=t&v=t\" class=\"button alt\">Become a tutor!</a></li>".
					"<strong><span style=\"color:red\"> You are currently NOT a tutor.</span></strong>";
		?>
	  </ul>
    </div>
  </section>
  
  <section id="main">
	<div class="inner">
		<h2 id="PI"><u>Personal Information:</u></h2>
		<p>
			<h5 style="display:inline; color:#B22222;">Username:</h5> 
			<section id="UserDisplay">
				<p style="text-indent:5%;"><?php echo $_SESSION["Username"]; ?> 
				<sub><a onclick="showBox('UserModify', 'UserDisplay')">Change</a></br></sub></p> 
			</section>
			<section id="UserModify" style="display:none">
				<form method="post" action"#">
					<div class="field">
						<h6><?php //echo $usernameErr; ?></h6>
						<input type="text" name="username" id="demo-name" value="<?php echo $_SESSION["Username"];?>" />
					</div>
					<ul class="actions">
						<li><input type="submit" value="Update" class="special" /></li>
						<li><a onclick="showBox('UserDisplay', 'UserModify')" class="button">Cancel</a></li>
					</ul>
				</form>
			</section>
			
			<h5 style="display:inline; color:#B22222;">Email:</h5>
			<section id="EmailDisplay">
				<p style="text-indent:5%;"><?php echo $_SESSION["Email"]; ?> 
				<sub><a onclick="showBox('EmailModify', 'EmailDisplay')">  Change</a></br></sub></p>
			</section>
			<section id="EmailModify" style="display:none">
				<form method="post" action"#">
					<div class="field">
						<h6><?php //echo $emailErr; ?></h6>
						<input type="text" name="email" id="demo-email" value="<?php echo $_SESSION["Email"];?>" />
					</div>
					<ul class="actions">
						<li><input type="submit" value="Update" class="special" /></li>
						<li><a onclick="showBox('EmailDisplay', 'EmailModify')" class="button">Cancel</a></li>
					</ul>
				</form>
			</section>
			<a href="#">Modify Password</a>
			
		</p>
		
		<h2 id="AI"><u>Academic Information:</u></h2>
		<p>
			<h5 style="color:#B22222;">Classes you wish to tutor:</h5>
			<div class="table-wrapper">
				<table>
					<thead>
						<tr>
							<th>Subject Code</th>
							<th>Course Number</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>CSE</td>
							<td>12</td>
							<td><a href="#">Remove</a></td>
						</tr>
						
						<tr>
							<td>CSE</td>
							<td>130</td>
							<td><a href="#">Remove</a></td>
						</tr>
						
						<tr>
							<td>ENG</td>
							<td>100D</td>
							<td><a href="#">Remove</a></td>
						</tr>					
					</tbody>
					<tfoot>
						<tr>
							<td colspan="2"></td>
							<td><a href="#">Add more</a></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</p>
		
		<h2 id="HI"><u>History:</u></h2>
		<p>
			<h1 style="color:red">UNDER CONSTRUCTION</h1>
			<img src="../style/images/image-ba.jpg" width=300 height=300/>
			<h1 style="color:red">UNDER CONSTRUCTION</h1>
		</p>
	</div>
  </section>
  <?php showFooter(); ?>
  <script>
	function showBox(box, otherBox) {
		document.getElementById(box).style.display = "block";
		hideBox(otherBox);
	}
	
	function hideBox(box) {
		document.getElementById(box).style.display = "none";
	}
	
	function congratulate() {
		alert("Thank you, you have successfully been subscribed as a tutor! When there are new posts you can tutor we will let you know.");
	}
	
	function sad() {
		alert("Sad to see you go :(\nCome back any time!");
	}
  </script>
</body>
</html>

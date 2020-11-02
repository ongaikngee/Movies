<!-- THERE IS ONE QUERY YOU NEED TO FILL FOR THIS FILE. IT IS ON LINE 24. -->

<?php
session_start();
require "dbconfig/config.php"
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link type="text/css" rel="stylesheet" href="style.css">
	<script src="https://kit.fontawesome.com/b26b33266f.js" crossorigin="anonymous"></script>
</head>

<body>
	<?php include('header.php'); ?>
	<?php
	$username = $password = "";
	if (isset($_POST["login"])) {
		$username = $_POST["username"];
		$password = $_POST["password"];

		// Fill in the blank query here to allow user to log into the page //Done
		$query = "SELECT * FROM userinfo WHERE username = '$username' AND password = '$password'";
		$query_run = mysqli_query($con, $query);

		if (mysqli_num_rows($query_run) > 0) {
			$_SESSION["username"] = $username;
			header("location:homepage.php");
		} else {
			echo "<script> alert('Username or Password is incorrect.')</script>";
		}
	}
	?>
	<main>
		<div class="login_form mt-4 px-4">

			<h1>
				Please log in.</h1>
			<p>If you do not have any account with us, register now!
			</p>

			<h2>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="loginbox font-weight-normal">
					<div class="loginfield form-group">
						<span style="font-size: 20px; color: black;">
							<i class="fas fa-user"></i>
						</span><br>
						<input type="text" placeholder="Your Username" name="username" required>
					</div>

					<div class="loginfield form-group">
						<span style="font-size: 20px; color: black;">
							<i class="fas fa-lock"></i>
						</span><br>
						<input type="password" placeholder="Your Password" name="password" required>
					</div>

					<div>
						<input type="submit" class="btn btn-info m-1" id="loginbtn" value="Login" name="login">
						<input type="button" class="btn btn-info m-1" id="regbtn" value="Register" onclick="window.location.href = 'register.php'">
						<input type="button" class="btn btn-info m-1" id="chgbtn" value="Change Your Password" onclick="window.location.href = 'changepassword.php'">
						<input type="button" class="btn btn-info m-1" id="delbtn" value="Delete Your Account" onclick="window.location.href = 'delete.php'">
					</div>
				</form>
			</h2>
		</div>
	</main>
	<?php include('footer.php'); ?>
</body>

</html>
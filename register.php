<!-- THERE ARE TWO QUERIES(ONE SELECT AND ONE INSERT) YOU NEED TO FILL FOR THIS FILE. THEY ARE ON LINES 28 AND 35. -->


<?php
require "dbconfig/config.php"
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Registration Page</title>
	<script src="https://kit.fontawesome.com/b26b33266f.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<?php include('header.php'); ?>
	<main>
		<div class="login_form mt-4 px-4">

			<?php
			$username = $password = $cpassword = "";
			if (isset($_POST["reg_btn"])) {
				$username = $_POST["username"];
				$password = $_POST["password"];
				$cpassword = $_POST["cpassword"];

				if ($password == $cpassword) {
					// Fill in the query to check if there are any existing records of the username submitted //done
					$query = "SELECT * FROM userinfo WHERE username = '$username'";
					$query_run = mysqli_query($con, $query);

					if (mysqli_num_rows($query_run) > 0) {
						echo "<script> alert('Username taken')</script>";
					} else {
						// Fill in the query to register the user details into the database //done
						$query = "INSERT INTO userinfo (username, password) VALUES ('$username', '$password')";
						$query_run = mysqli_query($con, $query);

						if ($query_run) {
							echo "<script> alert('User registered! Proceed to Login.')</script>";
						} else {
							echo "<script> alert('Unable to create account')</script>";
						}
					}
				} else {
					echo "<script> alert('Passwords do not match!')</script>";
				}
			}
			?>
			<h1 class="pagehead">
				REGISTER
			</h1>

			<h2>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="loginbox">
					<div class="loginfield">
						<span style="font-size: 20px; color: black;">
							<i class="fas fa-user"></i>
						</span>
						<input type="text" placeholder="Your Username" name="username" required>
					</div>

					<div class="loginfield">
						<span style="font-size: 20px; color: black;">
							<i class="fas fa-lock"></i>
						</span>
						<input type="password" placeholder="Your Password" name="password" required>
					</div>

					<div class="loginfield">
						<span style="font-size: 20px; color: black;">
							<i class="fas fa-lock"></i>
						</span>
						<input type="password" placeholder="Confirm Password" name="cpassword" required>
					</div>

					<div>
						<input type="submit" class="btn btn-info m-1" id="registerbtn" value="Register Account" name="reg_btn">
						<br>
						<input type="button" class="btn btn-info m-1" id="backbtn" value="Back to Login Page" onclick="window.location.href = 'index.php'">
					</div>
				</form>

			</h2>
		</div>
	</main>
	<?php include('footer.php'); ?>
</body>

</html>
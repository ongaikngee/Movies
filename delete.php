<!-- THERE IS ONE QUERY YOU NEED TO FILL FOR THIS FILE. IT IS ON LINE 28. -->


<?php
require "dbconfig/config.php"
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<script src="https://kit.fontawesome.com/b26b33266f.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<?php include('header.php'); ?>
	<?php
	$username = $password = $cpassword = "";
	if (isset($_POST["delete"])) {
		$username = $_POST["username"];
		$password = $_POST["password"];

		$query = "SELECT * from userinfo WHERE username ='$username' AND password = '$password'";
		$query_run = mysqli_query($con, $query);

		if (mysqli_num_rows($query_run) > 0) {
			// Fill in the query to delete the user from the database //done
			$query = "DELETE from userinfo WHERE username = '$username'";
			$query_run = mysqli_query($con, $query);
			echo "<script> alert('Account deleted')</script>";
		} else {
			echo "<script> alert('Unable to delete account')</script>";
		}
	}
	?>
	<main>
		<div class="login_form mt-4 px-4">
			<h1 class="pagehead">
				DELETE
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

					<div>
						<input type="submit" class="btn btn-info m-1" id="delbtn" value="Delete" name="delete">
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
<?php
session_start();
if (!isset($_SESSION['username'])) {
	header("location:index.php");
}
require "dbconfig/config.php"
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome</title>
	<script src="https://kit.fontawesome.com/b26b33266f.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link type="text/css" rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">


</head>

<body>
	<?php include('header.php'); ?>
	<?php
	if (isset($_POST["logout"])) {
		session_destroy();
		header("location:index.php");
	}
	?>
	<?php include("navbar.php"); ?>
	<main>
		<div class="welcome">
			<h1>
				Welcome <?= $_SESSION['username']; ?>!
			</h1>
		</div>

		<div class="container movielist mb-5">

			<h3>Choose a movie to review!</h3>
			<div class="row">

				<?php
				$query = "SELECT movie_name FROM movies";
				$result = mysqli_query($con, $query);
				$x = 0;
				$movie = ["01", "02", "03", "04", "05", "06", "07", "08"];
				while ($row = mysqli_fetch_array($result)) {
					echo "<div class=\"moviebox col-12 col-md-6 col-lg-4\">";
					echo "<div>";
					$name = $row['movie_name'];
					echo "<img src=\"photos/mov$movie[$x].jpg\">";
					echo "<h4><a href='review.php?name=$name'> $name<br></a>
					</h4>";
					$x++;
					echo "</div>";
					echo "</div>";
				}
				?>
			</div>
		</div>
	</main>

	<?php include('footer.php'); ?>
</body>

</html>
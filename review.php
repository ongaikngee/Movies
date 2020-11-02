<!-- THERE ARE TWO QUERIES(ONE INSERT AND ONE JOIN) YOU NEED TO FILL FOR THIS FILE. THEY ARE ON LINES 62 AND 104. -->

<?php
session_start();
if (!isset($_SESSION['username'])) {
	header("location:index.php");
}
require "dbconfig/config.php"
?>

<?php
if (isset($_GET["name"])) {
	$name = $_GET["name"];
}
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

	<?php
	$user = $_SESSION['username'];
	$query = "SELECT user_id FROM userinfo WHERE username = '$user'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	$userid = $row['user_id'];
	?>

	<?php
	$movie = $_GET["name"];
	$query = "SELECT movie_id FROM movies WHERE movie_name = '$movie'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	$movieid = $row['movie_id'];
	?>

	<?php
	$rating = "";
	if (isset($_POST["rate"])) {
		$rating = $_POST["rating"];

		// Fill in the query to insert the rating into the database. Use $userid and $movieid for the values of user_id and movie_id columns respectively
		$query = "INSERT INTO movie_reviews (user_id, movie_id, ratings) VALUES ('$userid', '$movieid', $rating)";
		$query_run = mysqli_query($con, $query);

		if ($query_run) {
			echo "<script> alert('Rating added')</script>";
		}
	}
	?>

	<?php include("navbar.php"); ?>
	<main>
		<div class="movielist">
			<h2><?= $_GET['name'] ?></h2>
		</div>

		<div class="container-fluid">
			<div class="row">
				<div class="col-4"></div>
				<div class="col-4 rating">
					<form method="post" action="<?php echo htmlspecialchars('review.php?name=' . $name . ''); ?>">
						<h2>Rating(0.0 to 5.0)</h2>
						<input class="rating" type="number" name="rating" step="0.1" min="0" max="5">
						<input type="submit" value="Rate" name="rate">
					</form>
				</div>
				<div class="col-4"></div>
			</div>
		</div>

		<div class="container allratings">
			<div class="row">
				<div class="col-3"></div>
				<div class="col-6">
					<h2>All Ratings</h2>
					<?php
					$moviename = $_GET['name'];
					$query = "SELECT movie_id FROM movies WHERE movie_name = '$moviename' ";
					$result = mysqli_query($con, $query);
					$row = mysqli_fetch_array($result);
					$movieid = $row['movie_id'];

					// Fill in the query(JOIN) to join the userinfo and movie_reviews table together so that you can display the respective rating given by each username. Use $movieid to filter the records so that only the ratings for the selected movie is shown.
					$query = "SELECT * FROM movie_reviews m LEFT JOIN userinfo u ON m.user_id = u.user_id where movie_id = '$movieid'";
					$result = mysqli_query($con, $query);
					while ($row = mysqli_fetch_array($result)) {
						$userrating = $row['ratings'];
						$userthatrated = $row['username'];
						echo '<p class="userratings"><span style="color: orange;">' . $userthatrated . '</span> gives a rating of <span style="color: orange;">' . $userrating . '/5</span></p>';
					}
					?>
				</div>
				<div class="col-3"></div>
			</div>
		</div>
	</main>
	<?php include('footer.php'); ?>
</body>

</html>
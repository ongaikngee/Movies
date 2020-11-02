<nav class="navbar navbar-expand-sm bg-dark navbar-dark my-0">
	<div class="container-fluid">
		<a class="navbar-brand" href="homepage.php"><img src="photos/film.png" width=40px></a>



		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="yourreview.php?user=<?php echo $_SESSION['username']; ?>"> Your Reviews </a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="friends.php"> Friends </a>
			</li>
		</ul>

		<form method="post" class="form-inline" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<button class="btn btn-success" type="submit" name="logout">Logout</button>
		</form>
	</div>
</nav>
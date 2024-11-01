<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
</head>
<body>

<?php
session_start();
if (isset($_SESSION['error'])) {
    echo "<p style='color:red;'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']); // Clear the error message after displaying it
}
?>

	<p>Register here</p>
	<form action="main/handleForms.php" method="POST">
		<div class="fields">
			<p><input type="text" placeholder="username here" class="fields" name="username"></p>
			<p><input type="password" placeholder="password here" class="fields" name="password"></p>
			<p><input type="submit" value="Register" id="submitBtn" name="regBtn"></p>
		</div>
	</form>
</body>
</html>
<?php 
session_start();

if(!isset($_SESSION['username'])) {
	header('Location: index.php');
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

<?php

// Display login message if set
if (isset($_SESSION['loginMessage'])) {
    echo "<p style='color:green;'>" . $_SESSION['loginMessage'] . "</p>";
}

?>

    <h1>Welcome to the Bookstore</h1>

    <!-- Buttons for Authors and Books -->
    <div class="button-container">
        <button onclick="window.location.href='authors.php'">Authors</button>
        <button onclick="window.location.href='books.php'">Books</button>
        <button onclick="window.location.href='viewLibrary.php'">Library</button>
    </div>

    <a href="logout.php" class="logout-button">Logout</a>

</body>
</html>

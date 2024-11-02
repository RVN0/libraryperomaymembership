<!-- THE INDEX.PHP WILL SERVE AS THE "LOGIN.PHP" AND THE "MAINPAGE.PHP" IS THE INDEX too late na nung narealize ko HWAHAAH :> -->
<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <!-- Error Message -->
    <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($_SESSION['error']); ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>


    <div class="form-wrapper">
        <h1>Welcome</h1>
        <?php if (isset($_SESSION['firstName'])): ?>
            <h2>User logged in: <?php echo htmlspecialchars($_SESSION['firstName']); ?></h2>
            <a href="unset.php">Logout</a>
        <?php else: ?>
            <?php if (isset($_SESSION['error'])): ?>
                <p style="color:red;"><?php echo $_SESSION['error']; ?></p>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <h2>Login</h2>
            <form action="main/handleForms.php" method="POST">
                <input type="text" placeholder="Username" class="fields" name="username">
                <input type="password" placeholder="Password" class="fields" name="password">
                <input type="submit" value="login" id="loginBtn" name="loginBtn">
            </form>

            <a href="register.php" class="RegButton">Register</a>
        <?php endif; ?>
    </div>
</body>

</html>

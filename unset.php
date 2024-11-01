<?php  
session_start();
session_unset();
session_destroy(); // Destroy the session completely
header('Location: index.php'); // Go back to homepage
exit();
?>
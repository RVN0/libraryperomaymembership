<?php  
function addUser($pdo, $username, $password) {
    // Check if the username already exists
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);

    if ($stmt->rowCount() == 0) {
        // Insert new user if username does not exist
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$username, $password]); // return true on success, false on failure
    }
    return false; // Username already exists
}



function login($pdo, $username, $password) {
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username]);

    if ($stmt->rowCount() === 1) {

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Store user info as a session variable
        $_SESSION['userInfo'] = $row;

        // Get values from the retrieved row
        $uid = $row['user_id'];
        $passHash = $row['password'];

        // Validate password 
        if (password_verify($password, $passHash)) {
            $_SESSION['user_id'] = $uid;
            $_SESSION['username'] = $row['username'];
            $_SESSION['userLoginStatus'] = 1;

            // Set a session message indicating who is logged in
            $_SESSION['loginMessage'] = "Welcome, " . $row['username'] . "!";
            return true; // Login successful
        } else {
            $_SESSION['error'] = "Incorrect password. Please try again.";
            header("Location: ../index.php");
            exit();
        }
    }
    $_SESSION['error'] = "Username not found. Please try again.";
        header("Location: ../index.php");
        exit();
}


?>
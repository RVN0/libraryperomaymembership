<?php

session_start(); // Start the session at the beginning

$userId = $_SESSION['user_id'];

require_once 'dbConfig.php'; 
require_once 'models.php';
require_once 'functions.php';

if (isset($_POST['insertauthorBtn'])) {
    $username = $_SESSION['username']; 
    $query = insertauthor($pdo, $_POST['firstName'], $_POST['lastName'], $username);

    if ($query) {
        header("Location: ../authors.php");
    } else {
        echo "Insertion failed";
    }
}


if (isset($_POST['editauthorBtn'])) {
    $id = $_GET['id'] ?? null;

    if ($id) {
        $username = $_SESSION['username'];
        if (updateauthor($pdo, $_POST['firstName'], $_POST['lastName'], $username, $id)) {
            header("Location: ../authors.php");
            exit();
        }
    } 
}

if (isset($_POST['deleteauthorBtn'])) {
    $query = deleteauthor($pdo, $_GET['id']);

    if ($query) {
        header("Location: ../authors.php");
        exit();
    } else {
        $_SESSION['error'] = "Deletion failed.";
        header("Location: ../authors.php");
        exit();
    }
}

if (isset($_POST['insertBookBtn'])) {
    $author_id = $_POST['author_id'];
    $bookTitle = $_POST['bookTitle'];
    $bookGenre = $_POST['BookGenre']; 
    $isFinished = isset($_POST['isFinished']) ? 1 : 0;

    $query = insertbook($pdo, $author_id, $bookTitle, $bookGenre, $isFinished, $userId); 

    if ($query) {
        header("Location: ../books.php?id=" . $author_id); // Redirect to the books page
        exit;
    } else {
        echo "Insertion failed";
    }
}


if (isset($_POST['editBookBtn'])) {
    $author_id = $_POST['author_id'];
    $bookTitle = $_POST['bookTitle'];
    $bookGenre = $_POST['bookGenre'];
    $isFinished = isset($_POST['isFinished']) ? 1 : 0;

    $query = updatebook($pdo, $author_id, $bookTitle, $bookGenre, $isFinished, $_GET['id'], $userId);

    if ($query) {
        header("Location: ../books.php"); // Redirect after successful update
        exit();
    } else {
        $_SESSION['error'] = "Update failed.";
        header("Location: ../books.php?id=" . $_GET['id']); // Redirect back to the edit page
        exit();
    }
}


if (isset($_POST['deleteBookBtn'])) {
    $query = deletebook($pdo, $_GET['id']);

    if ($query) {
        header("Location: ../books.php");
        exit();
    } else {
        $_SESSION['error'] = "Deletion failed.";
        header("Location: ../books.php");
        exit();
    }
}

if (isset($_POST['regBtn'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "The input field is empty!";
        header('Location: ../register.php');
        exit();
    } else {
        if (addUser($pdo, $username, $password)) {
            header('Location: ../index.php');
            exit();
        } else {
            $_SESSION['error'] = "Username already exists or insertion failed.";
            header('Location: ../register.php');
            exit();
        }
    }
}

if (isset($_POST['loginBtn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 'Input fields cannot be empty!';
        header('Location: index.php');
        exit();
    } else {
        if (login($pdo, $username, $password)) {
            header('Location: ../mainpage.php');
            exit();
        } else {
            $_SESSION['error'] = 'Invalid username or password!';
            header('Location: index.php');
            exit();
        }
    }
}
?>

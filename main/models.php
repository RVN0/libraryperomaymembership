<?php

function insertauthor($pdo, $firstName, $lastName, $username) {
    $sql = "INSERT INTO author (firstName, lastName, username, DateAdded) VALUES (?, ?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$firstName, $lastName, $username]);
    return true;
}

function updateauthor($pdo, $firstName, $lastName, $username, $id) {
    $sql = "UPDATE author
            SET firstName = ?, lastName = ?, username = ?, ChangeDate = NOW()
            WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$firstName, $lastName, $username, $id]);
    return true;
}


function deleteauthor($pdo, $id) {
    $deleteauthor = "DELETE FROM author WHERE id = ?";
    $deleteStmt = $pdo->prepare($deleteauthor);
    return $deleteStmt->execute([$id]);
}

function getAllauthor($pdo) {
    $sql = "SELECT * FROM author";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getauthorByID($pdo, $id) {
    $sql = "SELECT * FROM author WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getbooksByauthor($pdo, $author_id = null) {
    $sql = "SELECT b.*, u.username 
            FROM books b 
            LEFT JOIN users u ON b.user_id = u.user_id";
    
    $params = [];
    
    if ($author_id !== null) {
        $sql .= " WHERE b.author_id = ?";
        $params[] = $author_id;
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function insertbook($pdo, $author_id, $bookTitle, $bookGenre, $isFinished, $userId) {
    $sql = "INSERT INTO books (author_id, bookTitle, bookGenre, isFinished, user_id, changeDate) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$author_id, $bookTitle, $bookGenre, $isFinished, $userId]);
}

function getBooksByID($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
}

function updatebook($pdo, $author_id, $bookTitle, $bookGenre, $isFinished, $id, $userId) {
    $sql = "UPDATE books SET author_id = ?, bookTitle = ?, bookGenre = ?, isFinished = ?, user_id = ?, changeDate = NOW() WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$author_id, $bookTitle, $bookGenre, $isFinished, $userId, $id]);
}


function deletebook($pdo, $id) {
    $sql = "DELETE FROM books WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$id]);
}

function getAuthorsWithBooks($pdo) {
    $sql = "
        SELECT a.id, a.firstName, a.lastName, b.bookTitle, u.username, a.changeDate
        FROM author a
        LEFT JOIN books b ON a.id = b.author_id
        LEFT JOIN users u ON a.user_id = u.user_id
        ORDER BY a.id
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $authors = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $authors[$row['id']]['id'] = $row['id'];
        $authors[$row['id']]['firstName'] = $row['firstName'];
        $authors[$row['id']]['lastName'] = $row['lastName'];
        $authors[$row['id']]['books'][] = [
            'bookTitle' => $row['bookTitle']
        ];
        $authors[$row['id']]['username'] = $row['username'];
        $authors[$row['id']]['changeDate'] = $row['changeDate'];
    }

    return array_values($authors);
}

?>

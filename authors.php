<?php
require_once 'main/dbConfig.php';
require_once 'main/models.php';

$authors = getAllauthor($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authors</title>
    <link rel="stylesheet" href="style/authorstyle.css">
</head>
<body>
    <h1>Authors</h1>

    <a href="mainpage.php" class="back-button">Back to Authors</a>
    
    <form action="main/handleForms.php" method="POST">
        <p>
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" id="firstName" required>
        </p>
        <p>
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" id="lastName" required>
        </p>
        <button type="submit" name="insertauthorBtn">Add Author</button>
    </form>

    <table>
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date Added</th>
            <th>Changed By</th>
            <th>Change Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($authors as $author): ?>
            <tr>
                <td><?= htmlspecialchars($author['firstName']) ?></td>
                <td><?= htmlspecialchars($author['lastName']) ?></td>
                <td><?= htmlspecialchars($author['DateAdded']) ?></td>
                <td><?= htmlspecialchars($author['username']) ?></td>
                <td><?= htmlspecialchars($author['changeDate']) ?></td>
                <td>
                    <div class="button-container">
                        <a href="editaut.php?id=<?= $author['id'] ?>" class="button">Edit</a>
                        <a href="deleteaut.php?id=<?= $author['id'] ?>" class="button delete" onclick="return confirm('Are you sure you want to delete this author?')">Delete</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>

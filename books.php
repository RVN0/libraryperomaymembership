<?php 
require_once 'main/models.php'; 
require_once 'main/handleForms.php'; 

$books = getbooksByauthor($pdo);
$authors = getAllauthor($pdo);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
    <link rel="stylesheet" href="bookstyle.css">
</head>
<body>
<h1>Books</h1>
    
    <a href="mainpage.php" class="back-button">Back to Authors</a>

    <form action="main/handleForms.php" method="POST">   
        <label for="authorId">Author ID:</label>
        <select name="author_id" required>
            <option value="">Select Author</option>
            <?php foreach ($authors as $author): ?>
                <option value="<?= htmlspecialchars($author['id']) ?>"><?= htmlspecialchars($author['id']) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="bookTitle">Book Title:</label>
        <input type="text" name="bookTitle" required>

        <label for="BookGenre">Book Genre:</label>
        <input type="text" name="BookGenre" required>

        <label for="isFinished">Is Finished:</label>
        <input type="checkbox" name="isFinished" value="1"> 

        <button type="submit" name="insertBookBtn">Insert Book</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Author ID</th>
                <th>Title</th>
                <th>Genre</th>
                <th>Status</th>
                <th>Date Added</th>
                <th>Changed By</th>
                <th>Change Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($books)): ?>
                <tr>
                    <td colspan="8">No books available.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?= htmlspecialchars($book['author_id']) ?></td>
                        <td><?= htmlspecialchars($book['bookTitle']) ?></td>
                        <td><?= htmlspecialchars($book['bookGenre']) ?></td>
                        <td><?= $book['isFinished'] ? 'Finished' : 'In Progress' ?></td>
                        <td><?= htmlspecialchars($book['DateAdded']) ?></td>
                        <td><?= htmlspecialchars($book['username']) ?></td>
                        <td><?= htmlspecialchars($book['changeDate']) ?></td>
                        <td>
                            <div class="button-container">
                                <a href="editinv.php?id=<?= $book['id'] ?>" class="button">Edit</a>
                                <a href="deleteinv.php?id=<?= $book['id'] ?>" class="button delete" onclick="return confirm('Are you sure you want to delete this book?')">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

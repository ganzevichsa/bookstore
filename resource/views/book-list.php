<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
</head>
<body>
    <h1>Список книг</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Название</th>
                <th>Автор</th>
                <th>Жанр</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['book']) && is_array($data['book'])) : ?>
                <?php foreach ($data['book'] as $book): ?>
                    <tr>
                        <td><?php echo $book['title']; ?></td>
                        <td><?php echo $book['author']; ?></td>
                        <td><?php echo $book['genre']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="3">Нет данных о книгах.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

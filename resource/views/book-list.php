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
                <th>ID</th>
                <th>Название</th>
                <th>Автор</th>
                <th>Год</th>

            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['books']) && is_array($data['books'])) : ?>
                <?php foreach ($data['books'] as $book): ?>
                    <tr>
                        <td><?php echo $book['book_id']; ?></td>
                        <td><?php echo $book['book_title']; ?></td>
                        <td><?php echo $book['authors_list']; ?></td>
                        <td><?php echo $book['book_year']; ?></td>

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

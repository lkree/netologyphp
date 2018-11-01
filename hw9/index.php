<?php
    $pdo = new PDO("mysql:host=localhost;dbname=netology", "root", "");
    $sql = "SELECT * FROM books";

    if (!empty($_GET['isbn'])) {
        $sql = "SELECT * FROM books WHERE isbn LIKE :ISBN";
        $statement = $pdo->prepare($sql);
        $statement->execute(["ISBN" => "%{$_GET['isbn']}%"]);
        $sql = $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    if (!empty($_GET['name'])) {
        $sql = "SELECT * FROM books WHERE name LIKE :NAME";
        $statement = $pdo->prepare($sql);
        $statement->execute(["NAME" => "%{$_GET['name']}%"]);
        $sql = $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    if (!empty($_GET['author'])) {
        $sql = "SELECT * FROM books WHERE author LIKE :author";
        $statement = $pdo->prepare($sql);
        $statement->execute(["author" => "%{$_GET['author']}%"]);
        $sql = $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    if (empty($sql)) {
        $sql = "SELECT * FROM books";
        echo 'Ничего не найдено по вашему запросу :(';
    }
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
        table, tr {
            border: 1px solid black;
            border-collapse: collapse;
        }
        td, th {
            width: 140px;
            text-align: left;
        }
        form {
            margin-bottom: 20px;
        }
        </style>
    </head>
    <body>
    <form method="GET" action="">
        <input type="text" name="isbn" placeholder="ISBN" value="">
        <input type="text" name="name" placeholder="Имя" value="">
        <input type="text" name="author" placeholder="Автор" value="">
        <input type="submit" value="Поиск">
    </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>AUTHOR</th>
                    <th>YEAR</th>
                    <th>ISBN</th>
                    <th>GENRE</th>
                </tr>
            </thead>
            <tbody>
                <?php if (is_array($sql)) {
                    foreach($sql as $v) { ?>
                        <tr>
                        <td><?php echo $v['id'] ?></td>
                        <td><?php echo $v['name'] ?></td>
                        <td><?php echo $v['author'] ?></td>
                        <td><?php echo $v['year'] ?></td>
                        <td><?php echo $v['isbn'] ?></td>
                        <td><?php echo $v['genre'] ?></td>
                    </tr>
                   <?php }
                } else {
                    foreach($pdo->query($sql) as $v):?>
                    <tr>
                        <td><?php echo $v['id'] ?></td>
                        <td><?php echo $v['name'] ?></td>
                        <td><?php echo $v['author'] ?></td>
                        <td><?php echo $v['year'] ?></td>
                        <td><?php echo $v['isbn'] ?></td>
                        <td><?php echo $v['genre'] ?></td>
                    </tr>
                <?php endforeach; }?>
            </tbody>
        </table>
    </body>
</html>
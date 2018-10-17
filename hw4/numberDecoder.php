<?php
    $json = file_get_contents(__DIR__.'/some.json');
    $json = json_decode($json, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NoteBook</title>
</head>
<body>
    <?php
        foreach ($json as $fullAdress) : ?>
    <p><b>Имя:</b><?php echo $fullAdress['firstName'] ?></p>
    <p><b>Фамилия:</b><?php echo $fullAdress['lastName'] ?></p>
    <p><b>Адрес:</b><?php echo $fullAdress['address']['streetAddress'] ?></p>
    <p><b>Город: </b><?php echo $fullAdress['address']['city'] ?></p>
    <p><b>Почтовый индекс: </b><?php echo $fullAdress['address']['postalCode'] ?></p>
    <?php foreach ($fullAdress['phoneNumbers'] as $k => $v) : ?>
    <p><b>Номер телефона: </b><?php echo $v ?></p>
    <?php endforeach; endforeach; ?>
</body>
</html>
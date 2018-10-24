<?php
function goingBackUrl() { ?>
    <br>
    <a href="admin.php">Вернуться назад</a>
<?php }
function goingToTests() { ?>
    <br>
    <a href="list.php">Попробовать пройти тест</a>
<?php } ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        if (empty($_POST['result'])) { ?>
    <form action="admin.php" method="POST" style="margin: 40vmin auto; width: 200px;" enctype="multipart/form-data">
        <label for="upload-form">
            <p>Пожалуйста, загрузите ваш файл (желательно *.json)</p>
        </label>
        <input type="file" id="upload-form" name="json" required>
        <div>&nbsp;</div>
        <input type="submit" style="display: block" value="Отправить" name="result">
        <?php goingToTests() ?>
    </form>
    <br>
<?php

        } else {
            $fileName = substr($_FILES['json']['name'], -4);
            if ($fileName === 'json') {
            $uploadDir = __DIR__.'\tests\\';
            $uploadFile = $uploadDir . basename($_FILES['json']['name']);

            if (move_uploaded_file($_FILES['json']['tmp_name'], $uploadFile)) {
                echo 'Файл корректен и был успешно загружен.';
                goingBackUrl();
                goingToTests();
            } else {
                echo 'Что-то пошло не так';
                goingBackUrl();
            }
            } else {
                echo 'Загрузите, пожалуйста, файл типа *.json';
                goingBackUrl();
            } 
        } ?>
</body>
</html>
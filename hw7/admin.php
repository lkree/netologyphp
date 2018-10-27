<?php
    include_once('functions.php');

    if (!empty($_POST['result'])) {
        $fileName = substr($_FILES['json']['name'], -4);

        if ($fileName === 'json') {
            $uploadDir = __DIR__.'\tests\\';
            $uploadFile = $uploadDir . basename($_FILES['json']['name']);

        if (move_uploaded_file($_FILES['json']['tmp_name'], $uploadFile)) {
        header("Location: list.php");

        } else {
        http_response_code(404);
        echo 'Что-то пошло не так';
        goingBackUrl();
        }

        } else {
        echo 'Загрузите, пожалуйста, файл типа *.json';
        goingBackUrl();
        } 

    } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>    
    <form action="admin.php" method="POST" style="margin: 40vmin auto; width: 200px;" enctype="multipart/form-data">
        <label for="upload-form">
            <p>Пожалуйста, загрузите ваш файл (желательно *.json)</p>
        </label>
        <input type="file" id="upload-form" name="json" required>
        <div>&nbsp;</div>
        <input type="submit" style="display: block" value="Отправить" name="result">
<?php goingToTests(); } ?>
    </form>
    <br>         
</body>
</html>
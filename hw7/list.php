<?php
    $testsList = [];
    include_once('functions.php');

    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        http_response_code(403);
    } else {
        if (!empty($_POST)) {
            foreach($_POST as $k => $v) {
                unlink($k.'.json');
            }
        }

        foreach (glob('tests/*.json') as $json) {
            $testsList[] = $json;
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="choose-test">
        <?php
        foreach ($testsList as $k => $v):
            $link = substr($v, 0, -5); ?>
        <a class="choose-test--btn" href="test.php?test=<?php echo $link ?>">Тест №<?php echo $k +1 ?></a>
        <?php endforeach; ?>
    </div>
    <?php
        if ($_SERVER['PHP_AUTH_USER'] === loginDecoder()['admin']['login'] 
        && $_SERVER['PHP_AUTH_PW'] === loginDecoder()['admin']['password']) : ?>
    <a class ="choose-test--btn another-test" href="admin.php">Загрузить еще один тест?</a>
        <?php foreach ($testsList as $k => $v):
                $v = substr($v, 0, -5); ?>
            <form action="" method="post" class="delete-test">
            <input class="delete-test--btn" type="submit" value="Удалить тест №<?php echo $k +1 ?>" name="<?php echo $v ?>">
        </form>
        <?php endforeach; endif; ?>
</body>
</html>

    <?php }
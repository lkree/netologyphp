<?php
    $testsList = [];

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
    <a class ="choose-test--btn another-test" href="admin.php">Загрузить еще один тест?</a>
</body>
</html>
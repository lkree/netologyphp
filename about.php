<?php

$myAge = 26;
$myName = 'Leonid';
$myEmail = 'xtendmix@gmail.com';
$myCity = 'Yaroslavl';
$aboutMySelf = 'something about myself i have to write in this row.';
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
    <p>Мой возраст: <?=$myAge;?></p>
    <p>Моё имя: <?=$myName;?></p>
    <p>Мой маил: <?=$myEmail;?></p>
    <p>Мой город: <?=$myCity;?></p>
    <p>Что-то обо мне: <?=$aboutMySelf;?></p>
</body>
</html>


<?php
$usersNumber = $_GET['x'];
if (isset($usersNumber)) {
    $usersNumber = intval($usersNumber);
    $variableA = 1;
    $variableB = 1;
    do {
    if ($usersNumber >= $variableA) {
        if (!($usersNumber === $variableA)) {
            $variableC = $variableA;
            $variableA += $variableB;
            $variableB = $variableC;
        } else {
            echo 'задуманное число входит в числовой ряд';
            die;
        }
    } else {
        echo 'задуманное число НЕ входит в числовой ряд';
        die;
    }
} while ($variableA <= $usersNumber);
}
if ($usersNumber < $variableA) {
    echo 'задуманное число НЕ входит в числовой ряд';
}
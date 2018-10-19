<?php
include_once('list.php');
$json = startJson();

function startJson() {
    $json = file_get_contents(__DIR__.'/tests.json');
    $json = json_decode($json, true);
    return $json;
}

if (!empty($_GET['test'])) {
    $json = startJson();
    $testNumber = $_GET['test'];

    switch ($testNumber) {
        case 1:
            $json['testFirst']['startTest']();
            break;
        case 2:
            $json['testSecond']['startTest']();
            break;
        case 3:
            $json['testThird']['startTest']();
            break;
        case 4:
            $json['testFourth']['startTest']();
            break;
        default:
            echo 'Несуществующий тест';
            break;
    }
} elseif (!empty($_GET['result'])) {
    $json = startJson();

    if ($_GET['test1'] == $json['testFirst']['trueResult'] && $_GET['result'] == 'done') {
        echo '<h1>'.'You win'.'</h1>';
        tryOneMoreTime();
    } elseif ($_GET['test2'] == $json['testSecond']['trueResult'] && $_GET['result'] == 'done') {
        echo '<h1>'.'You win'.'</h1>';
        tryOneMoreTime();
    } elseif ($_GET['test3'] == $json['testThird']['trueResult'] && $_GET['result'] == 'done') {
        echo '<h1>'.'You win'.'</h1>';
        tryOneMoreTime();
    } elseif ($_GET['test4'] == $json['testFourth']['trueResult'] && $_GET['result'] == 'done') {
        echo '<h1>'.'You win'.'</h1>';
        tryOneMoreTime();
    } else {
        echo '<h1>'.'You lose'.'</h1>';
        tryOneMoreTime();
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
    <style>
        .choose-test {
            margin: 40vmin auto;
            text-align: center;
            vertical-align: top;
        }
        .choose-test--btn {
            box-sizing: border-box;
            display: inline-block;
            width: 80px;
            height: 30px;
            border: 1px solid #000;
            text-decoration: none;
            color: #000;
            padding-top: 5px;
        }
        .choose-test--btn:hover {
            background-color: red;
            color: #fff;
            transition: all 0.5s linear;
        }
    </style>
</head>
<body>
    <div class="choose-test">
        <a class="choose-test--btn" href="?test=1">1</a>
        <a class="choose-test--btn" href="?test=2">2</a>
        <a class="choose-test--btn" href="?test=3">3</a>
        <a class="choose-test--btn" href="?test=4">4</a>
    </div>
</body>
</html>
<?php }?>
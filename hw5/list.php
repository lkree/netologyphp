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
        <?php
        foreach ($testsList as $k => $v):
            $link = substr($v, 0, -5); ?>
        <a class="choose-test--btn" href="test.php?test=<?php echo $link ?>"><?php echo $k ?></a>
        <?php endforeach; ?>
    </div>
</body>
</html>
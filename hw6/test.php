<?php
    if (empty($_GET)) { ?>
    <a href="list.php">Try some test</a>
    <?php die(); 
    } elseif (!(@file_get_contents(__DIR__ .DIRECTORY_SEPARATOR.
     $_GET['test']. '.json'))) {
        http_response_code(404);
        die('Что-то пошло не так'.'<br>'.
        '<a href="list.php">Try another test</a>');
    }
    elseif (empty($_POST)) {
        include_once('functions.php');
        formName();
    } else {

    if(!empty($_POST['usersName'])) {
        $fileForName = fopen('names.txt', 'r+');
        file_put_contents('names.txt', $_POST['usersName']);
        fclose($fileForName);
    }

    if (!empty($_GET['test'])) {
        $json = file_get_contents(__DIR__ .DIRECTORY_SEPARATOR. $_GET['test']. '.json');
        $json = json_decode($json, true);
    }

    function tryOneMoreTime() {?>
    <br>
    <a href="test.php?test=<?php echo $_GET['test'] ?>">Try one more time</a>
    <br>
    <a href="list.php">Try another test</a>
    <?php }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tests</title>
</head>
<body>
<form action="" method="POST">
    <?php if (empty($_POST['result'])) : ?>
    <fieldset>
        <?php foreach ($json as $k => $v) : ?>
      <legend><?php echo $json[$k]['question'][0] ?></legend>
      <?php
      foreach ($json[$k]['answers'] as $key => $value) : ?>
        <label><input type="radio" name="<?php echo $k ?>" value="<?php echo $value ?>"> <?php echo $value ?></label>
    <?php endforeach;  endforeach; ?>
    </fieldset>
    <input type="submit" value="done" name="result">
    <?php endif; ?>
</form>


    <?php
    if (count($_POST) == 1 && empty($_POST['usersName'])) {
        echo '<h1>'.'Please, answer at least one question'.'</h1>';
        tryOneMoreTime();
    } else
    foreach ($json as $k => $v) {
        if (!empty($_POST['result']) && !empty($_POST[$k])) {
            if ($_POST[$k] == $json[$k]['trueAnswer'][0]) {
                $anotherFile = fopen('grade.txt', 'r+');
                file_put_contents('grade.txt', 5);
                fclose($anotherFile);
                echo '<h1>'.'You win'.'</h1>'. '<img src="generateImage.php">';
                tryOneMoreTime();
            
            } else {
                $anotherFile = fopen('grade.txt', 'r+');
                file_put_contents('grade.txt', 2);
                fclose($anotherFile);
                echo '<h1>'.'You lose'.'</h1>'. '<img src="generateImage.php">';
                tryOneMoreTime();
            }
        }
    } 
}?>
</body>
</html>
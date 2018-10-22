<?php
    if (empty($_GET)) { ?>
    <a href="list.php">Try some test</a>
    <?php die(); 
    } else {?>

<?php
    if (!empty($_GET['test'])) {
    $json = file_get_contents(__DIR__ .'\\'. $_GET['test']. '.json');
    $json = json_decode($json, true);
    $i = 0;
    }

    function tryOneMoreTime() {?>
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
      <legend><?php echo $json['question'][0] ?></legend>
      <?php
      foreach ($json['answers'] as $v) : ?>
        <label><input type="radio" name="answer" value="<?php echo $i ?>"> <?php echo $json['answers'][$i] ?></label>
    <?php $i++; endforeach; ?>
    </fieldset>
    <input type="submit" value="done" name="result">
    <?php endif; ?>
</form>


    <?php
        if (!empty($_POST['result']) && !empty($_POST['answer'])) {
            if ($_POST['answer'] == $json['trueAnswer'][0]) {
                echo '<h1>'.'You win'.'</h1>';
                tryOneMoreTime();
            } else {
                echo '<h1>'.'You lose'.'</h1>';
                tryOneMoreTime();
            }
        } elseif (isset($_POST['result']) && $_POST['answer'] == 0) {
            echo '<h1>'.'You lose'.'</h1>';
            tryOneMoreTime();

        } elseif (isset($_POST['result']) && empty($_POST['answer'])) {
            tryOneMoreTime();
    }
}?>
</body>
</html>
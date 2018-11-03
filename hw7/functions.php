<?php
    function formName () { ?>
<form action="" method="POST">
    <label for="usersName">
        Введите ваше имя:
        <input type="text" name="usersName" id="usersName">
    </label>
    <input type="submit" name="submit">
</form>
<?php } 
    function tryOneMoreTime() {?>
    <br>
    <a href="test.php?test=<?php echo $_GET['test'] ?>">Try one more time</a>
    <br>
    <a href="list.php">Try another test</a>
    <?php }

    function goingBackUrl() { ?>
        <br>
        <a href="admin.php">Вернуться назад</a>
    <?php }

    function goingToTests() { ?>
        <br>
        <a href="list.php">Попробовать пройти тест</a>
    <?php }

    function loginDecoder() {
        if (!@file_get_contents(__DIR__. '/users/login.json')) {
            die('something goes wrong');

        } else {
        $loginJson = file_get_contents(__DIR__. '/users/login.json');
        $loginJson = json_decode($loginJson, true);
        
        return $loginJson;
        }
    }

    // function loginEncoder($newLogin, $newPassword, $newRole = 'guest') {
    //     if (!@file_get_contents(__DIR__. '/users/login.json')) {
    //         die('something goes wrong');

    //     } else {
    //         $loginJson = file_get_contents(__DIR__. '/users/login.json');
    //         $loginJson = json_decode($loginJson, true);

    //         $loginJson[$newLogin] = [$newLogin => [
    //             'login' => $newLogin,
    //             'password' => $newPassword,
    //             'role' => $newRole
    //         ]];

    //         $loginJson = json_encode($loginJson);

    //         file_put_contents(__DIR__. '/users/login.json', $loginJson);
    //     }
    // }

    function getPermission() {
        if (empty($_SESSION['permissions'])) {
            http_response_code(403);
            exit('403 Forbidden');
        }
    }

    function getAuthorization() { ?>
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
            <form action="" method="POST">
                <label for="login">Введите логин</label>
                    <input type="text" name="login" id="login">
                <label for="password">Введите пароль</label>
                    <input type="password" name="password" id="password">
                <input type="submit" name="submit">
            </form>
        </body>
        </html>
    <?php }

    function disconnect() { ?>
        <link rel="stylesheet" href="style.css">
            <form action="" method="post">
                <label for="relogin">Хотите зайти под другой учетной записью?</label>
                    <input type="submit" value="Выйти" name="relogin">
            </form>
    <?php exit();
    }

    function permissionDenied() {
        $_SESSION = [];
        echo 'Вы ввели несуществующий логин пароль.'.'<br>'.
        'Для доступа как гость, введите только логин.'.'<br>'.
        'Для доступа как админ, введите логин и пароль администратора.';?>
        <br>
        <a href="#">Попробовать еще раз</a>

    <?php }
<?php
    session_start();
    include_once('functions.php');

    if (!empty($_POST['relogin'])) {
        $_SESSION = [];
        header('Location: index.php');
    }

    if (empty($_POST['login']) && empty($_POST['password']) && empty($_SESSION['permissions'])) {
        getAuthorization();
    }

    if (!empty($_POST['login']) && empty($_POST['password'])) {
        $_SESSION['permissions'] = 'guest';
        header('Location: list.php');
    }

    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        if ($_POST['login'] === loginDecoder()['admin']['login'] 
        && $_POST['password'] === loginDecoder()['admin']['password']) {
            $_SESSION['permissions'] = 'admin';
            header('Location: list.php');
        } else {
            $_SESSION = [];
            echo 'Вы ввели несуществующий логин пароль.'.'<br>'.
            'Для доступа как гость, введите только логин.'.'<br>'.
            'Для доступа как админ, введите логин и пароль администратора.';
        }
    }

    if (!empty($_SESSION['permissions'])) {
    disconnect();
    }
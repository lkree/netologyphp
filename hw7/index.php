<?php
    session_start();
    include_once('functions.php');

    if (!empty($_POST['relogin'])) {
        $_SESSION = [];
        session_destroy();
        header('Location: index.php');
    }

    if (empty($_POST['login']) && empty($_POST['password']) && empty($_SESSION['permissions'])) {
        getAuthorization();
    }

    if (!empty($_POST['login']) && empty($_POST['password'])) {
        $_SESSION['permissions'] = 'guest';
        $_SESSION['name'] = $_POST['login'];
        header('Location: list.php');
    }

    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        if ($_POST['login'] === loginDecoder()['admin']['login'] 
        && $_POST['password'] === loginDecoder()['admin']['password']) {
            $_SESSION['permissions'] = 'admin';
            $_SESSION['name'] = $_POST['login'];
            header('Location: list.php');
        } else {
            permissionDenied();
        }
    }

    if (!empty($_SESSION['permissions'])) {
        disconnect();
    }
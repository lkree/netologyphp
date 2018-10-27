<?php
    session_start();
    include_once('functions.php');

    if (empty($_SERVER['PHP_AUTH_USER'])) {
        header('WWW-Authenticate: Basic realm="Realm"');

        http_response_code(401);
        echo 'Пожалуйста, авторизуйтесь. Введите логин/пароль администратора или введите случайный лог/пасс и войдите как гость.';
        exit;
    } else {
        if ($_SERVER['PHP_AUTH_USER'] === loginDecoder()['admin']['login'] 
        && $_SERVER['PHP_AUTH_PW'] === loginDecoder()['admin']['password']) {
            header('Location: list.php');
        } else {
            loginEncoder($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);
            header('Location: list.php');
        }   
    }
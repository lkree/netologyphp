<?php
    function booksApi ($argv) {
        error_reporting(4); // почему-то ругается на часть массива полученного из гугла (якобы 2 пустых)
        if (isset($argv[1])) { // проверяем на наличие параметров
            array_shift($argv);
            $stringBookName = '';
            foreach ($argv as $k => $v) { // записываем все параметры в строку, на случай составного имени книги
                $stringBookName .= $v. ' ';
            }
            $stringBookName = urlencode(substr($stringBookName, 0, -1)); // переводим строку в часть урл
            $jsonBook = 'https://www.googleapis.com/books/v1/volumes?q=' . $stringBookName;
            if (@fopen($jsonBook, "r")) { // проверяем возможность соединиться с удаленным сервером
                $jsonBook = json_decode(file_get_contents($jsonBook), true); // превращаем полученный json в массив
                if (!(json_last_error())) { // если не было ошибок продолжаем работу
                    foreach ($jsonBook as $k => $v) { // разбираем массив на части
                        if ($jsonBook['totalItems'] == 0) { // если книга не найдена
                            echo 'К сожалению такая книга не найдена :(';
                            break;
                        } else {
                            fopen('booksAndAuthors.csv', 'w'); // создаем файл для записи и/или открываем его
                            foreach ($v as $key => $value) {
                                $bookNameAndAuthor = PHP_EOL. array_shift($value['volumeInfo']['authors']). ';' .$value['volumeInfo']['title']; // формируем название книги
                                file_put_contents('booksAndAuthors.csv', $bookNameAndAuthor, FILE_APPEND |  LOCK_EX); //записываем в файл поочередно все названия
                            }  
                        }
                    }
                } else echo 'Были обнаружены ошибки при работе с удаленным json файлом';
            } else echo 'Нет соединения с сервером.';
        } else echo 'Пожалуйста введите название книги.';
    }
    booksApi($argv);
<?php
    function booksApi ($argv) {
        error_reporting(-1); // почему-то ругается на часть массива полученного из гугла (якобы 2 пустых)
        $booksCsvFile = __DIR__.'/booksAndAuthors.csv';

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
                    fopen($booksCsvFile, 'w'); // создаем файл для записи и/или открываем его

                    foreach ($jsonBook as $k => $v) { // разбираем массив на части

                        if ($jsonBook['totalItems'] == 0) { // если книга не найдена
                            die('К сожалению такая книга не найдена :(');
                        }   
                    }

                    $openedCsv = fopen($booksCsvFile, 'a');

                    foreach ($jsonBook['items'] as $k => $v) {
                                
                        if (!empty($v['volumeInfo']['authors'])) {
                            $bookNameAndAuthor = [array_shift($v['volumeInfo']['authors']), $v['volumeInfo']['title']]; // формируем название книги
                            fputcsv($openedCsv, $bookNameAndAuthor); //записываем в файл поочередно всназвания
                        }
                    }
                    fclose($openedCsv);

                    echo 'Книги успешно записаны!';

                } else echo 'Были обнаружены ошибки при работе с удаленным json файлом';

            } else echo 'Нет соединения с сервером.';

        } else echo 'Пожалуйста введите название книги.';
    }
    booksApi($argv);
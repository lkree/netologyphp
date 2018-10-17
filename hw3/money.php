<?php
    function money ($argv) {
        $currentDate = date('Y-m-d'); // задаем дату
        $fullDayPurchases;
        $floatPrice = floatval($argv[1]); //изменяем тип цены на флоат (дабл)
        if ($argv[1] == '--today') { //проверяем первый аргумент на запрос вывода всей дневной суммы
            if (file('purchases.csv')) {
                $spends = file('purchases.csv', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($spends as $k => $v) { // перебираем файл
                    $oneTimePurchase = explode(';', $v);
                    if ($oneTimePurchase[0] == $currentDate) { // проверяем дату, при совпадении записываем
                        $fullDayPurchases += $oneTimePurchase[1];
                    } 
                } 
               if ($fullDayPurchases) { // если всё ок - выводим
                echo($currentDate. ' расход за день: '. $fullDayPurchases);
               } else echo ('Сегодня не было ни одной покупки!'); // если сегодня еще не было покупок - сообщаем
            }
        } elseif ($floatPrice <= 0) { // если что-то с заданными параметрами пошло не так - оповещаем
            echo ('Ошибка! Аргументы не заданы или заданы неправильно. Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки}');
        } elseif (isset($argv[1]) && isset($argv[2])) { // проверяем наличие цены и купленной вещи
            array_shift($argv); // обрезаем цену
            $purchaseItem = implode(array_slice($argv, 1), ' '); // записываем имя покупки
            $purchasePrice = implode(array_slice($argv, 0, 1)); // цену
            $fullPurchase = [$currentDate, $purchasePrice, $purchaseItem]; // всё вместе
            if (is_writable('purchases.csv')) { // проверяем на возможность записи
                $openedCsv = fopen('purchases.csv', 'a');
                fputcsv($openedCsv, $fullPurchase);
                fclose($openedCsv);
                echo ('Ваша покупка успешно записана!'); // записываем и оповещаем
            } else echo('Невозможно записать данные! Файл отсутствует или недоступен'); // даем знать, что с файлом что-то не то
        } else echo('Пожалуйста, введите что именно вы купили'); // на случай если нет имени покупки
    };
    money($argv);
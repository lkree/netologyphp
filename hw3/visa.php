<?php
    function visa ($argv) {
        error_reporting(-1);
        if (!empty($argv[1])) { //проверяем наличие параметров
            $result = 'Страна не найдена :(';
            $usersCountry = '"' .$argv[1]. '"'; // страну юзера переводим в строку типа "страна", т.к. именно таким образом она представлена на удаленном сервере
            $visaRange = false; // чтобы вывести ошибки в случае неудачи соединения
            $firstResource = 'https://raw.githubusercontent.com/netology-code1asdad/php-2-homeworks/master/files/countries/opendata.csv';
            $secondResource = 'https://data.gov.ru/opendata/7704206201-country/data-20180609T0649-structure-20180609T0649.csv?encoding=UTF-8';

            if (@fopen($firstResource, 'r')) { //проверяем возможность подключения
                $visaRange = file($firstResource, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            } elseif (@fopen($secondResource, 'r')) {
                $visaRange = file($secondResource, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            } else {
                echo 'Невозможно соединиться с сервером';
            }
            if (!empty($visaRange)) {
                foreach ($visaRange as $k => $v) { // перебираем получанные данные
                   $countryAndNumber = explode(',', $v, -3); // отрезаем ненужные элементы от полученного массива
                   foreach ($countryAndNumber as $key => $value) { // проходимся по массиву стран
                       if ($usersCountry == $value) { // в случае совпадения страны пользователя со страной в списке 
                           $resultWOQuotes = explode(',', $v, -2); // делаем массив
                           $resultWOQuotes = str_replace('"', '', $resultWOQuotes[2]); // получаем нужную нам страну
                           $result = $argv[1]. ': '. $resultWOQuotes; // склеиваем страну и режим въезда
                        }   
                    }
                }
            }
            echo $result; // выводим результат или ошибку
        } else echo('Вы ввели несуществующую странну или данной страны нет в списке. Пожалуйста повторите запрос.');
    };
    visa($argv);
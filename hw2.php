<?php
    $animalsInCountries = [
        'Africa' => ['Giraffa rothschildi', 'Loxodonta'],
        'Antarctica' => ['Aptenodytes forsteri'],
        'Australia' => ['Macropus'],
        'Eurasia' => ['Pterimys volans', 'Bison bonasus', 'Apodemus agrarius'],
        'North America' => ['Mammuthus columbi', 'Bison bison'],
        'South America' => ['Eunectes mirunus']
    ];

    $twoWordsAnimals = [];
    foreach ($animalsInCountries as $k => $v) {
        foreach ($v as $key => $value) {
            if (strpos($value, ' ')) {
                $twoWordsAnimals[] = $value;
            }
        }
    }

    $animalsFirstname = [];
    $animalsSurname = [];
    $finalNamesAnimals = [];

    foreach ($twoWordsAnimals as $key => $value) {
        $symbolsBeforeSecondName = strpos($value, ' ');
        $animalsSurname[] = mb_substr($value, $symbolsBeforeSecondName);

        $symbolsAfterSecondName = mb_strlen($value) - $symbolsBeforeSecondName - 1;
        $animalsFirstname[] = mb_substr($value, 0, -($symbolsAfterSecondName));
    };
 
    $tempNumber = count($animalsFirstname);

    for ($i = 0; $i < $tempNumber; $i++) {
        shuffle($animalsFirstname);
        shuffle($animalsSurname);

        $tempFirstName = array_pop($animalsFirstname);
        $tempSecondName = array_pop($animalsSurname);

        $finalNamesAnimals[] = $tempFirstName . $tempSecondName;
    }
    var_dump($finalNamesAnimals);
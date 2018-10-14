<?php
    $animalsInCountries = [
        'Africa' => ['Giraffa rothschildi', 'Loxodonta'],
        'Antarctica' => ['Aptenodytes forsteri'],
        'Australia' => ['Macropus'],
        'Eurasia' => ['Pterimys volans', 'Bison bonasus', 'Apodemus agrarius'],
        'North America' => ['Mammuthus columbi', 'Stereoson bison'],
        'South America' => ['Eunectes mirunus']
    ];

    $twoWordsAnimals = [];
    foreach ($animalsInCountries as $k => $v) {
        foreach ($v as $key => $value) {
            if (str_word_count($value, 0) == 2) {
                $twoWordsAnimals[] = $value;
            }
        }
    }

    $animalsFirstname = [];
    $animalsSurname = [];
    $finalNamesAnimals = [];

    foreach ($twoWordsAnimals as $k => $v) {
        $tempNameAnimal = explode(' ', $v, -1);
        $tempSurnameAnimal = explode(' ', $v, 2);
        $animalsFirstname[] = array_pop($tempNameAnimal);
        $animalsSurname[] = array_pop($tempSurnameAnimal);
    }

    shuffle($animalsFirstname);
    shuffle($animalsSurname);

    $numberFirstnames = count($animalsFirstname);

    for ($i = 0; $i < $numberFirstnames; $i++) {
        $tempFirstName = array_pop($animalsFirstname);
        $tempSecondName = array_pop($animalsSurname);

        $finalNamesAnimals[] = $tempFirstName .' '. $tempSecondName;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php foreach ($finalNamesAnimals as $k => $v):?>
<p><?=$v?></p>
<?php endforeach; ?>
</body>
</html>
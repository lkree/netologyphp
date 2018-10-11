<?php
    $animalsInCountries = [
        'Africa' => ['Giraffa rothschildi', 'Loxodonta'],
        'Antarctica' => ['Aptenodytes forsteri'],
        'Australia' => ['Macropus'],
        'Eurasia' => ['Pterimys volans', 'Bison bonasus', 'Apodemus agrarius'],
        'North America' => ['Mammuthus columbi', 'Stereoson bison'],
        'South America' => ['Eunectes mirunus']
    ];

    $animalsFirstNamesInCountries = [
        'Africa' => ['Giraffa', 'Loxodonta'],
        'Antarctica' => ['Aptenodytes'],
        'Australia' => ['Macropus'],
        'Eurasia' => ['Pterimys', 'Bison', 'Apodemus'],
        'North America' => ['Mammuthus', 'Stereoson'],
        'South America' => ['Eunectes']
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

    foreach ($twoWordsAnimals as $k => $v) {
        $animalsFirstname[] = array_pop(explode(' ', $v, -1));
        $animalsSurname[] = array_pop(explode(' ', $v, 2));
    }

    shuffle($animalsFirstname);
    shuffle($animalsSurname);

    $numberFirstnames = count($animalsFirstname);

    for ($i = 0; $i < $numberFirstnames; $i++) {
        $tempFirstName = array_pop($animalsFirstname);
        $tempSecondName = array_pop($animalsSurname);

        $finalNamesAnimals[] = $tempFirstName .' '. $tempSecondName;
    }

    foreach($finalNamesAnimals as $k => $v) {
        $tempName[] = array_pop(explode(' ', $v, -1));
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
<?php
for ($i = 0; $i < count($tempName); $i++) {
    foreach($animalsFirstNamesInCountries as $k => $v) {
        foreach($v as $key => $value) {
            if ($tempName[$i] == $value) { ?>
    <h2><?=$k?></h2>
    <p><?=$finalNamesAnimals[$i]?></p>  
<?php } } } } ?>
</body>
</html>


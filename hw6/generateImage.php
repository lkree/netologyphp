<?php
    $fileWithName = file_get_contents('names.txt');

    $fileWithGrade = file_get_contents('grade.txt');

    $sertificate = __DIR__. '/images/sertificates/sertificate1.png';
    $image = imagecreatetruecolor(470, 664);
    $fontColor = imagecolorallocate($image, 0, 0, 0);

    if (!file_exists($sertificate)) {
        echo 'Картинка не найдена';
        exit;
    }

    $partOfImage = imagecreatefrompng($sertificate);

    imagecopy($image, $partOfImage, 0, 0, 0, 0, 470, 664);

    $font = __DIR__ . '/fonts/times.ttf';

    if (!file_exists($font)) {
        echo 'Шрифт не найден';
        exit;
    }

    imagettftext($image, 18, 0, 80, 250, $fontColor, $font, "Подопытный: $fileWithName
Оценка: $fileWithGrade");

    header('Content-Type: image/png');

    imagepng($image);

    imagedestroy($image);
<?php
include_once(__DIR__ . '/classes.php');
session_start();

if (empty($_SESSION)) {
    http_response_code(403);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<?php
    $todo->menu(); 
    exit(); ?>
</body>
</html>
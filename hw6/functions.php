<?php
    function formName () { ?>
<form action="" method="POST">
    <label for="usersName">
        Введите ваше имя:
        <input type="text" name="usersName" id="usersName">
    </label>
    <input type="submit" name="submit">
</form>
<?php } 
    function tryOneMoreTime() {?>
    <br>
    <a href="test.php?test=<?php echo $_GET['test'] ?>">Try one more time</a>
    <br>
    <a href="list.php">Try another test</a>
    <?php }
    function goingBackUrl() { ?>
        <br>
        <a href="admin.php">Вернуться назад</a>
    <?php }
    function goingToTests() { ?>
        <br>
        <a href="list.php">Попробовать пройти тест</a>
    <?php }
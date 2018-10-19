<?php 
function test1() {?>
<form action="" method="GET">
    <fieldset>
      <legend>Сколько граммов в одном килограмме?</legend>
        <label><input type="radio" name="test1" value="1"> 10</label>
        <label><input type="radio" name="test1" value="2"> 100</label>
        <label><input type="radio" name="test1" value="3"> 1000</label>
        <label><input type="radio" name="test1" value="4"> 10000</label>
    </fieldset>
    <input type="submit" value="done" name="result"> 
</form>
<?php }?>

<?php function test2() {?>
<form action="" method="GET">
    <fieldset>
      <legend>Сколько метров в одном дециметре?</legend>
        <label><input type="radio" name="test2" value="1"> 100</label>
        <label><input type="radio" name="test2" value="2"> 10</label>
        <label><input type="radio" name="test2" value="3"> 0.1</label>
        <label><input type="radio" name="test2" value="4"> 0.01</label>
    </fieldset>
    <input type="submit" value="done" name="result">  
</form>
<?php }?>

<?php 
function test3() {?>
<form action="" method="GET">
    <fieldset>
      <legend>Сколько бит в байте?</legend>
        <label><input type="radio" name="test3" value="1">4</label>
        <label><input type="radio" name="test3" value="2">8</label>
        <label><input type="radio" name="test3" value="3">16</label>
        <label><input type="radio" name="test3" value="4">32</label>
    </fieldset>
    <input type="submit" value="done" name="result"> 
</form>
<?php }?>

<?php function test4() {?>
<form action="" method="GET">
    <fieldset>
      <legend>Сколько байт в килобайте?</legend>
        <label><input type="radio" name="test4" value="1">~10</label>
        <label><input type="radio" name="test4" value="2">~100</label>
        <label><input type="radio" name="test4" value="3">~1000</label>
        <label><input type="radio" name="test4" value="4">~10000</label>
    </fieldset>
    <input type="submit" value="done" name="result">  
</form>
<?php }?>

<?php function tryOneMoreTime() {?>
<a href="<?php echo 'test.php' ?>">Try one more time</a>
<?php } ?>
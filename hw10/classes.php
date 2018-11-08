<?php
include_once(__DIR__ . '/database/config.php');
$reg = new Authorization();
$todo = new Todo();


class Authorization
{

    private function dbParameters()
    {
        return explode(',', file_get_contents( __DIR__ . '/database/dbparameters.php'));
    }

    public function __construct()
    {

    }

    private function db()
    {
        return new Database([
            'host' => $this->dbParameters()[0], 
            'dbname' => $this->dbParameters()[1], 
            'user' => $this->dbParameters()[2], 
            'password' => $this->dbParameters()[3],
            'charset' => $this->dbParameters()[4]]);
    }

    public function registration() {
        
        if (!empty($_SESSION['login'])) {
            $this->relogin();
        }
        
        if (!empty($_POST)) {
            $this->isRegistred($_POST['login'], $_POST['password']);
        } else {
            $this->regForm();
        }
    }

    private function isRegistred($login, $password) {
        $regInfo = $this->db()->query("SELECT * FROM user WHERE `login` = '$login'");

        if (!empty($regInfo[0]['login'] && !empty($regInfo[0]['password']))) {

            if (password_verify($password, $regInfo[0]['password'])) {
                $_SESSION['login'] = $login;
                $_SESSION['id'] = $regInfo[0]['id'];
                Header('Location: todo.php');
            } elseif (!password_verify($password, $regInfo[0]['password'])) {
                echo 'Вы ввели невереный пароль!';
            } else {
                echo 'К сожалению вы ввели неверный пароль или не ввели пароль вовсе';
            }
        } elseif (!empty($login) && empty($password)) {
            echo 'Введите пароль';
            
        } elseif (empty($login) && !empty($password)) {
            echo 'Введите логин';

        } elseif (empty($login) && empty($password)) {
            echo 'Введите логин и пароль';
        } else {
            $this->getRegistr($login, $password);
            Header('Location: todo.php');
        }
    }

    private function regForm()
    { ?>
        <form action="" method="POST">
            <label for="login">Введите логин</label>
                <input type="text" name="login" id="login">
            <label for="password">Введите пароль</label>
                <input type="password" name="password" id="password">
            <input type="submit" name="submit">
        </form>
    <?php }

    private function getRegistr($login, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $this->db()->query("INSERT INTO user (login, password) VALUES (:login, :password)", [
            'login' => $login,
            'password' => $password
        ]);
        $_SESSION['login'] = $login;
        $_SESSION['id'] = $regInfo[0]['id'];
    }

    private function relogin()
    {   
    if (!empty($_POST['relogin'])) {
            $_SESSION = [];
            Header('Location: index.php');
        } ?>
        <!-- <link rel="stylesheet" href="style.css"> -->
        <form action="" method="post">
            <label for="relogin">Хотите зайти под другой учетной записью?</label>
                <input type="submit" value="Выйти" name="relogin">
        </form>
        <?php exit();
    }
}


class Todo
{
    private function dbParameters()
    {
        return explode(',', file_get_contents( __DIR__ . '/database/dbparameters.php'));
    }

    private function db()
    {
        return new Database([
            'host' => $this->dbParameters()[0], 
            'dbname' => $this->dbParameters()[1], 
            'user' => $this->dbParameters()[2], 
            'password' => $this->dbParameters()[3],
            'charset' => $this->dbParameters()[4]]);
    }
    
    public function __construct()
    {
    }

    private function affairs()
    {
        $affairs = $this->db()->query("SELECT * FROM task WHERE `user_id` = '$this->userId' OR `assigned_user_id` = '$this->userId' ORDER BY `date_added` DESC");

        if (!empty($_POST['deleteId'])) {
            $deleteId = $_POST['deleteId'];
            $this->db()->query("DELETE FROM task WHERE task . id = '$deleteId'");
            echo 'Успешно удалено!'; ?>
            <a href="todo.php">Перейти к главной странице?</a>
            <?php exit();
        } elseif (isset($_POST['affairDone']) && !empty($_POST['updateId'])) {
            $affairDone = $_POST['affairDone'];
            $updateId = $_POST['updateId'];

            $this->db()->query("UPDATE task SET `is_done` = '$affairDone' WHERE task . id = '$updateId'");
            echo 'Статус дела был успешно изменен!'; ?>
            <a href="todo.php">Перейти к главной странице?</a>
            <?php exit();
        } elseif (!empty($_POST['userAssignedId']) && !empty($_POST['affairId'])) {
            $userAssignedId = $_POST['userAssignedId'];
            $affairId = $_POST['affairId'];

            $this->db()->query("UPDATE task SET `assigned_user_id` = '$userAssignedId' WHERE task . id = '$affairId'");
            echo 'Дело было успешно передано!'; ?>
            <a href="todo.php">Перейти к главной странице?</a>
            <?php exit();
        }
        
        
        ?>

        <table>
        <tr>
        <th>Описание дела</th>
        <th>Выполнено?</th>
        <th>Дата</th>
        <th>Удалить дело?</th>
        <th>Выполнили дело?</th>
        <th>Хотите передать дело?</th>
        </tr>
        <?php foreach ($affairs as $k => $v): 
            if ($v['assigned_user_id'] === NULL || $v['assigned_user_id'] == $this->userId): ?>
            <tr>
            <td><?php echo $v['description'] ?></td>
            <?php if ($v['is_done'] === 0) {
                $affairProgress = 'не выполнено :(';
            } else {
                $affairProgress = 'готово!';
            } ?>
            <td><?php echo $affairProgress ?></td>
            <td><?php echo $v['date_added'] ?></td>
            <td>       
                <form action="" method="post">
                    <input type="hidden" name="deleteId" value="<?php echo $v['id'] ?>">
                    <input type="submit" value="Удалить">
                </form>
            </td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="updateId" value="<?php echo $v['id'] ?>">
                    <?php if ($v['is_done'] == 0) { ?>
                        <input type="hidden" name="affairDone" value="1">
                        <input type="submit" value="Выполнил!">
                    <?php } else { ?>
                        <input type="hidden" name="affairDone" value="0">
                        <input type="submit" value="Хочу перевыполнить">
                    <?php } ?>
                </form>
            </td>
            <td>
            <form action="" method="post" id="<?php echo $v['id'] ?>">
                <select name="userAssignedId" id="" form="<?php echo $v['id'] ?>">
                    <?php foreach ($this->db()->query("SELECT * FROM user") as $key => $value) :
                        if ($value['id'] != $this->userId): ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['login'] ?></option>
                    <?php endif; endforeach; ?>
                    <input type="hidden" name="affairId" value="<?php echo $v['id'] ?>">
                    <input type="submit" Value="Передать">
                </select>
                </form>
            </td>
            </tr>
        <?php endif; endforeach; ?>
        </table>

        <form action="" method="post">
            <input type="submit" value="Посмотреть список дел переданых вам" name="delegatedAffair">
            <input type="submit" value="Посмотреть общее количество дел" name="totalNumberAffair">
        </form>
    <?php
    }

    private function delegatedAffair()
    {
        $delegatedAffairs = $this->db()->query("SELECT description, login FROM task JOIN user ON user.id = task.user_id WHERE task . assigned_user_id = '$this->userId'");
       
?>
        <table>
            <tr>
                <th>Дело</th>
                <th>Вы получило от:</th>
            </tr>
            <?php foreach ($delegatedAffairs as $k => $v): ?>
                <tr>
                    <td><?php echo $v['description'] ?></td>
                    <td><?php echo $v['login'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
            <a href="todo.php">Перейти к главной странице?</a>
            <?php
    }


    public function menu()
    {
        $this->userId = $_SESSION['id'];

        if (!empty($_POST['affairs']) || !empty($_POST['deleteId']) || !empty($_POST['updateId']) || !empty($_POST['userAssignedId'])) {
            $this->affairs();
            exit();
        } elseif (!empty($_POST['addAffair']) || !empty($_POST['newAffairAdded'])) {
            $this->addAffair();
            exit();
        } elseif (!empty($_POST['delegateAffair'])) {
            $this->delegateAffair();
            exit();
        } elseif (!empty($_POST['delegatedAffair'])) {
            $this->delegatedAffair();
            exit();
        } elseif (!empty($_POST['totalNumberAffair'])) {
            $this->totalNumberAffair();
            exit();
        }
        echo 'Доброго времени суток, ' . '<b>'. $_SESSION['login']. '</b>'. '<br>'.
        'Что вы хотите?'; ?>
        <form action="" method="post">
            <input type="submit" value="Смотреть все дела" name="affairs">
            <input type="submit" value="Добавить новое дело" name="addAffair">
        </form>
    <?php } 

    private function addAffair()
    {
        if (!empty($_POST['newAffairAdded'])) {
        $this->db()->query("INSERT INTO task (user_id, description, is_done, date_added) VALUES (:user_id, :description, :is_done, :date_added)", [
            'user_id' => $_SESSION['id'],
            'description' => htmlspecialchars($_POST['description'], ENT_HTML5),
            'is_done' => 0,
            'date_added' => Date('Y-m-d H:i:s')
        ]);

            echo 'Ваше дело успешно добавлено!'; ?>
            <a href="todo.php">Перейти к главной странице?</a>
        <?php exit();

        } else { ?>

        <form action="" method="post">
            <textarea name="description" placeholder="Введите новое дело" cols="40" rows="15"></textarea>
            <input type="submit" name="newAffairAdded">
        </form>
        <?php }
    }


    private function totalNumberAffair()
    {
        $totalAffairs = $this->db()->query("SELECT COUNT(id) as count FROM task WHERE (user_id = '$this->userId' AND assigned_user_id = '$this->userId') OR assigned_user_id = '$this->userId'");

        $anotherAffairs = $this->db()->query("SELECT * FROM task WHERE assigned_user_id IS NULL");

        $plusAffairs = 0;

        foreach($anotherAffairs as $k => $v) {
            if ($v['user_id'] == $this->userId) {
                $plusAffairs++;
            }
        }

        $totalAffairs = $totalAffairs[0]['count'] + $plusAffairs;

        echo 'У вас осталось '. $totalAffairs .' невыполненых дел' . '<br>'; ?>
        <a href="todo.php">Перейти к главной странице?</a>
        <?php
    }
}
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['login']) || empty($_POST['password'])) {
        $_SESSION['message'] = 'Не введен логин или пароль';
        header('Location: index.php?act=sign_in');
        exit;
    }

    // Проверям наличие логина в базе данных
    $stmt = $dbh->prepare("SELECT * FROM user_auth WHERE login = ?");
    $stmt ->execute([$_POST['login']]);
    $result = $stmt->fetch();


    if (!empty($result) && md5($_POST['password'] . $result['salt']) == $result['password']) {
        $_SESSION['last_ip'] = $_SERVER['REMOTE_ADDR'];
        setcookie ('last_login', $_REQUEST['login'], time() + 86400,'/');

        $stmt = $dbh->prepare("SELECT * FROM user_data, user_auth WHERE user_data.user_id = user_auth.id");
        $stmt ->execute();
        $result2 = $stmt->fetch();

        $_SESSION['user_name'] = $result2['author_name'];
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['message'] = 'Неверный логин или пароль'; 
    }
}

?>

<h2 align="center">Вход</h2>

<div class="form">
    <form action="index.php" method="post">
        <p>
            <label for="login">Ваш логин:<br></label>
            <input name="login" id="login" type="text" value="<?=htmlspecialchars(@$_POST['login'])?>" size="16" maxlength="16">
        </p>
        <p>
            <label for="password">Ваш пароль:<br></label>
            <input name="password" id="password" type="password" size="16" maxlength="16">
        </p>
        <p>
            <input type="hidden" name="act" value="sign_in">
            <input type="submit" name="submit" value="Войти">
        </p>
    </form>
</div>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['login']) || empty($_POST['password'])) {
            $_SESSION['message'] = 'Не введен логин или пароль';
            header('Location: index.php?act=sign_in');
            exit;
        } else {
            $user = new User($_POST['login'],$_POST['password']);
            $user->signIn();
        }
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

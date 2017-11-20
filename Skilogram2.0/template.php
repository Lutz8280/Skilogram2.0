<html>
    <body>
        <div>
            <?php 
            if (!empty($_SESSION['message'])):
                echo($_SESSION['message']);
                unset($_SESSION['message']);
            endif; 
            ?>
        </div>
        
        <a href="index.php">Home</a>
        <a href="index.php?act=sign_up">Зарегистрироваться</a>
        <a href="index.php?act=sign_in">Войти</a>
        
        <hr/>
        
        <?=$content; ?>
        
        <hr/>
        &copy; <?=date('Y'); ?> Copyright
    </body>
</html>

<?php
class User {
    private $login, $password, $salt;
    
    public function __construct($login, $password) {
        $this->login = $login;
        $this->password = $password;
    }
    
    public function addUser() {
        $login = $this->login;
        $salt = mt_rand(1,100);
        $password = md5($this->password . $salt);
        $stmt = DBconnect::$db->prepare("SELECT id FROM user_auth WHERE login =?");
        $stmt ->execute([$login]);
        $user_exist = $stmt->fetch();
        if (!empty($user_exist['id'])) {
            $_SESSION['message'] = 'Извините, введённый вами логин уже зарегистрирован. Введите другой логин.';
            header('Location: index.php?act=sign_up');
            exit;
        } else {
    //вносим данные нового пользователя
        
        $stmt = DBconnect::$db->prepare("INSERT INTO user_auth SET login =?, password =?, salt =?");
        $stmt->execute([$login, $password, $salt]);
        }
        $_SESSION['message'] = "Пользователь $login успешно зарегистрирован";
    }
    
    
    public function SignIn() {
        $login = $this->login;
  . . . $password = this->password;
        $stmt = DBconnect::$db->prepare("SELECT * FROM user_auth WHERE login =?");
        $stmt ->execute([$login]);
        $result = $stmt->fetch();
        if (!empty($result) && md5($password . $result['salt']) == $result['password']) {
        $_SESSION['last_ip'] = $_SERVER['REMOTE_ADDR'];
        setcookie ('last_login', $_REQUEST['login'], time() + 86400,'/');
        $stmt = DBconnect::$db->prepare ("SELECT * FROM user_data, user_auth WHERE user_data.user_id = user_auth.id");
        $stmt ->execute();
        $result2 = $stmt->fetch();
        $_SESSION['user_name'] = $result2['author_name'];
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['message'] = 'Неверный логин или пароль'; 
    }
}
        
        
        
        
        
        
}


Class Post {
    
    
    Public function addPost () {
        
       } 
    
    Public function getPost() {
        
       } 
} 

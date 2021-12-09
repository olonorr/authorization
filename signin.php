<?php 
require 'includes/db.php';
$data = $_POST;
if(isset($data['do_signin'])) {
    $errors = array();
    $user = R::findOne('users', 'login = ?', array($data['login']));
    if ($user) {
        if (!password_verify($data['password'], $user->password)) {
            $errors[] = 'неверный пароль';
        }
    } else {
        $errors[] = 'такого пользователя нет';
    }
    
    if (empty($errors)) {
            echo '<div style="color: green;"> успешный вход</div><hr>';
            $_SESSION['logged_user'] = $user;
    } else {
        echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
    }
}

?>
<form action="/signin.php" method="POST">

    <p>
        <p><strong>Username or email</strong></p>
        <input type="text" name="login" value = "<?php echo @$data['login']; ?>">
    </p>

    <p>
        <p><strong>Password</strong></p>
        <input type="password" name="password" value = "<?php echo @$data['password']; ?>">
    </p>

    <p>
        <button type="submit" name="do_signin">Войти</button>
    </p>
</form>
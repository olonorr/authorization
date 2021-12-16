<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link href="assets/styles/main.css" rel="stylesheet" type="text/css"/>
</head>

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

<body>

<form action="/signin.php" method="POST">

        <label>Логин или email</label>
        <input type="text" placeholder="Введите логин или email" name="login" value = "<?php echo @$data['login']; ?>">

        <label>Пароль</label>
        <input type="password" placeholder="Введите пароль" name="password" value = "<?php echo @$data['password']; ?>">

        <button type="submit" name="do_signin">Войти</button>
        
        <p>У вас нет аккаунта? - <a href="/signup.php">Зарегистрируйтесь</a></p>
</form>

</body>
</html>
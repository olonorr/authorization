<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link href="assets/styles/main.css" rel="stylesheet" type="text/css"/>
</head>

<?php 
require 'includes/db.php';
$data = $_POST;
if(isset($data['do_signup'])) {
    $errors = array();
    if(trim($data['login']) == '') {
        $errors[] = 'enter username';
    }
    if(trim($data['email']) == '') {
        $errors[] = 'enter email';
    }
    if($data['password'] == '') {
        $errors[] = 'enter password';
    }
    if($data['password_2'] == '') {
        $errors[] = 'enter repeated password';
    }
    if($data['password'] != $data['password_2']) {
        $errors[] = 'repeated password entered incorrectly';
    }
    if(R::count('users', 'login = ?', array($data['login'])) > 0) {
        $errors[] = 'пользователь с таким логином уже есть';

    }
    if(R::count('users', 'email = ?', array([$data['email']])) > 0) {
        $errors[] = 'пользователь с такой почтой уже есть';
        
    }
    if (empty($errors)) {
        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->join_date = date("Y-m-d H:i:s");
        R::store($user);
        echo '<div style="color: green;"> успешная регистрация</div><hr>';
    } else {
        echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
    }
}

?>

<body>

    <form action="/signup.php" method="POST">
        <label>Логин</label>
        <input type="text" placeholder="Введите Логин" name="login" value = "<?php echo @$data['login']; ?>">

        <label>Email</label>
        <input type="email" placeholder="Введите Email" name="email" value = "<?php echo @$data['email']; ?>">

        <label>Пароль</label>
        <input type="password" placeholder="Введите пароль" name="password" value = "<?php echo @$data['password']; ?>">

        <label>Подтверждение пароля</label>
        <input type="password_2" placeholder="Введите пароль ещё раз" name="password" name="password_2" value = "<?php echo @$data['password_2']; ?>">

        <button type="submit" name="do_signup">Зарегистрироваться</button>

        <p>У вас уже есть аккаунт? - <a href="/signin.php">Авторизируйтесь</a></p>
    </form>

</body>
</html>
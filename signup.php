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

<link href="style.css" rel="stylesheet" type="text/css"/>

<form action="/signup.php" method="POST">

    <p>
        <p><strong>Username</strong></p>
        <input type="text" name="login" value = "<?php echo @$data['login']; ?>">
    </p>

    <p>
        <p><strong>Email</strong></p>
        <input type="email" name="email" value = "<?php echo @$data['email']; ?>">
    </p>

    <p>
        <p><strong>Password</strong></p>
        <input type="password" name="password" value = "<?php echo @$data['password']; ?>">
    </p>

    <p>
        <p><strong>Repeat password</strong></p>
        <input type="password_2" name="password_2" value = "<?php echo @$data['password_2']; ?>">
    </p>

    <p>
        <button type="submit" name="do_signup">Submit</button>
    </p>
</form>
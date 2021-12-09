<?php
 require 'includes/db.php';
?>

<?php if (isset($_SESSION['logged_user']) ) : ?>
    авторизован, <?php echo $_SESSION['logged_user']->login ?>
    <hr>
    <a href="/logout.php">Выйти</a>
<?php else : ?>
    <a href = 'signup.php'>Sign up</a> <br>
    <a href = 'signin.php'>Sign in</a>
<?php endif; ?>

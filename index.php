<?php
 require 'includes/db.php';

?>
<link href="style.css" rel="stylesheet" type="text/css"/>

<header>
<?php if (isset($_SESSION['logged_user']) ) : ?>
    авторизован, <?php echo $_SESSION['logged_user']->login ?>
    <hr>
    <a href="/logout.php">Log out</a>
<?php else : ?>
    <a href = 'signup.php'>Sign up</a> <br>
    <a href = 'signin.php'>Sign in</a>
<?php endif; ?>
</header>

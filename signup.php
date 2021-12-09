<?php require 'includes/db.php'; ?>

<form action="/signup.php" method="POST">

    <p>
        <p><strong>Username</strong></p>
        <input type="text" name="login">

        <p><strong>Email</strong></p>
        <input type="email" name="email">

        <p><strong>Password</strong></p>
        <input type="password" name="password">

        <p><strong>Repeat password</strong></p>
        <input type="password_2" name="password_2">
    </p>
</form>
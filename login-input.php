<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<form action="login-output.php" method="post">
登入ID<input type="text" name="login"><br>
密碼<input type="password" name="password"><br>
<input type="submit" value="登入">
</form>
<?php require '../footer.php'; ?>

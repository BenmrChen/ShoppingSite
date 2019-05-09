<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
session_start();
unset($_SESSION['product'][$_REQUEST['id']]);
echo '所選商品已移出購物車。';
echo '<hr>';
require 'cart.php';
?>
<?php require '../footer.php'; ?>

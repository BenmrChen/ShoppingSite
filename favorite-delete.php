<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
session_start();
if (isset($_SESSION['customer'])) {
	$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
		'staff', 'password');
	$sql=$pdo->prepare(
		'delete from favorite where customer_id=? and product_id=?');
	$sql->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
	echo '所選商品已從我的最愛移除。';
	echo '<hr>';
} else {
	echo '請先登入，才能從我的最愛移除商品。';
}
require 'favorite.php';
?>
<?php require '../footer.php'; ?>

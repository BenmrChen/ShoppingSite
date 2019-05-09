<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
session_start();
if (isset($_SESSION['customer'])) {
	$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
		'staff', 'password');
	$sql=$pdo->prepare('insert into favorite values(?,?)');
	$sql->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
	echo '商品加入我的最愛成功。';
	echo '<hr>';
	require 'favorite.php';
} else {
	echo '請先登入，才能將商品加入我的最愛。';
}
?>
<?php require '../footer.php'; ?>

<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
session_start();
$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
	'staff', 'password');
$purchase_id=1;
foreach ($pdo->query('select max(id) from purchase') as $row) {
	$purchase_id=$row['max(id)']+1;
}
$sql=$pdo->prepare('insert into purchase values(?,?)');
if ($sql->execute([$purchase_id, $_SESSION['customer']['id']])) {
	foreach ($_SESSION['product'] as $product_id=>$product) {
		$sql=$pdo->prepare('insert into purchase_detail values(?,?,?)');
		$sql->execute([$purchase_id, $product_id, $product['count']]);
	}
	unset($_SESSION['product']);
	echo '已完成訂購，謝謝您的惠顧。';
} else {
	echo '很抱歉，結帳過程發生錯誤，無法完成訂購。';
}
?>
<?php require '../footer.php'; ?>

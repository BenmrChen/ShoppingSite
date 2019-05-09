<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<form action="product.php" method="post">
商品搜尋
<input type="text" name="keyword">
<input type="submit" value="搜尋">
</form>
<hr>
<?php
echo '<table>';
echo '<th>商品編號</th><th>商品名稱</th><th>價格</th>';
$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
	'staff', 'password');
if (isset($_REQUEST['keyword'])) {
	$sql=$pdo->prepare('select * from product where name like ?');
	$sql->execute(['%'.$_REQUEST['keyword'].'%']);
} else {
	$sql=$pdo->prepare('select * from product');
	$sql->execute([]);
	// $sql=$pdo->query('select * from product'); 以上寫法也可以
}
foreach ($sql->fetchAll() as $row) {
	//直接寫foreach ($sql as $row)也可以 超神秘
	$id=$row['id'];
	echo '<tr>';
	echo '<td>', $id, '</td>';
	echo '<td>';
	echo '<a href="detail.php?id=', $id, '">', $row['name'], '</a>';
	echo '</td>';
	echo '<td>', $row['price'], '</td>';
	echo '</tr>';
}
echo '</table>';

?>
<?php require '../footer.php'; ?>


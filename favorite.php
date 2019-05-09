<?php
if (isset($_SESSION['customer'])) {
	echo '<table>';
	echo '<th>商品編號</th><th>商品名稱</th><th>價格</th>';
	$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
		'staff', 'password');
	$sql=$pdo->prepare(
		'select * from favorite, product '.
		'where customer_id=? and product_id=id');
	$sql->execute([$_SESSION['customer']['id']]);
	foreach ($sql->fetchAll() as $row) {
		$id=$row['id'];
		echo '<tr>';
		echo '<td>', $id, '</td>';
		echo '<td><a href="detail.php?id='.$id.'">', $row['name'], 
			'</a></td>';
		echo '<td>', $row['price'], '</td>';
		echo '<td><a href="favorite-delete.php?id=', $id, 
			'">刪除</a></td>';
		echo '</tr>';
	}
	echo '</table>';
} else {
	echo '請先登入，才能顯示我的最愛。';
}
?>

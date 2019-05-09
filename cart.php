<?php
if (!empty($_SESSION['product'])) {
	echo '<table>';
	echo '<th>商品編號</th><th>商品名稱</th>';
	echo '<th>價格</th><th>數量</th><th>小計</th>';
	$total=0;
	foreach ($_SESSION['product'] as $id=>$product) {
		// 因為$_SESSION['product']是三維陣列: $_SESSION['product']的value是$id, 而$id又是個索引 其value有name, price和count, 這三項又是一個索引去代value為雞排、65、1個出來
		echo '<tr>';
		echo '<td>', $id, '</td>';
		echo '<td><a href="detail.php?id=', $id, '">', 
			$product['name'], '</a></td>';
		echo '<td>', $product['price'], '</td>';
		echo '<td>', $product['count'], '</td>';
		$subtotal=$product['price']*$product['count'];
		$total+=$subtotal;
		echo '<td>', $subtotal, '</td>';
		echo '<td><a href="cart-delete.php?id=', $id, '">刪除</a></td>';
		echo '</tr>';
	}
	echo '<tr><td>合計</td><td></td><td></td><td></td><td>', $total, 
		'</td><td></td></tr>';
	echo '</table>';
} else {
	echo '購物車內無商品。';
}
?>

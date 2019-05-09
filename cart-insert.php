<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
session_start();
$id=$_REQUEST['id'];
if (!isset($_SESSION['product'])) {
	$_SESSION['product']=[];
}
// array在使用之前一定要先宣告或像現在這樣設成空值

$count=0;
// 這邊要設成零是因為重整頁面 之前的$count有值的話 而且SESSION['product']裡又沒東西的話 下面的判斷就會把count當作非零來處理
if (isset($_SESSION['product'][$id])) {
	$count=$_SESSION['product'][$id]['count'];//這個就是三維陣列了 若13行有值的話 就把存在product-id裡的count丟到$count裡
  // $_SESSION['product']的value是$id, 而$id又是個索引 其value有name, price和count, 這三項又是一個索引去代value為雞排、65、1個出來
}
$_SESSION['product'][$id]=[
	'name'=>$_REQUEST['name'], 
	'price'=>$_REQUEST['price'], 
	'count'=>$count+$_REQUEST['count']
];
echo '<p>商品放入購物車成功。</p>';
echo '<hr>';
require 'cart.php';
?>
<?php require '../footer.php'; ?>

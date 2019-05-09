<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
session_start();
unset($_SESSION['customer']); //若有相同ID登入就要先把他踢出去 所以在以customer當作session索引時，須先把先前登入的刪除→以unset行之; 如果沒的話就直接%_SESSION['customer']就好(? 應該是下面再做即可?)
$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8','staff', 'password');
$sql=$pdo->prepare('select * from customer where login=? and password=?');
$sql->execute([$_REQUEST['login'], $_REQUEST['password']]);
foreach ($sql->fetchAll() as $row) {
	$_SESSION['customer']=[
		'id'=>$row['id'], 'name'=>$row['name'], 
		'address'=>$row['address'], 'login'=>$row['login'], 
		'password'=>$row['password']];
    // 以foreach將user的資料存到以'customer'為索引的SESSION陣列
    // 這樣子要取值的話就要用$_SESSION['customer']['id']來取(以id為例 其他亦同)
    // 上面的'id'=>$row['id']就是key=>value的概念
}
if (isset($_SESSION['customer'])) {
	echo '親愛的'. $_SESSION['customer']['name'].'，歡迎光臨。';
} else {
	echo '登入ID或密碼有誤。';
  // 如果上面ID/PW在database有值的話就會存到SESSION 這樣就判斷是會員
}
?>
<?php require '../footer.php'; ?>

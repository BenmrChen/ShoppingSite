<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
session_start();
$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
	'staff', 'password');
if (isset($_SESSION['customer'])) {
	$id=$_SESSION['customer']['id'];
	$sql=$pdo->prepare('select * from customer where id!=? and login=?');
	$sql->execute([$id, $_REQUEST['login']]);//如果已經登入的話(SESSION有值) 則判斷是否有已經有其他id(用id!=?來判斷 少了這個的話可以會有該登入的id改login失敗的情形)已經使用了該login, 若有的話 $sql->fetchAll()就會有值 在下面就會變成echo登入ID已被使用 
} else {
	$sql=$pdo->prepare('select * from customer where login=?');
	$sql->execute([$_REQUEST['login']]); //如果沒登入的話 就檢查資料庫是否有相同的login 若有 execute後就會有值 在下一段的if就會被判斷成echo 登入ID已被使用 請重新設定
}
if (empty($sql->fetchAll())) {
	if (isset($_SESSION['customer'])) {
		$sql=$pdo->prepare('update customer set name=?, address=?, '.
			'login=?, password=? where id=?');
		$sql->execute([
			$_REQUEST['name'], $_REQUEST['address'], 
			$_REQUEST['login'], $_REQUEST['password'], $id]);
		$_SESSION['customer']=[
			'id'=>$id, 'name'=>$_REQUEST['name'], 
			'address'=>$_REQUEST['address'], 'login'=>$_REQUEST['login'], 
			'password'=>$_REQUEST['password']];
		echo '客戶資料修改完成。';
	} else {
		$sql=$pdo->prepare('insert into customer values(null,?,?,?,?)');
		$sql->execute([
			$_REQUEST['name'], $_REQUEST['address'], 
			$_REQUEST['login'], $_REQUEST['password']]);
		echo '客戶資料新增完成。';
	}
} else {
	echo '登入ID已被使用，請重新設定。';
}
?>
<?php require '../footer.php'; ?>

<!-- 
要判斷的是
1. 有沒有登入
	a. 有→修改目前的會員資料
	b. 沒有→ 2.有沒有相同的會員資料
						→有: 必須重新設定一個新的
						→沒有: 新增一個新的 -->
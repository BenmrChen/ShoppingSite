<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
session_start();
$name=$address=$login=$password=''; 
// 先宣告這4個變數為空值 也可以寫成
// $name= '';
// $address= '';
// $login= '';
// $password='';
// 如果這行不寫的話 在未登入的狀況進入此頁 各欄位會show為<br /><b>Notice</b>:  Undefined variable: name in <b>/Users/mingrenchen/Sites/php_web_textbook/PracticeProject/customer-input.php</b> on line <b>43</b><br />
if (isset($_SESSION['customer'])) {
	$name=$_SESSION['customer']['name'];
	$address=$_SESSION['customer']['address'];
	$login=$_SESSION['customer']['login'];
	$password=$_SESSION['customer']['password'];
  echo '您已經登錄，若要修改會員資料，請於下欄中更新並點選"確定"鍵。';
}
// echo '<form action="customer-output.php" method="post">';
// echo '<table>';
// echo '<tr><td>姓名</td><td>';
// echo '<input type="text" name="name" value="', $name, '">';
// echo '</td></tr>';
// echo '<tr><td>地址</td><td>';
// echo '<input type="test" name="address" value="', $address, '">';
// echo '</td></tr>';
// echo '<tr><td>登入ID</td><td>';
// echo '<input type="text" name="login" value="', $login, '">';
// echo '</td></tr>';
// echo '<tr><td>密碼</td><td>';
// echo '<input type="password" name="password" value="', $password, '">';
// echo '</td></tr>';
// echo '</table>';
// echo '<input type="submit" value="確定">';
// echo '</form>';

// 上面是書的寫法 但很亂啊全都用echo...

?>
<form action="customer-output.php" method="post">
  <table>
    <tr>
      <td>姓名</td>
      <td><input type="text" name="name" value="<?php echo $name?>"></td>
    </tr>
    <tr>
      <td>地址</td>
      <td><input type="text" name="address" value="<? echo $address?>"></td>
    </tr>
    <tr>
      <td>登入ID</td>
      <td><input type="text" name="login" value="<?=$login?>"> </td>
    </tr>
    <tr>
      <td>密碼</td>
      <td><input type="text" name="password" value="<?=$password?>"></td>
    </tr>
  </table>
  <input type="submit" value='確定'>
</form>



<?php require '../footer.php'; ?>

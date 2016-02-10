<!DOCTYPE html>
<html lang="ja">
<head>
<title>懺悔.com</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>

<h1>懺悔.com</h1>

<form action="zangeregist.php" method="post">
  <textarea name="comment" cols="50" rows="8"></textarea><br />
  <br />
  <input type="submit" value="懺悔する" />
</form>



<?php

$con = mysql_connect('localhost', 'root', '');
if (!$con) {
  exit('データベースに接続できませんでした。');
}

$result = mysql_select_db('phpdb', $con);
if (!$result) {
  exit('データベースを選択できませんでした。');
}

$result = mysql_query('SET NAMES utf8', $con);
if (!$result) {
  exit('文字コードを指定できませんでした。');
}

$comment   = $_REQUEST['comment'];


$result = mysql_query("INSERT INTO address(no, name, tel) VALUES('$no', '$name', '$tel')", $con);
if (!$result) {
  exit('データを登録できませんでした。');
}

$con = mysql_close($con);
if (!$con) {
  exit('データベースとの接続を閉じられませんでした。');
}

?>
<p>登録が完了しました。<br /><a href="index.html">戻る</a></p>

</body>
</html>

<?php
// セッションの開始
session_start();

// 削除データの主キーを取得
if (!isset($_GET["no"])) {
    exit;
} else {
    $no = $_GET["no"];
    $_SESSION["no"] = $no;    // 主キーを$_SESSIONに格納
}

// 接続設定
$dbtype = "mysql";
$sv = "localhost";
$dbname = "zangedb";
$user = "root";
$pass = "";

// データベースに接続
$dsn = "$dbtype:dbname=$dbname;host=$sv";
$conn = new PDO($dsn, $user, $pass);

// 削除するデータの取得
$sql = "SELECT * FROM messages WHERE (no = :no);";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":no", $no);
$stmt->execute();
$row = $stmt->fetch();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ゲストブック</title>
</head>
<body>
<p>削除確認画面</p>
<!-- 削除データの確認表示 -->
<form method="POST" action="delete-submit.php">
  <table border="1">
    <tr>
      <td>タイトル</td>
      <td><?php echo $row["title"]; ?></td>
    </tr>
      <td>内容</td>
      <td><?php echo nl2br($row["content"]); ?>
      </td>
    </tr>
    <tr>
      <td colspan="2">
      <input type="submit" value="削除する">
      </td>
    </tr>
  </table>
</form>
</body>
</html>
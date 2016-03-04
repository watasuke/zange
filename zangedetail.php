<?php
// 表示するデータの主キーを取得
if (!isset($_GET["no"])) {
    exit;
} else {
    $no = $_GET["no"];
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

// データの取得（1件のみ）
$sql = "SELECT * FROM messages WHERE (no = :no);";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":no", $no);
$stmt->execute();
$row = $stmt->fetch();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>懺悔詳細</title>
</head>
<body>
<p>詳細表示画面</p>
<!-- データの表示 -->
  <table border="1">
    <tr>
      <td>タイトル</td>
      <td><?php echo $row["title"]; ?></td>
    </tr>
    <tr>
      <td>内容</td>
      <td><?php echo nl2br($row["content"]); ?>
      </td>
    </tr>
  </table>

<p>
    <button onclick="countUpA();">許す</button>
    <span id="forgivecount" style="margin-left: 10px;">0</span>
</p>

</body>
</html>
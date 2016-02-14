<?php
// セッションの開始
session_start();

// 変更データの主キーを取得
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

// 変更するデータを取得
$sql = "SELECT * FROM messages WHERE (no = :no);";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":no", $no);
$stmt->execute();
$row = $stmt->fetch();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>懺悔更新</title>
</head>
<body>
<p>変更画面</p>
<!-- データ変更フォーム -->
<form method="POST" action="update-confirm.php">
  <table border="1">
    <tr>
      <td>タイトル</td>
      <td><input type="text" name="title" size="30"
            value="<?php echo $row["title"]; ?>"></td>
    </tr>
    <tr>
      <td>内容</td>
      <td>
      <textarea rows="5" cols="30"
        name="content"><?php echo $row["content"]; ?></textarea>
      </td>
    </tr>
    <tr>
      <td colspan="2">
      <input type="submit" value="確認する">
      </td>
    </tr>
  </table>
</form>
</body>
</html>
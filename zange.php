<!DOCTYPE html>
<html lang="ja">
<head>
<title>懺悔.com</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>

<h1>懺悔.com</h1>
<!-- データ入力フォーム -->
<form method="POST" action="zangecheck.php">
  <table border="0">
    <tr>
      <td>タイトル</td>
      <td><input type="text" name="title" size="30"></td>
    </tr>
    <tr>
      <td>内容</td>
      <td>
      <textarea rows="8" cols="50" name="content"></textarea>
      </td>
    </tr>
    <tr>
      <td colspan="2">
      <input type="submit" value="確認する">
      </td>
    </tr>
  </table>
</form>
<?php
// 接続設定
$dbtype = "mysql";
$sv = "localhost";
$dbname = "zangedb";
$user = "root";
$pass = "";

// データベースに接続
$dsn = "$dbtype:dbname=$dbname;host=$sv";
$conn = new PDO($dsn, $user, $pass);

// データの取得
$sql = "SELECT * FROM message ORDER BY no DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();

// 取得したデータを一覧表示
while ($row = $stmt->fetch()) {
    echo "<hr>{$row["no"]}：";
    if (!empty($row["m_mail"])) {
        echo "<a href=\"mailto:" . $row["m_mail"] . "\">"
        . $row["title"] . "</a>";
    }
    else {
        echo $row["title"];
    }
    echo "(" . date("Y/m/d H:i", strtotime($row["datetime"])) . ")";
    echo "<p>" . nl2br($row["content"]) . "</p>";

    // 変更・削除・詳細表示画面へのリンク
    echo "<a href=\"update.php?no=" . $row["no"] . "\">変更</a>　";
    echo "<a href=\"delete-confirm.php?no=" . $row["no"] . "\">削除</a>　";
    echo "<a href=\"detail.php?no=" . $row["no"] . "\">詳細</a>　";
}
?>
</body>
</html>

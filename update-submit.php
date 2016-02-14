<?php
// セッションの開始
session_start();
if (empty($_SESSION)) {exit;}

// 接続設定
$dbtype = "mysql";
$sv = "localhost";
$dbname = "zangedb";
$user = "root";
$pass = "";

// データベースに接続
$dsn = "$dbtype:dbname=$dbname;host=$sv";
$conn = new PDO($dsn, $user, $pass);

// 変更内容を取得（変更データの主キーも含む）
$no = $_SESSION["no"];
$title = htmlspecialchars($_SESSION["title"], ENT_QUOTES, "UTF-8");
$content = htmlspecialchars($_SESSION["content"], ENT_QUOTES, "UTF-8");

// データを変更
$sql = "UPDATE messages SET
            title = :title,
            content = :content,
            datetime = NOW()
        WHERE no = :no";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":no", $no);
$stmt->bindParam(":title", $title);
$stmt->bindParam(":content", $content);
$stmt->execute();

// エラーチェック
$error = $stmt->errorInfo();
if ($error[0] != "00000") {
    $message = "データの変更に失敗しました。{$error[2]}";
} else {
    $message = "データを変更しました。";
}

// セッションデータの破棄
$_SESSION = array();
session_destroy();
?>
<!-- 処理結果の表示 -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>懺悔更新</title>
</head>
<body>
<p>変更完了画面</p>
<p><?php echo $message; ?></p>
  <table border="1">
    <tr>
      <td>タイトル</td>
      <td><?php echo $title; ?></td>
    </tr>
    <tr>
      <td>内容</td>
      <td><?php echo nl2br($content); ?></td>
    </tr>
  </table>
  <p><a href="zange.php">トップページへ</a></p>
</body>
</html>
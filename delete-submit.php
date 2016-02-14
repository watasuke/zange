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

// 削除データの主キーを取得
$no = $_SESSION["no"];

// データを削除
$sql = "DELETE FROM messages WHERE (no = :no);";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":no", $no);
$stmt->execute();

// エラーチェック
$error = $stmt->errorInfo();
if ($error[0] != "00000") {
    $message = "データの削除に失敗しました。{$error[2]}";
} else {
    $message = "データを削除しました。";
}

// セッションデータの破棄
$_SESSION = array();
session_destroy();
?>
<!-- 処理結果の表示 -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>懺悔削除</title>
</head>
<body>
<p>削除完了画面</p>
<p><?php echo $message; ?></p>
<p><a href="index.php">トップページへ</a></p>
</body>
</html>
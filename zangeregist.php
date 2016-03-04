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

// 入力内容の取得（$_SESSIONから）
$title = htmlspecialchars($_SESSION["title"], ENT_QUOTES, "UTF-8");
$content = htmlspecialchars($_SESSION["content"], ENT_QUOTES, "UTF-8");

// データの追加
$sql = "INSERT INTO messages(title, content, datetime)
        VALUES(:title, :content, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":title", $title);
$stmt->bindParam(":content", $content);
$stmt->execute();

// エラーチェック
$error = $stmt->errorInfo();
if ($error[0] != "00000") {
    $messages = "懺悔の追加に失敗しました。{$error[2]}";
} else {
    $messages = "懺悔を追加しました。懺悔番号：" . $conn->lastInsertId();
}

// セッションデータの破棄
$_SESSION = array();
session_destroy();
?>
<!-- 処理結果の表示 -->
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
<title>懺悔完了</title>
</head>
<body>
<p>懺悔完了しました。</p>
<p><?php echo $messages; ?></p>
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
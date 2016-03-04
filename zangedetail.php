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
    <meta http-equiv="X-UA-Compatible" content="IE=edge; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
    <!-- 許すカウントのJS読み込み -->
    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/count.js"></script>
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
    <button type="button" class="btn btn-success" id="btn01"><p><a href="javascript:void(0);">許す</a></p><span  id="forgivecount" style="margin-left: 10px;"></span></button>

</p>

</body>
</html>
<?php
// セッションの開始
session_start();

// 入力値の取得・検証・加工
$title = chkString($_POST["title"], "タイトル");
$content = chkString($_POST["content"], "内容");

// 入力値をセッション変数に格納
$_SESSION["title"] = $title;
$_SESSION["content"] = $content;

// 入力値の検証・加工
function chkString($temp = "", $field, $accept_empty = false) {
    // 未入力チェック
    if (empty($temp) AND !$accept_empty) {
        echo "{$field}には何か入力してください。";
        exit;
    }

    // 入力内容を安全な値に
    $temp = htmlspecialchars($temp, ENT_QUOTES, "UTF-8");

    // 戻り値
    return $temp;
}
?>
<html>
<head>
<title>懺悔投稿確認</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
<p>追加確認画面</p>
<!-- 入力確認フォーム -->
<form method="POST" action="zangeregist.php">
  <table border="1">
    <tr>
      <td>タイトル</td>
      <td><?php echo $title; ?></td>
    </tr>
    <tr>
      <td>内容</td>
      <td><?php echo nl2br($content); ?></td>
    </tr>
    <tr>
      <td colspan="2">
      <input type="submit" value="投稿する">
      </td>
    </tr>
  </table>
</form>
</body>
</html>
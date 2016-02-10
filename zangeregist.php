<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
</head>

<body>
<table border="1">
  <tr>
    <td>懺悔</td><td><?php echo nl2br(htmlspecialchars($_POST["comment"], ENT_QUOTES)) ?></td>
  </tr>
</table>
</body>
</html>
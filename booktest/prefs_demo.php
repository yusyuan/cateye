<?php header("Content-Type: text/html;charset=utf-8" )?>
<html>
<head><title>Front Door</title></head>
<!--使用cookie 取得顏色偏好,背景色-->
<?php 
$backgroundName=$_COOKIE['bg'];
$foregroundName=$_COOKIE['fg'];
?>
<body bgcolor="<?= $backgroundName; ?>" text="<?= $foregroundName; ?>">
<h1>Welcome to the Store</h1>
<p>We have many fine products for you to view.
   Please fel free to browse the aisles and stop an asistant at any time.
   But remember, you break it you bought it </p>
<p>Would you like to <a href="colors.php">change your preferences?</a></p>
</body>
</html>

<?php header("Content-Type: text/html;charset=utf-8" )?>
<html>
<head><title>Preferences Set</title></head>
<!--cookie 設定偏好,背景色-->
<body>
<?php 
$colors=array(
		'black' => "#000000",
		'white' => "#ffffff",
		'red'   => "#ff0000",
		'blue'  => "#0000ff"
);
$backgroundName=$_POST['background'];
$foregroundName=$_POST['foreground'];
setcookie('bg', $colors[$backgroundName]);
setcookie('fg', $colors[$foregroundName]);
?>
<p>Thank you. Your preferences have been changed to:<br />
Background: <?= $backgroundName; ?><br />
Foreground: <?= $foregroundName; ?><br />
<p>Click <a href="prefs_demo.php">here</a> to see the preferences in action.</p>
</body>
</html>
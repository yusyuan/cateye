<?php header("Content-Type: text/html;charset=utf-8" )?>
<html>
<head><title>set Your Preferences</title></head>
<!--偏好選項 背景色-->
<body>
<form action="prefs.php" method="post">
  <p>背景色：
  <select name="background">
     <option value="black">黑色</option>
	 <option value="white">白色</option>
	 <option value="red"  >紅色</option>
	 <option value="blue" >藍色</option>
  </select><br />
  前景色：
  <select name="foreground">
     <option value="black">黑色</option>
	 <option value="white">白色</option>
	 <option value="red"  >紅色</option>
	 <option value="blue" >藍色</option>
  </select></p>
  <input type="submit" value="更改設定">
</form>
</body>
</html>
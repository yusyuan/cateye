<?php header("Content-Type: text/html;charset=utf-8" )?>
<html>
<head><title>Temperature Conversion</title></head>
<!--黏性表單，查詢結果附帶搜尋表單-->
<body>
<?php $fahrenheit = $_GET['fahrenheit']; ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
華氏溫度：
	<input type="text" name="fahrenheit" value="<?php echo $fahrenheit; ?>" /><br />
	<input type="submit" value="轉換溫度！" />
</form> 
<?php if (!is_null($fahrenheit))
	  {
	  	$celsius=($fahrenheit-32)*5/9;
	  	printf("%.2f度華氏溫度是%.2f的攝氏溫度", $fahrenheit, $celsius);
	  } 
?>
</body>
</html>
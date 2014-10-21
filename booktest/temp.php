<?php header("Content-Type: text/html;charset=utf-8" )?>
<html>
<head><title>Temperature Conversin</title></head>
<!--溫度轉換，頁面自行轉換-->
<body>
<?php if ($_SERVER['REQUEST_METHOD'] == 'GET') { ?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
華氏溫度：
<input type="text" name="fahrenheit" /><br />
<input type="submit" value="轉換攝氏溫度！" />
</form>

<?php }
else if ($_SERVER['REQUEST_METHOD']== 'POST')
{
	$fahrenheit=$_POST['fahrenheit'];
	$celsius=($fahrenheit - 32)*5/9;
	printf("%.2f度華氏溫度是%.2f的攝氏溫度", $fahrenheit, $celsius);
}
else 
{
	die("This script only works with GET and POST requests.");
}
?>
</body>
</html>

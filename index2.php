<html>

<head>
        <meta http-equiv="cache-control" content="no-cache">
        <meta http-equiv="pragma" content="no-cache">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登入系統</title>
</head>

<!-- 作業二，JSON輸出，
	 傳送帳號.密碼.語系.使用者IP位址。
-->

<body>
	<form id="form1" name="form1" method="GET" action="login2.php">
    <table width="400" border="3" align="left">
        <tr>
            <td>API</td>
            <td><input name="api" type="text" value="homework2" size="20"></td>
        </tr>
        <tr>
        		<!--
							傳值進行JSON編碼
						-->
            <td>data</td>
            <td> <?php $data=array();
                  $data=array("uid"=>"1001", "passwd"=>"popqoo", "language"=>"繁體中文", "userip"=>"127.0.0.1");
                 ?>
                 <input name="data" type="text" value=' <?php echo json_encode($data); ?> ' size="80"></td>
            
        </tr>
        <tr>
            <td ><Select Name="restype" onchange="funChgCountry(this.value);">
            <option value="JSON">JSON</Option>
            <option value="XML">XML</Option>
            </Select></td>
        </tr>
        <tr>
            <td colspan="2">
                <div align="center">
                    <input type="submit" name="submit" value="送出">
                </div>
            </td>
        </tr>
    </table>    
</form>
</body>
</html>
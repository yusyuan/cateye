<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登入系統</title>
</head>

<!-- 作業一，登入畫面使用POST or GET傳送，
	 傳送帳號.密碼.語系.使用者IP。
-->

<body>
<!--action可傳login.php, index3.php-->
<form id="form1" name="form1" method="POST" action="index3.php">
    <table width="250" border="3" align="left">
        <tr>
            <td width="40">帳號</td>
            <td width="160"><input name="uid" type="text" size="20"></td>
        </tr>
        <tr>
            <td>密碼</td>
            <td><input name="passwd" type="password" size="20"></td>
        </tr>
        <tr>
            <td ><Select Name="language" onchange="funChgCountry(this.value);">
            <option value="繁體中文">繁體中文</Option>
            <option value="簡體中文">簡體中文</Option>
            <option value="英文">英文</Option>
            </Select></td>
        </tr>
        <tr>
            <td colspan="2">
                <div align="center">
                    <input type="hidden" name="userip" value="<?php echo $_SERVER['REMOTE_ADDR'];?>">
                    <input type="submit" name="submit" value="送出">
                </div>
            </td>
        </tr>
    </table>    
</form>

</body>

</html>
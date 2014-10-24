<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登入系統</title>
</head>

<!-- 作業五，連結至查詢頁面。index5.php
-->

<body>
<form id="form2" name="form2" method="POST" action="index5.php">
    <table width="130" border="3" align="left">
        <tr>
            <td width="80" align="MIDDLE">查詢帳號資料</td>
        </tr>
        <tr>
            <td align="center"><input name="uid" type="text" size="8" ></td>
        </tr>
        <tr>
            <td align="center"><Select Name="page">
            <option value="yes">開啟頁數</Option>
            <option value="no">不開啟頁數</Option>
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
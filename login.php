<?php
header("Cache-Control: no-cache, no-cache");
header("Pragma: no-cache, no-cache");
header("Content-Type:text/html;charset=utf-8");

$link=mysql_connect("localhost","root","sakuretv");
mysql_query("SET NAMES 'UTF8'");
$db = @mysql_select_db("test");

/* 作業一，接收POST or GET傳送過來的資料， ＊GET接收尚未撰寫
 * 判斷帳號密碼正確與否，若正確顯示使用者名稱及歡迎詞。
 */

$s="SELECT *FROM `people` WHERE `Uid`='".$_POST['uid']."'";
$s1=mysql_query($s);
$s2=mysql_fetch_assoc($s1);

$uid=$s2['Uid'];
$passwd=$s2['Passwd'];
$name=$s2['Name'];


if ($_POST['uid']==$uid && $_POST['uid']!="")
{
    if ($_POST['passwd']==$passwd)
    {
        echo "歡迎".$name."登入，您選擇的語言是".$_POST['language']."， IP：".$_POST['userip'];
        
    }
    else
    {
        echo "帳號或密碼錯誤";
    }
}
else
{
    echo "帳號或密碼錯誤";
}
?>
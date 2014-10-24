<!-- 作業五，搜尋頁面
-->
<?php
header("Cache-Control: no-cache, no-cache");
header("Pragma: no-cache, no-cache");
header("Content-Type:text/html;charset=utf-8");

$link=mysql_connect("localhost","root","sakuretv");
mysql_query("SET NAMES 'UTF8'");
$db = @mysql_select_db("test");

if ($_SERVER['REQUEST_METHOD']!="GET")
{
    $url="http://localhost/login4.php";
    $uid=$_POST['uid'];
    $page=$_POST['page'];
    $fields=json_encode(array("uid"=>"$uid", "page"=>"$page"));
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, "data=$fields");
    curl_exec($ch);
    die();
    curl_close($ch);
}
else
{
    $url="http://localhost/login4.php";
    $uid=$_GET['uid'];
    $page=$_GET['page'];
    $pages=$_GET['pages'];
    $fields=json_encode(array("uid"=>"$uid", "page"=>"$page", "pages"=>"$pages"));
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, "$url"."?"."data=$fields");
    curl_exec($ch);
    die();
    curl_close($ch);
}
?>
<!-- 作業三，接收值處理成JSON不用表單輸出
     curl執行不了
     1.修改php.ini，將;extension=php_curl.dll前面的分號去掉（windows）
     2.複製libeay32.dll、ssleay32.dll(C:\AppServ\php5\)兩個文件到system32目錄
     3.重開Apache(services.msc) sudo /etc/init.d/apache2 start (參數 stop)
-->
<?php

if ($_SERVER['REQUEST_METHOD']!="GET")
{
    $url="http://localhost/login3.php";
    $uid=$_POST['uid'];
    $passwd=$_POST['passwd'];
    $language=$_POST['language'];
    $userip=$_POST['userip'];
    $page=$_POST['page'];
    $fields=json_encode(array("uid"=>"$uid", "passwd"=>"$passwd", "language"=>"$language", "userip"=>"$userip", "page"=>"$page"));
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
    $url="http://localhost/login3.php";
    $uid=$_GET['uid'];
    $passwd=$_GET['passwd'];
    $language=$_GET['language'];
    $userip=$_GET['userip'];
    $page=$_GET['page'];
    $fields=json_encode(array("uid"=>"$uid", "passwd"=>"$passwd", "language"=>"$language", "userip"=>"$userip", "page"=>"$page"));
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, "$url"."?"."data=$fields");
    curl_exec($ch);
    die();
    curl_close($ch);
}
?>
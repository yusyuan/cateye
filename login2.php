<?php
//避免proxy或bowser cache住網頁,php寫法
header("Cache-Control: no-cache, no-cache");
header("Pragma: no-cache, no-cache");           //  舊式寫法，加是為了相容性。
header("Content-Type:text/html;charset=utf-8");

/* 連結資料庫 */
$link=mysql_connect("localhost","root","sakuretv");
mysql_query("SET NAMES 'UTF8'");
$db = @mysql_select_db("test");

/* 作業二 */

/* 判斷GET or POST */
if ($_SERVER['REQUEST_METHOD']=="GET")
{
   /* 擋GET的傳送 */
   $error=[array("retcode"=>"0", "rescode"=>"t001003", "resmsg"=>"連結錯誤")];
   echo json_encode($error);
   exit;

   /* 存json陣列 */
        $a = json_decode($_GET['data'],true);

   /* 資料庫搜尋uid */
   $s="SELECT *FROM `people` WHERE `Uid`='".$a['uid']."'";
   $s1=mysql_query($s);
   $s2=mysql_fetch_assoc($s1);

   $uid=$s2['Uid'];
   $passwd=$s2['Passwd'];
   $name=$s2['Name'];
   $type=$s2['restype'];
   $language=$a['language'];
   $ip=$a['userip'];

     if ($a['uid']==$s2['Uid'] && $a['uid']!="")
     {
        if ($a['passwd']==$passwd)
        {
           $a=[array("retcode"=>"1", "rescode"=>"t001000", "resmsg"=>"帳號登入成功", "resdata"=>[array("name"=>"$name", "language"=>"$language", "IP"=>"$ip")])];
           echo json_encode($a);
           
           /* echo顯示方式
           ** echo "[{\"retcode\":\"1\",\"rescode\":\"t001000\",\"resmsg\":\"帳號登入成功\",\"resdata\":[{\"name\":\"$name\",\"language\":\"$language\",\"IP\":\"$ip\"}]}]";
           */
        }else
        {
            $a=[array("retcode"=>"0", "rescode"=>"t001001", "resmsg"=>"密碼錯誤", "resdata"=>[array("IP"=>"$ip")])];
            echo json_encode($a);

            /* echo顯示方式
            ** echo "[{\"retcode\":\"0\",\"rescode\":\"t001001\",\"resmsg\":\"密碼錯誤\",\"resdata\":[{\"IP\":\"$ip\"}]}]";
            */
        }
    }else
    {
        $a=[array("retcode"=>"0", "rescode"=>"t001002", "resmsg"=>"無此帳號", "resdata"=>[array("IP"=>"$ip")])];
        echo json_encode($a);

        /* echo顯示方式
        ** echo "[{\"retcode\":\"0\",\"rescode\":\"t001002\",\"resmsg\":\"無此帳號\",\"resdata\":[{\"IP\":\"$ip\"}]}]";
        */
    }
}else
{
    /* POST處理 */
    $a = json_decode($_POST['data'],true);
    
    $s="SELECT *FROM `people` WHERE `Uid`='".$a['uid']."'";
    $s1=mysql_query($s);
    $s2=mysql_fetch_assoc($s1);

    $uid=$s2['Uid'];
    $passwd=$s2['Passwd'];
    $name=$s2['Name'];
    $type=$s2['restype'];
    $language=$a['language'];
    $ip=$a['userip'];

    if ($a['uid']==$s2['Uid'] && $a['uid']!="")
    {
        if ($a['passwd']==$passwd)
        {
           $a=[array("retcode"=>"1", "rescode"=>"t001000", "resmsg"=>"帳號登入成功", "resdata"=>[array("name"=>"$name", "language"=>"$language", "IP"=>"$ip")])];
           echo json_encode($a);
        }else
        {
           $a=[array("retcode"=>"0", "rescode"=>"t001001", "resmsg"=>"密碼錯誤", "resdata"=>[array("IP"=>"$ip")])];
           echo json_encode($a);
        }
    }else
    {
        $a=[array("retcode"=>"0", "rescode"=>"t001002", "resmsg"=>"無此帳號", "resdata"=>[array("IP"=>"$ip")])];
        echo json_encode($a);
    }
}
?>
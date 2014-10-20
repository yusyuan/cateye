<?php

header("Cache-Control: no-cache, no-cache");
header("Pragma: no-cache, no-cache");
header("Content-Type:text/html;charset=utf-8");

$link=mysql_connect("localhost","root","sakuretv");
mysql_query("SET NAMES 'UTF8'");
$db = @mysql_select_db("test");

/* 作業四，
   輸出改為副程式，副程式判斷resdata, 資料為JSON丟入 
   使用代碼找出訊息帶入，開檔
*/


function Message($one,$two,$three,$qdata)
{
	if ($qdata != NULL)
	{
		$a=[array(
				"retcode"=>"$one",
				"rescode"=>"$two",
				"resmsg" =>"$three",
				"resdata"=>[$qdata])];
	}else 
	{
		$a=[array(
				"retcode"=>"$one",
				"rescode"=>"$two",
				"resmsg"=>"$three",
				)];
	}
	echo json_encode($a);
}

if ($_SERVER['REQUEST_METHOD']!="GET")
{
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
        	Message("1","t001000","帳號密碼登入成功",array("IP"=>"$ip","name"=>"$name","language"=>"$language"));
        }else
        {
        	Message("0","t001001","密碼錯誤",array("IP"=>"$ip"));
        }
    }else
    {
    	Message("0","t001002","無此帳號",array("IP"=>"$ip"));
    }
}else
{
   Message("0","t001003","連結錯誤");
   exit;

   $a = json_decode($_GET['data'],true);

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
        	Message("1","t001000","帳號密碼登入成功",array("IP"=>"$ip","name"=>"$name","language"=>"$language"));
        }else
        {
        	Message("0","t001001","密碼錯誤",array("IP"=>"$ip"));
        }
    }else
    {
    	Message("0","t001002","無此帳號",array("IP"=>"$ip"));
    }
}
?>
<?php

header("Cache-Control: no-cache, no-cache");
header("Pragma: no-cache, no-cache");
header("Content-Type:text/html;charset=utf-8");

$link=mysql_connect("localhost","root","sakuretv");
mysql_query("SET NAMES 'UTF8'");
$db = @mysql_select_db("test");

/* 作業四，
   輸出改為副程式，副程式判斷resdata, 資料為JSON輸出。 function Message()
   使用代碼找出訊息帶入，開txt檔。function txt()
   多國語言帶入
*/
function txt($ex,$language)
{
    /*開檔*/

	$fp=fopen("/var/www/html/Message.$language","r");
    for ( $i=1 ; $i<1000 ; $i++ )
    {
        /*一行一行存入變數*/
        $math[$i]=fgets($fp);

        /*分割字串*/
        $date[$i]=explode(":",$math[$i]);
  	    if ($date[$i][0]==$ex)
   	    {
   	        return $date[$i][1];
   	    }
        if ($math[$i]=="")
        {
            break;
        }
    }
	fclose($fp);
}

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
    $ip=$a['userip'];
    $language=$a['language'];

//    $b="SELECT * FROM `Message` WHERE `Mid`='".$ex."'";

    if ($a['uid']==$s2['Uid'] && $a['uid']!="")
    {
        if ($a['passwd']==$passwd)
        {
        	Message("1",$ex="t001000",txt($ex,$language), array("IP"=>"$ip","name"=>"$name","language"=>"$language"));
        }else
        {
        	Message("0",$ex="t001001",txt($ex,$language),array("IP"=>"$ip"));
        }
    }else
    {
    	Message("0",$ex="t001002",txt($ex,$language),array("IP"=>"$ip"));
    }
}else
{
   Message("0",$ex="t001003",txt($ex));
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
        	Message("1",$ex="t001000",txt($ex,$language),array("IP"=>"$ip","name"=>"$name","language"=>"$language"));
        }else
        {
        	Message("0",$ex="t001001",txt($ex,$language),array("IP"=>"$ip"));
        }
    }else
    {
    	Message("0",$ex="t001002",txt($ex,$language),array("IP"=>"$ip"));
    }
}
?>
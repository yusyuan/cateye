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
   多國語言帶入， 頁數筆數顯示
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

function Message($one,$two,$three,$qdata,$page)
{
    //預設每頁筆數
    $pageRow_records = 3;
    //預設頁數
    $num_pages = 1;
    //若已經有翻頁，將頁數更新
    if (isset($_GET['page']))
    {
      $num_pages = $_GET['page'];
    }
    //本頁開始記錄筆數 = (頁數-1)*每頁記錄筆數
    $startRow_records = ($num_pages -1) * $pageRow_records;
    //未加限制顯示筆數的SQL敘述句
    $query_RecMember = "SELECT * FROM `people` ";
    //加上限制顯示筆數的SQL敘述句，由本頁開始記錄筆數開始，每頁顯示預設筆數
    $query_limit_RecMember = $query_RecMember." LIMIT ".$startRow_records.", ".$pageRow_records;
    //以加上限制顯示筆數的SQL敘述句查詢資料到 $resultMember 中
    $RecMember = mysql_query($query_limit_RecMember);
    //以未加上限制顯示筆數的SQL敘述句查詢資料到 $all_resultMember 中
    $all_RecMember = mysql_query($query_RecMember);
    //計算總筆數
    $total_records = mysql_num_rows($all_RecMember);
    //計算總頁數=(總筆數/每頁筆數)後無條件進位。
    $total_pages = ceil($total_records/$pageRow_records);
    if ($num_pages < $total_pages)
    {
        $next_page=$num_pages+1;
    }else
    {
        $next_page=$num_pages;
    }
    if ($num_pages>1)
    {
        $pre_pages=$num_pages-1;
    }else
    {
        $pre_pages=$num_pages;
    }

	if ($qdata != NULL)
	{
	    if ($page == "yes")
        {
		    $a=[array(
				    "retcode"=>"$one",
				    "rescode"=>"$two",
				    "resmsg" =>"$three",
				    "nextpage"=>"$next_page",
				    "nowpage"=>"$num_pages",
				    "pagecnt"=>"$total_pages",
				    "pagerow"=>"$pageRow_records",
				    "prepage"=>"$pre_pages",
				    "rowcnt"=>"$total_records",
				    "resdata"=>[$qdata])];
	    }else
	    {
		    $a=[array(
				    "retcode"=>"$one",
				    "rescode"=>"$two",
				    "resmsg" =>"$three",
				    "resdata"=>[$qdata])];
	    }
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
    $page=$a['page'];

//    $b="SELECT * FROM `Message` WHERE `Mid`='".$ex."'";

    if ($a['uid']==$s2['Uid'] && $a['uid']!="")
    {
        if ($a['passwd']==$passwd)
        {
        	Message("1",$ex="t001000",txt($ex,$language), array("IP"=>"$ip","name"=>"$name","language"=>"$language"), $page);
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
   $page=$a['page'];

     if ($a['uid']==$s2['Uid'] && $a['uid']!="")
     {
        if ($a['passwd']==$passwd)
        {
        	Message("1",$ex="t001000",txt($ex,$language,$page),array("IP"=>"$ip","name"=>"$name","language"=>"$language"), $page);
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
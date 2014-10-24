<?php
header("Cache-Control: no-cache, no-cache");
header("Pragma: no-cache, no-cache");
header("Content-Type:text/html;charset=utf-8");

$link=mysql_connect("localhost","root","sakuretv");
mysql_query("SET NAMES 'UTF8'");
$db = @mysql_select_db("test");

/* 作業五， 頁數筆數顯示 */
    echo 111;

runpage($uid,$pages)
{
    //預設每頁筆數
	$pageRow_records = 4;
	//預設頁數
	$num_pages = 1;
	if (isset($page))
	{
		$num_pages =$page;
	}
	$startRow_records = ($num_pages -1) * $pageRow_records;
	if ($uid!="")
	{
		$query_RecMember ="SELECT * FROM `people` WHERE `Uid`='".$uid."'";
	}else
	{
		$query_RecMember ="SELECT * FROM `people` ";
	}
	$query_limit_RecMember = $query_RecMember." LIMIT ".$startRow_records.", ".$pageRow_records;
	$RecMember = mysql_query($query_limit_RecMember);
	$all_RecMember = mysql_query($query_RecMember);
	$total_records = mysql_num_rows($all_RecMember);
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
	while($s2=mysql_fetch_assoc($RecMember))
	{
		$data[] = array("uid"=>$s2['Uid'], "passwd"=>$s2['Passwd'], "name"=>$s2['Name'], "createdate"=>$s2['CreateDate'], "createowner"=>$s2['CreateOwner']);
	}
	if ($num_pages > 1)
	{
	    ?>
	    <a herf="">第一頁</a>
	    <?php
    	Message($pages, $next_page, $num_pages, $total_pages, $pageRow_records, $pre_pages, $total_records, $data);
    }else
    {
        ?>
        <a herf="">上一頁</a>
        <?php
        Message($pageYN, $next_page, $num_pages="$num_pages-1", $total_pages, $pageRow_records, $pre_pages, $total_records, $data);
    }
    
    if ($num_pages < $total_pages)
    {
        ?>
        <a href="">下一頁</a> 
        <?php 
        Message($pageYN, $next_page, $num_pages="$num_pages+1", $total_pages, $pageRow_records, $pre_pages, $total_records, $data);
    }else
    {
        ?>
        <a href="">最末頁</a> 
        <?php
        Message($pageYN, $next_page, $total_pages, $total_pages, $pageRow_records, $pre_pages, $total_records, $data);
    }
	

}

function Message($pageYN, $next_page, $num_pages, $total_pages, $pageRow_records, $pre_pages, $total_records, $data)
{
	if ($pageYN == "yes")
    {
	   $a=[array(
			    "nextpage"=>"$next_page",
			    "nowpage" =>"$num_pages",
			    "pagecnt" =>"$total_pages",
			    "pagerow" =>"$pageRow_records",
			    "prepage" =>"$pre_pages",
			    "rowcnt"  =>"$total_records",
			    "resdata" =>$data)]; 
	}else if ($pageYN == "no")
	{
	   $a=[array(
			    "resdata"=>$data)];
	}
	if ($b =="0")
	{
		$a=[array(
				"retcode"=>"$b",
				"rescode"=>"$page",
				"resmsg" =>"$ex",
				)];
	}
	echo json_encode($a);
	

}

if ($_SERVER['REQUEST_METHOD']!="GET")
{
    $uidpage = json_decode($_POST['data'],true);
    rundata($uidpage['uid'], $uidpage['page']);
}else
{
//   Message("0",$ex="t001003",txt($ex,1));
//   exit;

   $uidpage = json_decode($_GET['data'],true);
       //預設每頁筆數
	$pageRow_records = 4;
	//預設頁數
	$num_pages = 1;
	if (isset($page))
	{
		$num_pages =$page;
	}
	$startRow_records = ($num_pages -1) * $pageRow_records;
	if ($uidpage['uid']!="")
	{
		$query_RecMember ="SELECT * FROM `people` WHERE `Uid`='".$uidpage['uid']."'";
	}else
	{
		$query_RecMember ="SELECT * FROM `people` ";
	}
	$query_limit_RecMember = $query_RecMember." LIMIT ".$startRow_records.", ".$pageRow_records;
	$RecMember = mysql_query($query_limit_RecMember);
	$all_RecMember = mysql_query($query_RecMember);
	$total_records = mysql_num_rows($all_RecMember);
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
	while($s2=mysql_fetch_assoc($RecMember))
	{
		$data[] = array("uid"=>$s2['Uid'], "passwd"=>$s2['Passwd'], "name"=>$s2['Name'], "createdate"=>$s2['CreateDate'], "createowner"=>$s2['CreateOwner']);
	}
	Message($uidpage['page'], $next_page, $num_pages, $total_pages, $pageRow_records, $pre_pages, $total_records, $data);

}
?>
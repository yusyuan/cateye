<?php
header("Cache-Control: no-cache, no-cache");
header("Pragma: no-cache, no-cache");
header("Content-Type:text/html;charset=utf-8");

$link=mysql_connect("localhost","root","sakuretv");
mysql_query("SET NAMES 'UTF8'");
$db = @mysql_select_db("test");

/* 作業五， 頁數筆數顯示 */

function Message($uid,$page,$pages)
{
	//預設每頁筆數
	$pageRow_records = 3;
	//預設頁數
	$num_pages = 1;
	if (isset($_GET['pages']))
	{
		$num_pages = $_GET['pages'];
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

	?>
	<p><?php if ($num_pages > 1) { // 若不是第一頁則顯示 ?>
        <a href="http://localhost/login4.php?pages=1&uid=<?php echo $uid ?>&page=<?php echo $page ?>">第一頁</a> | 
        <a href="http://localhost/login4.php?pages=<?php echo $pages=$num_pages-1; ?>&uid=<?php echo $uid ?>&page=<?php echo $page ?>">上一頁</a>
	<?php }?>
	   <?php if ($num_pages < $total_pages) { // 若不是最後一頁則顯示 ?>
		<a href="http://localhost/login4.php?pages=<?php echo $pages=$num_pages+1; ?>&uid=<?php echo $uid ?>&page=<?php echo $page ?>">下一頁</a> |
		<a href="http://localhost/login4.php?pages=<?php echo $total_pages; ?>&uid=<?php echo $uid ?>&page=<?php echo $page ?>">最末頁</a>
    <?php }?></p>
	<?php

	while($s2=mysql_fetch_assoc($RecMember))
	{
		$data[] = array("uid"=>$s2['Uid'], "passwd"=>$s2['Passwd'], "name"=>$s2['Name'], "createdate"=>$s2['CreateDate'], "createowner"=>$s2['CreateOwner']);
	}
	if ($page == "yes")
    {
	   $a=[array(
			    "nextpage"=>"$next_page",
			    "nowpage" =>"$num_pages",
			    "pagecnt" =>"$total_pages",
			    "pagerow" =>"$pageRow_records",
			    "prepage" =>"$pre_pages",
			    "rowcnt"  =>"$total_records",
			    "resdata" =>$data)]; 
	}else if ($page == "no")
	{
	   $a=[array(
			    "resdata"=>$data)];
	}
	if ($uid =="0")
	{
		$a=[array(
				"retcode"=>"$uid",
				"rescode"=>"$page",
				"resmsg" =>"$ex",
				)];
	}
	echo json_encode($a);
}

if ($_SERVER['REQUEST_METHOD']!="GET")
{
    $b = json_decode($_POST['data'],true);
    Message($b['uid'],$b['page']);
}else
{
    Message($_GET['uid'],$_GET['page'],$_GET['pages']);
}
?>
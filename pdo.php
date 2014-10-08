<?php
//填寫問卷
session_start();
header('Content-type: text/html; charset=utf-8');
if(!empty($_POST['posted']) && !empty($_POST['email']))
{
	$folder="surveys/" . strtolower($_POST['email']);
	$_SESSION['folder']=$folder;
	
	if(!file_exiss($folder))
	{
		mkdir ($folder, 0777, true);
	}
	header("Location:08_6.php");
}
else
{
	?>
<html>
<head><title>Files&folders - On-line Survey</title></head>
<body bgcolor="black" text="white">
<h2>Surver Form</h2>
<p>Please enter your e-mail address start recording your comments</p>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <input type="hidden" name="posted" value="1">
  <p>Email address: <input type="text" name="email" size="45" /><br />
  <input type="submit" name="submit" value="Submit"></p>
</form>
</body>
</html>
<?php }
$folder=$_SESSION['folder'];
$filename=$folder . "/question1.txt";
$file_handle=fopen($filename,"a+");
$comments = fread($file_handle, filesize($filename));
fclose($file_handle);
if (!empty($_POST['posted']))
{
	$question1=$_POST['question1'];
	$file_handle=fopen($filename, "w+");
	if(flock($file_handle, LOCK_EX))
	{
		if (fwrite($file_handle, $question1) == FALSE)
		{
			echo "Cannot writ to file ($filename)";
		}
		flock($file_handle, LOCK_UN);
	}
	fclose($file_handle);
	header("Location:page2.php");
} 
else
{
	?>
	<html>
	<head>
	<title>Files& folders - On-line Survey</title>
	</head>
	<body>
	<table border=0>
	  <tr><td>
	    Pleaase enter your respose to the following survey question：
	  </td></tr>
	  <tr bgcolor="blue" ><td>
	    What is your opinion on the state of the world economy？<br/>
	    Can you helpp us fix it？
	  </td></tr>
	  <tr><td>
	  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method=POST>
	    <input type="hidden" name="posted" value=1>
	    <br/>
	    <textarea name="question1" rows="12" cols="35"><?= $comments ?></textarea>
	    </tr></td>
	    <tr><td>
	    <input type="submit" name="submit" value="Submit" >
	  </form>
	  </td></tr>
	</table>
	<?php } ?>
	</body>
	</html>
	
	
	
<!--  第八章 MongoDB 練習
$mongo = new Nongo();
$db = $mongo->library;
$authors=$db->authors;
$author=array('authorid' => 1, 'name' => "J.R.R. Tolkien");
$authors->insert($author);

$mongo =new Mongo();
$db=$mongo->librayr;
$authors=$db->authors;

$data=$authors->findone(array('authorid'=>4));
echo "Generated Primary Key: {$data['_ad']}
echo "Author name: {$data['name']}";

$mongo =new Mongo();
$db = $mongo->library;
$authors=$db->authors;
$authors->update
	(
		array('name' => "Isaac Asimov"),
		array('$set' =>
			array('books' =>
				array(
					"0-425-17034-9" => "Foundation",
					"0-261-10236-2" => "I, Robot",
					"0-440-17464-3" => "Second Foundation",
					"0-425-13354-0" => "Pebble In The Sky")
			)
		)		
	);

	
$mongo = new Nongo();
$db=$mongo->library;
$authors= $db->authors;

$data= $authors->findone(array('name' => "Isaac Asimov"));
$bookData=array(
			array(
				'ISBN' => "0-553-29337-0",
				'title' => "Foundation",
				'pub_year' => 1951,
				'available' => 1),
			array(
				'ISBN' => "0-553-29438-5",
				'title' => "I,Robot",
				'pub_year' => 1950,
				'available' => 1),
			array(
				'ISBN' => "0-517-546671",
				'title' => "Exploring the Earth and the Cosmos",
				'pub_year' => 1951,
				'available' => 1),
			array(
				'ISBN' => "0-553-29337-0",
				'title' => "Foundation",
				'pub_year' => 1951,
				'available' => 1)
			);
		$authors->update(
			array('_id' => #data['_id'],
				array('$set' => array('books' => $bookData)
				)
			);		
 -->
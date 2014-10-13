<?php
header('Content-type: text/html; charset=utf-8');

$word = $_POST['word'];
$number = $_POST['number'];

$chunks = ceil(strlen($word) / $number);

echo "由{$number}個單位來分 '{$word}' 單字：<br />\n";

for ($i = 0; $i<$chunks; $i++)
{
	$chunk=substr($word, $i * $number, $number);
	printf("%d： %s<br />\n", $i+1, $chunk);
}
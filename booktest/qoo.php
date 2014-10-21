<!--
<?php
$strScreenResolution="Low";
if ($strScreenResolution="Low"){
?>
	<p>這是一個純文字的網頁。</p>
<?php }else { }?>
	<p>這是一個多媒體的網頁。</p>
<?php } ?>


<?php 
$myAlign="right";
?>
<p align="<?php echo $myAlign; ?>">這是一個文字。</p>


<?php 
$myAlign="right";
?>
<p align="<?= $myAlign ?>">這是一個文字。</p>

-->

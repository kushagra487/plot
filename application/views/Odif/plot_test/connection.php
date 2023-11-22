<?php
$link = mysql_connect("localhost","root","");
if(!$link)
	die ("sorry !!!! connection is not present");
mysql_select_db("plot");
?>
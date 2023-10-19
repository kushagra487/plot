<?php


function insertDate()
{
return date('Y-m-d');
}



function insertFormatDate($date)
{
return date('Y-m-d',strtotime($date));
}
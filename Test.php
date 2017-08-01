<?php

require "Common.php";

$date02 = "0000-00-00";

$parseDate = explode(",", $_GET['dates']);
$date01 = FormatDate($parseDate[0]);

if (count($parseDate) > 1)
{
   $date02 =  FormatDate($parseDate[1]);
}

$time02 = "00:00 AM";

$parseTime = explode(",", $_GET['times']);
$time01 = FormatTime($parseTime[0]);

if (count($parseTime) > 1)
{
   $time02 =  FormatTime($parseTime[1]);
}

echo $date01 . "<br>";
echo $date02 . "<br>";
echo $time01 . "<br>";
echo $time02 . "<br>";
?>
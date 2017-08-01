<?php
/* Database connection settings */
$host = 'myathensricorg.ipowermysql.com';
$user = 'amsti_01';
$pass = 'Capstone@17';
$db = 'amsti_01';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->connect_error);

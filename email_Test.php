<?php                                     
/* Database connection settings */
$host = 'myathensricorg.ipowermysql.com';
$user = 'amsti_01';
$pass = 'Capstone@17';
$db = 'amsti_01';

$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->connect_error);

$sql = "SELECT * FROM tblReservationRequest WHERE vcPrimary = 'Arnold Schwartzanneger'";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();

echo $row["vcProgram"];
?>
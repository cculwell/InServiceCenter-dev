<?php
require "../../resources/config.php";
# create connection to database
//$mysqli = new mysqli($config['db']['amsti_01']['host']
//    , $config['db']['amsti_01']['username']
//    , $config['db']['amsti_01']['password']
//    , $config['db']['amsti_01']['dbname']);
//
///* check connection */
//if ($mysqli->connect_errno) {
//    printf("Connect failed: %s\n", $mysqli->connect_error);
//    exit();

//echo $_POST;
print_r($_POST);
var_dump($_POST);
echo "help";

$data = $_POST;
function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}
?>
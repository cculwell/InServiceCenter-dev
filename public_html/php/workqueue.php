<?php
require "../../resources/config.php";
//echo "tst";
# create connection to database
$mysqli = new mysqli($config['db']['amsti_01']['host']
    , $config['db']['amsti_01']['username']
    , $config['db']['amsti_01']['password']
    , $config['db']['amsti_01']['dbname']);

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$trigger = $_POST['trigger_name'];
$request_id = $_POST['request_id'];
$workflow_state = $_POST['workflow_state'];


function workflow_state_change($mysqli,$request_id, $workflow_state) {

    $sql  = "update requests ";
    $sql .= " set workflow_state = '";
    $sql .= $workflow_state;
    $sql .= "' where request_id = ";
    $sql .= $request_id;

    echo $sql;


    if (mysqli_query($mysqli, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

    mysqli_close($mysqli);

}

if($_POST['trigger_name']=="workflow_state_change"){
    workflow_state_change($mysqli,$request_id,$workflow_state);
}

?>
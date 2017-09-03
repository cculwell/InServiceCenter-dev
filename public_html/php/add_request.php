<?php
/**
 * User: rickmilliken
 * Date: 9/3/17
 * Time: 2:16 PM
 * PHP file that will add a request to the database.
 */

require "../../resources/config.php";

# Handle single-quotes for string nad null
function add_quotes($str) {
    if (is_string($str)) {
        return sprintf("'%s'", $str);
    } elseif (is_null($str)) {
        return sprintf("%s", "null");
    } else {
        return sprintf("%s", $str);
    }
}

$parms = array(
    "school" => "Fairview"
, "system" => "Cullman County"
, "request_desc" => "New Computers"
, "request_just_area" => "CS"
, "target_participants" => 20
, "enrolled_participants" => 15
, "location" => "Library"
, "total_hours" => 2
, "request_tot_cost" => 2500
, "format_or_eval" => "CBT"
, "contact_name" => "Nancy"
, "contact_phone" => "123-456-7890"
, "contact_email" => "nancy@me.com"
, "ou_director" => null
, "ou_board_approval" => null
, "ou_amt_sponosored" => null
, "ou_inservice_order" => null
, "ou_reimburse_sys" => null
);

# build sql statement for stored procedure call
$sql  = "call add_request(";
$sql .= implode(',', array_map('add_quotes', $parms));
$sql .= ")";

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

# used for testing to view call statement
#print $sql;

# execute query of proc call.
if (!$mysqli->query($sql)) {
    echo "CALL failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

/* close connection */
$mysqli->close()

?>
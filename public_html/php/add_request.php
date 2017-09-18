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

function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

$request_parms = array(
    "request_type" => $_POST['RequestType']
    , "workflow_state" => "New"
    , "school" => $_POST['school']
    , "system" => $_POST['system']
    , "request_desc" => $_POST['request_desc']
    , "request_just" => $_POST['request_just']
    , "request_location" => $_POST['request_location']
    , "target_participants" => $_POST['target_participants']
    , "enrolled_participants" => $_POST['enrolled_participants']
    , "total_hours" => $_POST['total_hours']
    , "total_cost" => $_POST['total_cost']
    , "eval_method" => $_POST['eval_method']
        //, "stipd" => $_POST['stipd']
);

$book_parms = array(
    "book_title" => $_POST['book_title']
    , "publisher" => $_POST['publisher']
    , "isbn" => $_POST['isbn']
    , "cost_per_book" => $_POST['cost_per_book']
    , "study_format" => $_POST['study_format']
);

if($request_parms['request_type'] == 'General') {
    $contacts_parms = array(
        array("contact_role" => "Contact"
        , "contact_name" => $_POST['contact_name']
        , "contact_phn_nbr" => $_POST['contact_phn_nbr']
        , "contact_email" => $_POST['contact_email'])

    , array("contact_role" => "Company"
        , "contact_name" => $_POST['company_name']
        , "contact_phn_nbr" => $_POST['company_phn_nbr']
        , "contact_email" => $_POST['company_email'])

    );
}

if($request_parms['request_type'] == 'BookStudy') {
    $contacts_parms = array(
        array("contact_role" => "Contact"
        , "contact_name" => $_POST['contact_name']
        , "contact_phn_nbr" => $_POST['contact_phn_nbr']
        , "contact_email" => $_POST['contact_email'])

    , array("contact_role" => "Facilitator"
        , "contact_name" => $_POST['facilitator_name']
        , "contact_phn_nbr" => $_POST['facilitator_phn_nbr']
        , "contact_email" => $_POST['facilitator_email'])
    );
}
// Dynamically build an array for date times
$date_time_parms = array();
$i = 0;
foreach($_POST as $key => $value)
{
    if(preg_match('/^date/', $key)) {
        $date_time_parms[$i] = array('date' => $_POST["date" . $i]
        , 'start_time' => $_POST["sTime" . $i]
        , 'end_time' => $_POST["eTime" . $i]);
        $i++;
    }
}


# build request sql statement for insert
$request_sql  = "insert into requests (";
$request_sql .= implode(',', array_keys($request_parms));
$request_sql .= ") values (";
$request_sql .= implode(',', array_map('add_quotes', $request_parms));
$request_sql .= ")";


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


// auto commit off
$mysqli->autocommit(false);

# begin transaction
$mysqli->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

try {
    # execute query of proc call.
    if (!$mysqli->query($request_sql)) {
        //echo "CALL failed: (" . $mysqli->errno . ") " . $mysqli->error;
        throw new Exception("Cannot insert record. Reason :".$mysqli->error);
    }
    // get request_id
    $request_id = $mysqli->insert_id;

    if($request_parms['request_type'] == 'BookStudy') {

        // insert book info
        $book_sql = "insert into books (";
        $book_sql .= "request_id,";
        $book_sql .= implode(',', array_keys($book_parms));
        $book_sql .= ") values (";
        $book_sql .= $request_id . ",";
        $book_sql .= implode(',', array_map('add_quotes', $book_parms));
        $book_sql .= ")";

        if (!$mysqli->query($book_sql)) {
            //echo "CALL failed: (" . $mysqli->errno . ") " . $mysqli->error;
            throw new Exception("Cannot insert record. Reason :" . $mysqli->error);
        }
    }
    // insert contact info
    foreach ($contacts_parms as $contact) {
        $contact_sql = "insert into contacts (";
        $contact_sql .= "request_id,";
        $contact_sql .= implode(',', array_keys($contact));
        $contact_sql .= ") values (";
        $contact_sql .= $request_id . ",";
        $contact_sql .= implode(',', array_map('add_quotes', $contact));
        $contact_sql .= ")";

        if (!$mysqli->query($contact_sql)) {
            //echo "CALL failed: (" . $mysqli->errno . ") " . $mysqli->error;
            throw new Exception("Cannot insert record. Reason :".$mysqli->error);
        }

    }

    // commit the transaction
    $mysqli->commit();
    print "Successful Insert\n";
    phpAlert("Test");

}
catch (Exception $e)
{
    $mysqli->rollback();
    echo $e;
}

/* close connection */
$mysqli->close();

?>
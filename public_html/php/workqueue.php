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

if(isset($_POST['trigger_name'])){
    $trigger = $_POST['trigger_name'];
}

if(isset($_POST['request_id'])) {
    $request_id = $_POST['request_id'];
}
if(isset($_POST['workflow_state'])){
    $workflow_state = $_POST['workflow_state'];
}




// Contacts
if(isset($_POST['contact_id'])) {
    $contact_id = $_POST['contact_id'];
}
if(isset($_POST['contact_name'])){
    $contact_name = $_POST['contact_name'];
}
if(isset($_POST['contact_role'])){
    $contact_role = $_POST['contact_role'];
}
if(isset($_POST['contact_phn_nbr'])){
    $contact_phn_nbr = $_POST['contact_phn_nbr'];
}
if(isset($_POST['contact_email'])){
    $contact_email = $_POST['contact_email'];
}
if(isset($_POST['contact_email'])){
    $contact_email = $_POST['contact_email'];
}
if(isset($_POST['contact_address'])){
    $contact_address = $_POST['contact_address'];
}


// Expenses
if(isset($_POST['expense_id'])){
    $expense_id = $_POST['expense_id'];
}
if(isset($_POST['expense_type'])){
    $expense_type = $_POST['expense_type'];
}
if(isset($_POST['expense_amount'])){
    $expense_amount = $_POST['expense_amount'];
}
if(isset($_POST['expense_note'])){
    $expense_note = $_POST['expense_note'];
}



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

}

function delete_contact($mysqli,$contact_id) {

    $sql  = "delete from contacts ";
    $sql .= " where contact_id = ";
    $sql .= $contact_id;

//    echo $sql;

    if (mysqli_query($mysqli, $sql)) {
//        echo "Record Deleted successfully";
    } else {
        echo "Error Deleted Contact record: " . mysqli_error($mysqli);
    }
}


function add_contact($mysqli
    , $request_id
    , $contact_role
    , $contact_name
    , $contact_phn_nbr
    , $contact_email
    , $contact_address) {

    $sql  = " insert into contacts ( ";
    $sql .= " request_id, contact_role, contact_name, contact_phn_nbr, contact_email, contact_address ";
    $sql .= " ) values ( ";
    $sql .= $request_id . ",'";
    $sql .= $contact_role . "','";
    $sql .= $contact_name . "','";
    $sql .= $contact_phn_nbr . "','";
    $sql .= $contact_email . "','";
    $sql .= $contact_address . "' ) ";


//    echo $sql;

    if (mysqli_query($mysqli, $sql)) {
//        echo "Record Add successfully";
    } else {
        echo "Error Add Contact record: " . mysqli_error($mysqli);
    }

    return $mysqli->insert_id;
}

function update_contact($mysqli
    , $contact_id
    , $contact_name
    , $contact_role
    , $contact_phn_nbr
    , $contact_email
    , $contact_address) {

    $sql  = " update contacts set ";
    $sql .= " contact_name = '" . $contact_name . "', ";
    $sql .= " contact_role = '" . $contact_role . "', ";
    $sql .= " contact_phn_nbr = '" . $contact_phn_nbr . "', ";
    $sql .= " contact_email = '" . $contact_email . "', ";
    $sql .= " contact_address = '" . $contact_address . "' ";
    $sql .= " where contact_id = " . $contact_id . " ";

//    echo $sql;

    if (mysqli_query($mysqli, $sql)) {
//        echo "Update successfully";
    } else {
        echo "Error Update Contact: " . mysqli_error($mysqli);
    }

//    return $mysqli->insert_id;
}



function delete_expense($mysqli, $expense_id){

    $sql  = "delete from expenses ";
    $sql .= " where expense_id = ";
    $sql .= $expense_id;

    echo $sql;

    if (mysqli_query($mysqli, $sql)) {
//        echo "Record Deleted successfully";
    } else {
        echo "Error Deleted Expense record: " . mysqli_error($mysqli);
    }
}

function add_expense($mysqli
    , $request_id
    , $expense_type
    , $expense_amount
    , $expense_note) {

    $sql  = " insert into expenses ( ";
    $sql .= " request_id, expense_type, expense_amount, expense_note ";
    $sql .= " ) values ( ";
    $sql .= $request_id . ",'";
    $sql .= $expense_type . "','";
    $sql .= $expense_amount . "','";
    $sql .= $expense_note . "' ) ";

    if (mysqli_query($mysqli, $sql)) {
//        echo "Record Add successfully";
    } else {
        echo "Error Add Expense record: " . mysqli_error($mysqli);
    }

    return $mysqli->insert_id;
}

function update_expense($mysqli
    , $expense_id
    , $expense_type
    , $expense_amount
    , $expense_note) {

    $sql  = " update expenses set ";
    $sql .= " expense_type = '" . $expense_type . "', ";
    $sql .= " expense_amount = '" . $expense_amount . "', ";
    $sql .= " expense_note = '" . $expense_note . "' ";
    $sql .= " where expense_id = " . $expense_id . " ";

//    echo $sql;

    if (mysqli_query($mysqli, $sql)) {
//        echo "Update successfully";
    } else {
        echo "Error Update Expense: " . mysqli_error($mysqli);
    }

//    return $mysqli->insert_id;
}

//print_r($_POST);

if($trigger=="workflow_state_change"){
    workflow_state_change($mysqli,$request_id,$workflow_state);
}

if($trigger=="delete_contact"){
    delete_contact($mysqli,$contact_id);
}

if($trigger=="update_contact"){
    update_contact($mysqli
        , $contact_id
        , $contact_name
        , $contact_role
        , $contact_phn_nbr
        , $contact_email
        , $contact_address);
    echo $contact_id;
}

if($trigger=="add_contact"){
    $contact_id = add_contact($mysqli
        , $request_id
        , $contact_role
        , $contact_name
        , $contact_phn_nbr
        , $contact_email
        , $contact_address);
    echo $contact_id;
}

if($trigger=="delete_expense"){
    delete_expense($mysqli,$expense_id);
}

if($trigger=="update_expense"){
    update_expense($mysqli
        , $expense_id
        , $expense_type
        , $expense_amount
        , $expense_note);
    echo $expense_id;
}

if($trigger=="add_expense"){
    $expense_id = add_expense($mysqli
        , $request_id
        , $expense_type
        , $expense_amount
        , $expense_note);
    echo $expense_id;
}
mysqli_close($mysqli);

?>
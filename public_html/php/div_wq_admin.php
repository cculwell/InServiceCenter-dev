<?php

require "../../resources/config.php";
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
?>

<button id="admin_report" name="admin_report">Reports</button>
<button id="admin_users" name="admin_users">Users</button>

<div id="pop_reports" name="pop_reports"></div>
<div id="pop_users" name="pop_users"></div>

<script>



    $("#pop_reports").dialog({
        title: "Reports",
        autoOpen: false,
        buttons: {
            Update: function(){

            },
            Cancel: function(){
                $(this).dialog("close");
            }
        }

    });

    report_button = $("#admin_report").button();

    report_button.click(function(e) {
        e.preventDefault();
        $("#pop_reports").dialog("open")
            .dialog("option", "width", $(window).width())
            .dialog("option", "height",$(window).height());
    });


    $("#pop_users").dialog({
        title: "Users",
        autoOpen: false,
        buttons: {
            Update: function(){

            },
            Cancel: function(){
                $(this).dialog("close");
            }
        }

    });

    user_button = $("#admin_users").button();

    user_button.click(function(e) {
        e.preventDefault();
        $("#pop_users").dialog("open")
            .dialog("option", "width", $(window).width())
            .dialog("option", "height",$(window).height());
    });


</script>


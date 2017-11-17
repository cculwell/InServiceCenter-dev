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

<div id="view_reports_selection" name="view_reports_selection">
    <h4>Query Start Date</h4>
    <input type="date" placeholder='mm/dd/yyyy' id="from_date" class="form-control datepicker" required/>
    <br><h4>Query End Date</h4>
    <input type="date" placeholder='mm/dd/yyyy' id="to_date" class="form-control datepicker" required/>
    <br>
    <h4 for="report">Available Reports</h4>
    <select name="report" id="report" class="form-control">
        <option value="1">Quick Report</option>
        <option value="2">Detailed Report</option>
        <option value="3">Financial Report</option>
        <option value="4">Curriculum Report</option>
        <option value="5">School and System Report</option>
        <option value="6">Initiative Report</option>
    </select>
    <div id="message"></div>
</div>
<div id="view_report" name="view_report"></div>
<div id="pop_users" name="pop_users"></div>

<script>

        $("#view_report").dialog({
            autoOpen: false,
            buttons: [
                { 
                    id: "cancel",
                    text: "Cancel", 
                    class: "btn btn-secondary",
                    click: function() { 
                        $("#view_report").empty();
                        $(this).dialog("close");
                        $("span.ui-dialog-title").text("Report Selection"); 
                    }
                }
            ],
            open: function(event, ui) {
                $(".ui-dialog-titlebar-close", ui.dialog | ui).hide();
            }
        });

        $("#view_reports_selection").dialog({
            title: "Report Selection",
            autoOpen: false,
            height: 400,
            width: 350,
            buttons: [
                { 
                    id: "cancel",
                    text: "Cancel", 
                    class: "btn btn-secondary",
                    click: function() { 
                        $(this).dialog("close"); 
                    }
                },
                { 
                    id: "show_report",
                    text: "Show Report",
                    class: "btn btn-secondary", 
                    click: function() {
                        var error_message = "";
                        var report = "";
                        var report_name = "";
                        var start_date = document.getElementById("from_date").value;
                        var end_date = document.getElementById("to_date").value;
                        var selected = $('#report option:selected').val();

                        // Error checking
                        if(Date.parse(end_date) < Date.parse(start_date))
                        {
                            error_message = "End date cannot be before the Start date.";
                            document.getElementById("message").style.color = 'red';
                            document.getElementById("message").style.fontWeight = 'bold';
                            document.getElementById("message").innerHTML = error_message;
                            return false;
                        }
                        if(start_date == '' || end_date == '')
                        {
                            error_message = "Please pick a date range.";
                            document.getElementById("message").style.color = 'red';
                            document.getElementById("message").style.fontWeight = 'bold';
                            document.getElementById("message").innerHTML = error_message;
                            return false;
                        }

                        // Determine what report to load
                        if (selected == "1") {
                            report = 'php/reports/quick_report/quick_report.php';
                            report_name = "Quick Report";
                        }
                        else if (selected == "2") {
                            report = 'php/reports/detailed_report/detailed_report.php';
                            report_name = "Detailed Report";
                        }
                        else if (selected == "3") {
                            report = 'php/reports/financial_report/financial_report.php';
                            report_name = "Financial Report";
                        }
                        else if (selected == "4") {
                            report = 'php/reports/curriculum_report/curriculum_report.php';
                            report_name = "Curriculum Report";
                        }
                        else if (selected == "5") {
                            report = 'php/reports/school_and_system_report/school_and_system_report.php';
                            report_name = "School and System Report";
                        }
                        else if (selected == "6") {
                            report = 'php/reports/initiative_report/initiative_report.php';
                            report_name = "Initiative Report";
                        }

                        title_bar = report_name + "     " + start_date + " - " + end_date;

                        document.getElementById("message").innerHTML = "";
                        document.getElementById("view_report").innerHTML = "Processing.....";
                        $("#view_report").load(report, {from_date: start_date, to_date: end_date});
                        $(this).dialog("close");
                        $("#view_report").dialog("open")
                            .dialog("option", "width", $(window).width())
                            .dialog("option", "height",$(window).height());
                        $("span.ui-dialog-title").text(title_bar); 
                    }
                }
            ],
            open: function(event, ui) {
                $(".ui-dialog-titlebar-close", ui.dialog | ui).hide();
            }
        });

        report_button = $("#admin_report").button();

        report_button.click(function(e) {
            e.preventDefault(); 
            $("#view_reports_selection").dialog("open");
        });

        $("#pop_users").dialog({
            title: "Users",
            autoOpen: false,
            buttons: [
                { 
                    text: "Cancel", 
                    click: function() { 
                        $( this ).dialog( "close" ); 
                    }
                }]
        });

        user_button = $("#admin_users").button();

        user_button.click(function(e) {
            e.preventDefault();
            $("#pop_users").dialog("open")
                .dialog("option", "width", $(window).width())
                .dialog("option", "height",$(window).height());
        });

</script>


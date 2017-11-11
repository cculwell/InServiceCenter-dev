$(document).ready(function () {

    var case_value = "";

    // Change caret direction to down
    $(".dropdown").on("hide.bs.dropdown", function(){
        $("#reports_dropdown").html('Select A Report <span class="caret"></span>');
    });

    // Change caret direction to up
    $(".dropdown").on("show.bs.dropdown", function(){
        $("#reports_dropdown").html('Select A Report <span class="caret caret-up"></span>');
    });

    $(".dropdown-menu li a").click(function(){

        var generate = "Generate " + $(this).text();
        var type = $(this).data("type");

        case_value = type;

        $(".btn:first-child").text(generate);
        $(".btn:first-child").val(generate);
    });

    //Select report and load it
    $("#generate_report").on('click', function () {

        var error_message = "";
        var report = "";
        var from_date = document.getElementById("from_date").value;
        var to_date = document.getElementById("to_date").value;

        // Error checking
        if(case_value == "")
        {
            error_message = "Please select a report to generate.";
            document.getElementById("message").style.color = 'red';
            document.getElementById("message").style.fontWeight = 'bold';
            document.getElementById("message").innerHTML = error_message;
            return false;
        }

        if(Date.parse(to_date) < Date.parse(from_date))
        {
            error_message = "End date cannot be before the Start date.";
            document.getElementById("message").style.color = 'red';
            document.getElementById("message").style.fontWeight = 'bold';
            document.getElementById("message").innerHTML = error_message;
            return false;
        }
        if(from_date == '' || to_date == '')
        {
            error_message = "Please pick a date range.";
            document.getElementById("message").style.color = 'red';
            document.getElementById("message").style.fontWeight = 'bold';
            document.getElementById("message").innerHTML = error_message;
            return false;
        }

        // Set dialig to processing
        document.getElementById("message").style.color = 'black';
        document.getElementById("message").style.fontWeight = 'normal';
        document.getElementById("message").innerHTML = "Processing....";

        // Determine what report to load
        if (case_value == "1") {
            report = 'php/reports/quick_report/quick_report.php';
        }
        else if (case_value == "2") {
            report = 'php/reports/detailed_report/detailed_report.php';
        }
        else if (case_value == "3") {
            report = 'php/reports/financial_report/financial_report.php';
        }
        else if (case_value == "4") {
            report = 'php/reports/curriculum_report/curriculum_report.php';
        }
        else if (case_value == "5") {
            report = 'php/reports/school_and_system_report/school_and_system_report.php';
        }
        else if (case_value == "6") {
            report = 'php/reports/initiative_report/initiative_report.php';
        }

        $.ajax({
                    type: "POST",
                    data:
                    {
                        from_date: from_date,
                        to_date: to_date
                    },
                    url: report,
                    success: function(data)
                    {
                        document.getElementById("message").innerHTML = "";
                        $("#report-table-placeholder").html(data);
                    },
                    error: function(jqXHR, exception) {
                        var error = '(' + jqXHR + ') ' + exception;
                        if (error == "([object Object]) error")
                        {
                            error_message = "The requested report doesn't exist at this time.";
                            document.getElementById("message").style.color = 'red';
                            document.getElementById("message").style.fontWeight = 'bold';
                            document.getElementById("message").innerHTML = error_message;
                        }
                        else
                        {
                            document.getElementById("message").innerHTML = "";
                            alert('ERROR: ' + error);
                        }
                    }
                });
    });
});
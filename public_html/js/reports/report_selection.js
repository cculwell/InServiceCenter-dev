$(document).ready(function () {



    // Change caret direction to down
    $(".dropdown").on("hide.bs.dropdown", function(){
        $("#reports_dropdown").html('Select A Report <span class="caret"></span>');
    });

    // Change caret direction to up
    $(".dropdown").on("show.bs.dropdown", function(){
        $("#reports_dropdown").html('Select A Report <span class="caret caret-up"></span>');
    });

    // Select report and load it
    $("body").on('click', '.dropdown-menu li a', function () {

        var report = "";
        var type = $(this).data("type");
        var from_date = document.getElementById("from_date").value;
        var to_date = document.getElementById("to_date").value;

        if(Date.parse(to_date) < Date.parse(from_date))
        {
            alert('The "To" date cannot be before the "From" date.');
            return false;
        }
        if(from_date == '' || to_date == '')
        {
            alert("Please pick a date range before selecting a report to generate.");
            return false;
        }

        // Determine what report to load
        if (type == "1") {
            report = 'php/reports/quick_report/quick_report.php';
        }
        else if (type == "2") {
            report = 'php/reports/detailed_report/detailed_report.php';
        }
        else if (type == "3") {
            report = 'php/reports/financial_report/financial_report.php';
        }
        else if (type == "4") {
            report = 'php/reports/curriculum_report/curriculum_report.php';
        }
        else if (type == "5") {
            report = 'php/reports/school_and_system_report/school_and_system_report.php';
        }

        $.ajax({
                    type: "GET",
                    data:
                    {
                        from_date: from_date,
                        to_date: to_date
                    },
                    url: report,
                    success: function(data)
                    {
                        $("#report-table-placeholder").html(data);
                    },
                    error: function(jqXHR, exception) {
                        var error = '(' + jqXHR + ') ' + exception;
                        if (error == "([object Object]) error")
                        {
                            alert("The requested report doesn't exist at this time.");
                        }
                        else
                        {
                            alert('ERROR: ' + error);
                        }
                    }
                });
    });
});
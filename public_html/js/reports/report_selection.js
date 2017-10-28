$(document).ready(function () {

    // Change caret direction to down
    $(".dropdown").on("hide.bs.dropdown", function(){
        $("#reports_dropdown").html('Reports <span class="caret"></span>');
    });

    // Change caret direction to up
    $(".dropdown").on("show.bs.dropdown", function(){
        $("#reports_dropdown").html('Reports <span class="caret caret-up"></span>');
    });

    // Select report and load it
    $("body").on('click', '.dropdown-menu li a', function () {

        var report = "";
        var type = $(this).data("type");

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
                    type: "POST",
                    url: report,
                    success: function(data)
                    {
                        $("#report-table-placeholder").empty();
                        $("#report-table-placeholder").append(data);
                    },
                    error: function(jqXHR, exception) {
                        alert('ERROR: (' + jqXHR + ')' + " " + exception);
                    }
                });

                event.preventDefault(); // Avoid to execute the actual submit of the form.
    });
});
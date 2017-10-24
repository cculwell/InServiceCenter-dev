$(document).ready(function () {

    /* Change caret direction to down */
    $(".dropdown").on("hide.bs.dropdown", function(){
        $("#reports_dropdown").html('Reports <span class="caret"></span>');
    });

    /* Change caret direction to up */
    $(".dropdown").on("show.bs.dropdown", function(){
        $("#reports_dropdown").html('Reports <span class="caret caret-up"></span>');
    });

    /* Display dropdown menu */
    $("body").on('click', '.dropdown-menu li a', function () {

        var type = $(this).data("type");
        var report = document.getElementById("report-table-placeholder");

        /* Create the report */
        if (type == "1") {
            report.innerHTML = "";
            $("#report-table-placeholder").load( 'php/reports/quick_report/quick_report.php' );
        }
        else if (type == "2") {
            report.innerHTML = "";
            $("#report-table-placeholder").load( 'php/reports/detailed_report/detailed_report.php' );
        }
        else if (type == "3") {
            report.innerHTML = "";
            $("#report-table-placeholder").load( 'php/reports/financial_report/financial_report.php' );
        }
        else if (type == "4") {
            report.innerHTML = "";
            $("#report-table-placeholder").load( 'php/reports/curriculum_report/curriculum_report.php' );
        }
        else if (type == "5") {
            report.innerHTML = "";
            $("#report-table-placeholder").load( 'php/reports/school_and_system_report/school_and_system_report.php' );
        }
    });
});
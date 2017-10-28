$(document).ready(function() {
    var term_text = document.getElementById("term-and-year");
    var month = new Date().getMonth();
    var year = new Date().getFullYear();
    var term = "";

    /* Get the term based on the current month */
    if (month >= 1 && month <= 4) {
        term = "Spring";
    }

    if (month >= 5 && month <= 7) {
        term = "Summer";
    }

    if (month >= 8 && month <= 12) {
        term = "Fall";
    }

    term = term + " " + year;

    term_text.innerHTML = term;

    $('#school_and_system_report_table').DataTable( {
        dom: 'Bfrtip',
        "scrollX": true,
        buttons: {
            buttons: [
                {
                    extend: 'print',
                    text: 'Print Table', 
                    title: 'School and System Report',
                    autoPrint: true
                },
                {
                    extend: 'colvis',
                    text: 'Hide/Unhide Columns'
                },
                {
                    extend: 'pdfHtml5',
                    text: 'Save to PDF',
                    action: function(e, dt, node, config) 
                    {
                        var req = new XMLHttpRequest();

                        req.open("POST", "php/reports/school_and_system_report/create_school_and_system_report_pdf.php", true);
                        req.responseType = "blob";

                        req.onreadystatechange = function () 
                        {
                            if (req.readyState === 4 && req.status === 200) 
                            {
                                var filename = "SchoolSystemReport-" + new Date().getTime() + ".pdf";
                                if (typeof window.chrome !== 'undefined') 
                                {
                                    // Chrome version
                                    var link = document.createElement('a');

                                    link.href = window.URL.createObjectURL(req.response);
                                    link.download = "SchoolSystemReport-" + new Date().getTime() + ".pdf";
                                    link.click();
                                } 
                                else if (typeof window.navigator.msSaveBlob !== 'undefined') 
                                {
                                    // IE version
                                    var blob = new Blob([req.response], { type: 'application/pdf' });
                                    window.navigator.msSaveBlob(blob, filename);
                                }
                                else
                                {
                                    // Firefox version
                                    var file = new File([req.response], filename, { type: 'application/force-download' });
                                    window.open(URL.createObjectURL(file));
                                }
                            }
                        };
                        req.send();
                    }
                }
            ],
            columnDefs: [ {
                visible: false
            }]
        }
    });
});
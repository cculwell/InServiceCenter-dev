var term = "";

$(document).ready(function() {
    var term_text = document.getElementById("term-and-year");
    var month = new Date().getMonth();
    var year = new Date().getFullYear();

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

    $('#financial_report_table').DataTable( {
        dom: 'Bfrtip',
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Sum consultant fees
            consultant_fee_total = api
                .column(12)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Sum misc fees
            misc_fee_total = api
                .column(13)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $(api.column(11).footer()).html('Totals:');
            $(api.column(12).footer()).html('$' + consultant_fee_total);
            $(api.column(13).footer()).html('$' + misc_fee_total);
        },
        buttons: {
            buttons: [
                {
                    extend: 'print',
                    text: 'Print Table', 
                    title: 'Financial Report',
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

                        req.open("POST", "php/reports/financial_report/create_financial_report_pdf.php", true);
                        req.responseType = "blob";

                        req.onreadystatechange = function () 
                        {
                            if (req.readyState === 4 && req.status === 200) 
                            {
                                var filename = "FinancialReport-" + new Date().getTime() + ".pdf";
                                if (typeof window.chrome !== 'undefined') 
                                {
                                    // Chrome version
                                    var link = document.createElement('a');

                                    link.href = window.URL.createObjectURL(req.response);
                                    link.download = "FinancialReport-" + new Date().getTime() + ".pdf";
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
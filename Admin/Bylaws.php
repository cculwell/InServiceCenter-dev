<?php
    require "../resources/config.php";

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

<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Bylaws</title>

        <link rel="stylesheet" href="../resources/library/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../resources/library/bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../resources/library/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="../resources/library/DataTables/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="../Admin/css/Admin.css" />

        <script src="../resources/library/DataTables/js/jquery.dataTables.min.js"></script>
    </head>
    
<body>
    <div class="panel-body">    
        <div class="content_container">
            <button id="del-bylaws-btn" name="del-subscriber-btn">Delete Bylaws</button>
            <button id="set-current-bylaw" name="set-current-btn">Set Current Bylaws</button>
            <br><br>
            <table id="bylaw_table" class="display table-responsive" cellspacing="0" width="100%"> 
                <thead>
                    <tr> 
                        <th>Bylaw Name</th> 
                        <th>Current Bylaws</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $sql = "SELECT name, current FROM bylaws";

                        if ($result = mysqli_query($mysqli, $sql))
                        {
                            while ($row = mysqli_fetch_row($result))
                            {
                                echo
                                    "<tr>"
                                    ."<td>" . $row[0] . "</td>";

                                if ($row[1] == 'yes') // Is this the file set to view by site visitors?
                                {
                                    echo
                                        "<td><img src='../Admin/img/db_table_icons/accept.png' /></td>"
                                        ."</tr>"; 
                                }
                                else
                                {
                                    echo
                                        "<td></td></tr>";                                   
                                }
                            }
                        }
                    ?>
                </tbody>
            </table><br>

            <form id='upload_bylaws' enctype='multipart/form-data'>
                <label>Upload Bylaws:</label>
                <input type="file" name="bylaws_to_upload" id="bylaws_to_upload"><br>
                <input type="button" name="submit" id="submit_button" value="Upload">
            </form>
        </div>
    </div>
    <script>
        var bylaws = $('#bylaw_table').DataTable({
                        lengthChange: false,
                        select: {
                            style:          'single'
                        },
                        columnDefs: [
                            { "width": 600, "targets": 0},
                            { "width": 600, "targets": 1}
                        ]
                    });

        $('#bylaw_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                bylaws.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });
     
        $('#del-bylaws-btn').click( function () {
            var bylaw_file = bylaws.row('.selected').data()[0];
            var form_data = new FormData();

            if (!(confirm('Are you sure you want to delete "' + bylaw_file + '"?'))) 
            {
                return false;
            } 
            else 
            {
                form_data.append('file', bylaw_file);
                form_data.append('table', 'bylaws');

                $.ajax({

                    type: "POST",
                    url: "../Admin/php/admin/delete_file.php",
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,

                    success: function(data) {
                        // data is ur summary
                        console.log(data);
                        if (data == 'deleted')
                        {
                            bylaws.row('.selected').remove().draw();                                    
                        }
                        else
                        {
                            alert(data); //Will print error returned by the database
                        }

                    },
                    error: function(data){
                            alert(data); //Will print error returned
                    }
                });
            }
        });

        $('#set-current-bylaw').click( function () {
            var bylaw_file = bylaws.row('.selected').data()[0];
            var form_data = new FormData();

            if(bylaw_file == null)
            {
                return false;
            }

            form_data.append('file', bylaw_file);
            form_data.append('table', 'bylaws');

            $.ajax({

                type: "POST",
                url: "../Admin/php/admin/set_current_file.php",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,

                success: function(data) {
                    if (data == 'set_current')
                    {
                        $('#pop_bylaws_upload').load("../Admin/Bylaws.php");
                    }
                    else
                    {
                        alert(data); //Will print error returned by the database
                    }
                },
                error: function(data){
                        alert(data); //Will print error returned
                }
            });
        });

        $('#submit_button').click( function () {
            var file_data = document.getElementById("bylaws_to_upload").files;
            var form_data = new FormData(); 

            if ((file_data[0].type != 'application/pdf') ||
                (file_data[0].name.substr(file_data[0].name.lastIndexOf('.')) != '.pdf'))
            {
                alert("Only pdf files are supported for upload");
                return false;
            }

            if (file_data[0].size > 10000000) //10MB
            {
                alert("File sizes must be 10MB and under");
                return false;
            }

            form_data.append('the_file', file_data[0]);
            form_data.append('table', 'bylaws');
            form_data.append('directory', 'Bylaws');

            $.ajax({

                type: 'POST',
                url : '../Admin/php/admin/upload_file.php',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         

                success: function(data) {
                    if (data.indexOf('successfully uploaded') >= 0)
                    {   
                        alert(data);
                        $('#pop_bylaws_upload').load("../Admin/Bylaws.php");
                    }
                    else
                    {
                        alert(data); //Will print error returned by the database
                    }
                },
                error: function(data){
                    alert(data); //Will print error returned
                }
            });
        });
    </script>
</body>
</html>

<?php
    mysqli_close($mysqli);
?>
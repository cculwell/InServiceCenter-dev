<?php

$request_id = 7;
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

<table id="tbl_contacts" class="display table-responsive" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Role</th>
        <th>Phone #</th>
        <th>Email</th>
        <th>Address</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Role</th>
        <th>Phone #</th>
        <th>Email</th>
        <th>Address</th>
    </tr>
    </tfoot>
    <tbody>
    <?PHP

    $sql  = "select ";
    $sql .= "contact_id, contact_name, contact_role, contact_phn_nbr, contact_email, contact_address ";
    $sql .= "from contacts where request_id = 7";
    //$sql .= $request_id;

    if ($result=mysqli_query($mysqli,$sql))
    {
        // Fetch one and one row
        while ($row=mysqli_fetch_row($result))
        {
            echo
                "<tr>"
                ."<td>".$row[0] ."</td>"
                ."<td>".$row[1] ."</td>"
                ."<td>".$row[2] ."</td>"
                ."<td>".$row[3] ."</td>"
                ."<td>".$row[4] ."</td>"
                ."<td>".$row[5] ."</td>"
                ."</tr>";
        }
        // Free result set
        mysqli_free_result($result);
    }

    //      mysqli_close($mysqli);

    ?>
    </tbody>
</table>
<!--<script>-->
<!--    var queue = $('#tbl_new_req').DataTable({-->
<!--        select: {-->
<!--            style:          'single'-->
<!--        }-->
<!--    });-->
<!--    //queue.rows( { selected: true } ).data();-->
<!--    queue.on( 'select', function ( e, dt, type, indexes ) {-->
<!--        if ( type === 'row' ) {-->
<!--            //var data = queue.rows( indexes ).data().pluck( 'id' );-->
<!--            var record = queue.rows( { selected: true } ).data();-->
<!--            // do something with the ID of the selected items-->
<!--//            console.log(record[0][0]);-->
<!--            $.ajax({-->
<!---->
<!--                type: "POST",//post-->
<!--                //url: $(this).attr('href'),-->
<!--                url: "php/div_wq_form.php",-->
<!--                data: "request_id="+record[0][0], // appears as $_POST['id'] @ ur backend side-->
<!--                success: function(data) {-->
<!--                    // data is ur summary-->
<!--                    $('#div_wq_form').html(data);-->
<!--                }-->
<!---->
<!--            });-->
<!--        }-->
<!--    } );-->
<!---->
<!---->
<!--</script>-->
<!---->
<!--<script>-->
<!--    $("#tabs").tabs();-->
<!--</script>-->

<?php
mysqli_close($mysqli);
?>

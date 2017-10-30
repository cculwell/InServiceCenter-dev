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

<form id="request_form">
    <?PHP

    if (isset($_POST['request_id'])) {
        //echo "This var is set so I will print.";
        $request_id = $_POST['request_id'];

        $sql  = "select ";
        $sql .= "  r.request_id ";
        $sql .= ", r.request_type ";
        $sql .= ", r.workflow_state ";
        $sql .= ", r.school ";
        $sql .= ", r.system ";
        $sql .= ", r.request_desc ";
        $sql .= ", r.request_just ";
        $sql .= ", r.target_participants ";
        $sql .= ", r.enrolled_participants ";
        $sql .= ", r.total_hours ";
        $sql .= ", r.total_cost ";
        $sql .= ", r.eval_method ";
        $sql .= ", r.stipd ";
        $sql .= ", b.book_id ";
        $sql .= ", b.book_title ";
        $sql .= ", b.publisher ";
        $sql .= ", b.isbn ";
        $sql .= ", b.cost_per_book ";
        $sql .= ", b.study_format ";
        $sql .= ", b.admin_signature ";
        $sql .= ", w.workshop_id ";
        $sql .= ", w.program_nbr ";
        $sql .= ", w.pd_title ";
        $sql .= ", w.pd_desc ";
        $sql .= ", w.standards_covered ";
        $sql .= ", w.target_group ";
        $sql .= ", w.actual_participants ";
        $sql .= ", w.consultant_fee ";
        $sql .= ", w.travel ";
        $sql .= ", w.other_info ";
        $sql .= ", w.stipd ";
        $sql .= ", w.room_res_needed ";
        $sql .= ", w.sti_title_nbr ";
        $sql .= ", w.folder_completed ";
        $sql .= ", r.request_location ";
        $sql .= ", w.support_initiative ";
        $sql .= " from requests r ";
        $sql .= " left join workshops w ";
        $sql .= "   on r.request_id = w.request_id ";
        $sql .= " left join books b ";
        $sql .= "   on r.request_id = b.request_id ";
        $sql .= " where r.request_id = ";
        $sql .= $request_id;

//        $sql  = "select ";
//        $sql .= "request_id, request_type, workflow_state, school, system ";
//        $sql .= "from requests where request_id = ";
//        $sql .= $request_id;

        if ($result=mysqli_query($mysqli,$sql))
        {
            $row = mysqli_fetch_row($result);
            // Free result set
            mysqli_free_result($result);
        }

        $request_type = $row[1];
        $workflow_state = $row[2];
        $school = $row[3];
        $system = $row[4];
        $program_nbr = $row[21];
        $workshop = null;
        $request_desc = $row[5];
        $request_just = $row[6];
        $target_participants = $row[7];
        $enrolled_participants = $row[8];
        $actual_participants = $row[26];
        $study_format = $row[18];
        $eval_method = $row[11];
        $total_cost = $row[10];
        $request_location = $row[34];
        $support_initiative = $row[35];
    }
    else
    {
        $request_id = null;
        $request_type = null;
        $workflow_state = null;
        $school = null;
        $system = null;
        $program_nbr = null;
        $workshop = "Yes";
        $request_desc = null;
        $request_just = null;
        $target_participants = null;
        $enrolled_participants = null;
        $actual_participants = null;
        $study_format = null;
        $eval_method = null;
        $total_cost = null;
        $request_location = null;
        $support_initiative = null;
    }
    ?>
    <!-- Request Info -->

<!--    <div class="panel panel-primary">-->
<!--        <div class="panel-heading">Request Information</div>-->
<!--        <div class="panel-body">-->
            <div class="row form-group" id="request_info">
                <div class="col-xs-4">
                    <label for="request_id">Request ID:</label>
                    <input type="text" id="request_id" name="request_id" size="10"
                           value="<?php echo $request_id;?>" disabled>
                </div>
                <div class="col-xs-4">
                    <label for="program_nbr">Program #:</label>
                    <input type="text" id="program_nbr" name="program_nbr" size="10"
                           value="<?php echo $program_nbr;?>">
                </div>
                <div class="col-xs-4 col-xs-pull-1">
                    <label for="workshop">Workshop:</label>
                    <input type="checkbox" id="workshop" name="workshop" size="5000"
                        value="1">
                </div>



            </div>

                <div class="row form-group" id="request_type_state_row">

                    <div class="col-xs-4 form-group">
                        <label class="col-xs-3 control-label" for="request_type">Request Type:</label>

                        <div class="col-xs-9 col-xs-push-1" size="10">
                            <select id="request_type" class="form-control">
                                <option <?php if($request_type == 'General') echo"selected";?> value="General">General</option>
                                <option <?php if($request_type == 'BookStudy') echo"selected";?> value="BookStudy">Book Study</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-8 form-group">
                    <label class="col-xs-3 control-label" for="workflow_state">Workflow State:</label>

                    <div class="col-xs-9">
                        <select id="workflow_state" class="form-control">
                            <option <?php if($workflow_state == 'New') echo"selected";?> value="New">New</option>
                            <option <?php if($workflow_state == 'Under Review') echo"selected";?> value="Under Review">Under Review</option>
                            <option <?php if($workflow_state == 'Board Vote') echo"selected";?> value="Board Vote">Board Vote</option>
                            <option <?php if($workflow_state == 'Start Purchase Order') echo"selected";?> value="Start Purchase Order">Start Purchase Order</option>
                            <option <?php if($workflow_state == 'Order/Contract Issued') echo"selected";?> value="Order/Contract Issued">Order/Contract Issued</option>
                            <option <?php if($workflow_state == 'Completed') echo"selected";?> value="Completed">Completed</option>
                            <option <?php if($workflow_state == 'Canceled') echo"selected";?> value="Canceled">Canceled</option>
                        </select>
                        <script>
                            $(document).ready(function(){
                                $('#workflow_state').change(function(e){
                                    $this = $(e.target);
                                    $request_id = $('#request_id')[0].value;

//                                        console.log($request_id);
                                    $.ajax({
                                        type: "POST",
                                        url:  "php/workqueue.php", // Don't know asp/asp.net at all so you will have to do this bit
                                        data: { trigger_name: "workflow_state_change",
                                            request_id: $request_id,
                                            workflow_state: $this.val()
//                                                workflow_state: $("#workflow_state option:selected").text()
                                        },
                                        dataType: "html",
                                        success: function(data){
//                                                $('#debug').html("success");
                                            console.log("success:");
                                            console.log(data);
                                            $("#div_wq_tables").load( 'php/div_wq_tables.php' );

//                                                alert(data);
                                        },
                                        error: function(data){
//                                                $('#debug').html("error");
                                            console.log("success:");
//                                                console.log(data);
                                        },
                                        complete: function (data) {
//                                                $("#tabs").tabs({ active: 1 });
                                        }
                                    });
                                });

                            });
                        </script>
                    </div>
                    </div>
                    <div class="row form-group" id="support_init_row">
                        <div class="col-xs-4 col-xs-push-0 form-group">
                            <label class="col-xs-3 control-label" for="support_init">Support Initiative:</label>

                            <div class="col-xs-9 col-xs-push-1" size="5">
                                <select id="support_init" class="form-control">
                                    <option <?php if($request_type == '') echo"selected";?> value=""></option>
                                    <option <?php if($request_type == 'AMSTI') echo"selected";?> value="AMSTI">AMSTI</option>
                                    <option <?php if($request_type == 'ASIM') echo"selected";?> value="ASIM">ASIM</option>
                                    <option <?php if($request_type == 'TIM') echo"selected";?> value="TIM">TIM</option>
                                    <option <?php if($request_type == 'RIC') echo"selected";?> value="RIC">RIC</option>
                                    <option <?php if($request_type == 'LEA') echo"selected";?> value="LEA">LEA</option>
                                    <option <?php if($request_type == 'ALSDE') echo"selected";?> value="ALSDE">ALSDE</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    </div>
                </div>

                <div class="row form-group" id="school_system_row">
                    <div class="col-xs-6 pull-left">
                        <label for="school">School:</label>
                        <input type="text" id="school" name="school" size="25"
                               maxlength="50" value="<?php echo $school;?>">
                    </div>
                    <div class="col-xs-6 pull-left">
                        <label for="system">System: </label>
                        <input type="text" id="system" name="system" size="25"
                               maxlength="50" value="<?php echo $system;?>">
                    </div>
                </div>

        <div id="wq_detail_tabs">
            <ul id="wq_details_tabs_ul">
                <li><a href="#request_info">Request Info</a></li>
                <li><a href="#contacts">Contacts</a></li>
                <li><a href="#program_exp">Program Expenses</a></li>
                <li><a href="#consultant_exp">Consultant Expense</a></li>
                <li><a href="#reports">Reports</a></li>
                <li><a href="#eval_comments">Comments</a></li>
                <li><a href="#sti-pd">STI-PD</a></li>
            </ul>

            <div id="request_info">
                <!-- Request Description -->
                <div class="row form-group" id="request_desc_row">
                    <div class="col-xs-12">
                        <label class="col-md-push-12 pull-left">Request Description</label>
                        <textarea class="form-control col-md-6" style="width:100%" rows="3"
                                  id="request_desc" name="request_desc"><?php echo $request_desc;?></textarea>
                    </div>
                </div>
                <!-- Request Justification -->
                <div class="row form-group" id="request_just_row">
                    <div class="col-xs-12">
                        <label class="col-md-push-12 pull-left">Need / Justification</label>
                        <textarea class="form-control col-md-6" style="width:100%" rows="3"
                                  id="request_just" name="request_just"><?php echo $request_desc;?></textarea>
                    </div>
                </div>

                <!-- Location and Targets -->
                <div class="row form-group" id="location_participants_row">
                    <div class="form-group col-xs-4" id="target_part_sec">
                        <label for="eval_method">Target Participants #</label>
                        <input type="text"  id="target_participants" name="target_participants"
                               maxlength="50" value="<?php echo $target_participants;?>">
                    </div>

                    <div class="form-group col-xs-4">
                        <label for="total_cost">Enrolled Participants #</label>
                        <input type="text"  id="enrolled_participants" name="enrolled_participants"
                               maxlength="25" value="<?php echo $enrolled_participants;?>">
                    </div>

                    <div class="form-group col-xs-4">
                        <label for="total_cost">Actual Participants #</label>
                        <input type="text"  id="actual_participants" name="actual_participants"
                               maxlength="25" value="<?php echo $actual_participants;?>">
                    </div>
                </div>

                <!-- Method of Eval or Format of Study -->
                <div class="row form-group" id="format_method_row">

                    <div class="form-group col-xs-4 " id="study_format_sec">
                        <label for="study_format">Study Format</label>
                        <input type="text"  id="study_format" name="study_format"
                               maxlength="100" value="<?php echo $study_format;?>">
                    </div>

                    <div class="form-group col-xs-4" id="eval_method_sec">
                        <label for="eval_method">Evaluation Method</label>
                        <input type="text"  id="eval_method" name="eval_method"
                               maxlength="50" value="<?php echo $eval_method;?>">
                    </div>

                    <div class="form-group col-xs-4">
                        <div class="input-group input-group-xs">
                            <label for="total_cost">Request Amt / Tot Cost</label>
                            <input type="text"  id="total_cost" name="total_cost"
                                   maxlength="25" value="<?php echo $total_cost;?>">
                        </div>
                    </div>
<!--                    <div class="form-group col-xs-4">-->
<!--                        <label for="total_hours">Total Hours</label>-->
<!--                        <input type="text"  id="total_hours" name="total_hours" maxlength="25">-->
<!--                    </div>-->
                </div>

                <!-- Location and Targets -->
                <div class="row input-group" id="location_participants_row">
                    <div class="form-group col-xs-12" id="location_sec">
                        <label for="study_format">Location:</label>
                        <input type="text"  id="request_location" name="request_location" size="75"
                               maxlength="100" value="<?php echo $request_location;?>">
                    </div>
                </div>


                <!-- Date/Time Buttons -->
                <div class="row input-group" id="dt_button_row">
                    <div class="form-group col-xs-12" id="dt_button_sec">
                        <button id="dt_new_btn">New</button>
                        <button id="dt_edit_btn">Edit</button>
                        <button id="dt_delete_btn">Delete</button>
                    </div>
                </div>

                <!-- Date / Times-->
                <div id="date_time_div" class="form-group row">
                    <table id="tbl_date_times" class="display table-responsive" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Breaks</th>
                            <th>Hours</th>
                            <th>Notes</th>
<!--                            <th></th>-->
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
<!--                            <th></th>-->
                        </tr>
                        </tfoot>
                        <tbody>
                        <?PHP

                        $sql_dates_times  = "select ";
                        $sql_dates_times .= "request_dt_id, request_date, request_start_time, request_end_time, ";
                        $sql_dates_times .= "request_break_time, ";
                        $sql_dates_times .= "round(TIME_TO_SEC(timediff(request_end_time, request_start_time))/3600 - request_break_time, 2) as total_hours, ";
                        $sql_dates_times .= "request_dt_note ";
                        $sql_dates_times .= "from date_times where request_id =";
                        $sql_dates_times .= $request_id;
                        $sql_dates_times .= " order by request_date, request_start_time";

                        if ($result_contacts=mysqli_query($mysqli,$sql_dates_times))
                        {
                            // Fetch one and one row
                            while ($row=mysqli_fetch_row($result_contacts))
                            {
                                echo
                                    "<tr>"
                                        ."<td>".$row[0] ."</td>"
                                        ."<td>".$row[1] ."</td>"
                                        ."<td>".$row[2] ."</td>"
                                        ."<td>".$row[3] ."</td>"
                                        ."<td>".$row[4] ."</td>"
                                        ."<td>".$row[5] ."</td>"
                                        ."<td>".$row[6] ."</td>"
//                                        ."<td>"
//                                            . "<button type='button' class='btn btn-default btn-sm' id=''>"
//                                                . "<span class='glyphicon glyphicon-edit'></span>"
//                                            . "</button>"
//                                        ."</td>"
                                    ."</tr>";
                            }
                            // Free result set
                            mysqli_free_result($result_contacts);
                        }

                        //      mysqli_close($mysqli);

                        ?>
                        </tbody>
                    </table>
                    <div id="div_pop_dt">
                        <form class="form form-vertical" id="pop_dt_form_id">
                            <div class="form-group pop_dt_id_grp">
                                <label class="column-label col-xs-3" for="pop_dt_id" hidden>ID</label>
                                <input class="col-xs-9" type="number" id="pop_dt_id" disabled hidden>
                            </div>
                            <div class="form-group">
                                <label class="column-label col-xs-3" for="pop_dt_date">Date:</label>
                                <input class="col-xs-9" type="date" id="pop_dt_date">
                            </div>
                            <div class="form-group">
                                <label class="column-label col-xs-3" for="pop_dt_start">Start Time:</label>
                                <input class="col-xs-9" type="time" id="pop_dt_start">
                            </div>
                            <div class="form-group">
                                <label class="column-label col-xs-3" for="pop_dt_end">End Time:</label>
                                <input class="col-xs-9" type="time" id="pop_dt_end">
                            </div>
                            <div class="form-group">
                                <label class="column-label col-xs-3" for="pop_dt_break">Break Time:</label>
                                <input class="col-xs-9" type="number" id="pop_dt_break">
                            </div>
                            <div class="form-group">
                                <label class="column-label col-xs-3" for="pop_dt_note">Note:</label>
                                <input class="col-xs-9" type="text" id="pop_dt_note">
                            </div>
                        </form>
                    </div>
                    <script>
                        var date_times = $('#tbl_date_times').DataTable({
                            "footerCallback": function ( row, data, start, end, display ) {
                                var api = this.api(), data;

                                // Remove the formatting to get integer data for summation
                                var intVal = function ( i ) {
                                    return typeof i === 'string' ?
                                        i.replace(/[\$,]/g, '')*1 :
                                        typeof i === 'number' ?
                                            i : 0;
                                };

                                // Total over all pages
                                total = api
                                    .column( 5 )
                                    .data()
                                    .reduce( function (a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0 );

                                // Total over this page
                                pageTotal = api
                                    .column( 5, { page: 'current'} )
                                    .data()
                                    .reduce( function (a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0 );

                                // Update footer
                                $( api.column( 5 ).footer() ).html(
                                    //pageTotal +' ( '+ total +' total)'
                                    'Total: ' + pageTotal
                                );
                            },
                            select: {
                                style:      'single'
                            },
                            ordering: false,
                            info:     false,
                            searching: false,
                            paging:   false,
                            columnDefs: [
                                {
                                    "targets": [ 0 ],
                                    "visible": false,
                                    "searchable": false
                                },
                                { "width": "15%", "targets": 1},
                                { "width": "15%", "targets": 2},
                                { "width": "15%", "targets": 3},
                                { "width": "10%", "targets": 4},
                                { "width": "15%", "targets": 5},
                                { "width": "25%", "targets": 6},
                            ]

                        });


                        $("#div_pop_dt").dialog({
                            autoOpen: false,
                            buttons: {
                                Update: function(){

                                },
                                Cancel: function(){
                                    $(this).dialog("close");
                                }
                            }
                        });

                        $("#dt_new_btn").click(function(e) {
                            e.preventDefault();
                            $("#pop_dt_id").val('');
                            $("#pop_dt_date").val('');
                            $("#pop_dt_start").val('');
                            $("#pop_dt_end").val('');
                            $("#pop_dt_break").val('');
                            $("#pop_dt_note").val('');

                            $("#div_pop_dt").dialog("open")
                                .dialog("option", "width", 500);

                        });

                        $("#dt_edit_btn").click(function(e) {
                            e.preventDefault();
                            var date_time = date_times.rows( { selected: true } ).data();
//                            console.log(date_time[0]);
                            $("#pop_dt_id").val(date_time[0][0]);
                            $("#pop_dt_date").val(date_time[0][1]);
                            $("#pop_dt_start").val(date_time[0][2]);
                            $("#pop_dt_end").val(date_time[0][3]);
                            $("#pop_dt_break").val(date_time[0][4]);
                            $("#pop_dt_note").val(date_time[0][6]);


                            $("#div_pop_dt").dialog("open")
                                .dialog("option", "width", 500);

                            //$("#pop_dt_id_grp").hide();
                        });

                        $("#dt_delete_btn").click(function(e) {
                            e.preventDefault();
                            alert("You clicked Delete");
                        });


                    </script>

                </div>
            </div>


            <div id="contacts">
                <!-- Contacts Buttons -->
                <div class="row input-group" id="contact_button_row">
                    <div class="form-group col-xs-12" id="contact_button_sec">
                        <button id="contact_new_btn">New</button>
                        <button id="contact_edit_btn">Edit</button>
                        <button id="contact_delete_btn">Delete</button>
                    </div>
                </div>


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

                    $sql_contacts  = "select ";
                    $sql_contacts .= "contact_id, contact_name, contact_role, contact_phn_nbr, contact_email, contact_address ";
                    $sql_contacts .= "from contacts where request_id =";
                    $sql_contacts .= $request_id;

                    if ($result_contacts=mysqli_query($mysqli,$sql_contacts))
                    {
                        // Fetch one and one row
                        while ($row=mysqli_fetch_row($result_contacts))
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
                        mysqli_free_result($result_contacts);
                    }

                    //      mysqli_close($mysqli);

                    ?>
                    </tbody>
                </table>

                 Popup Contacts
                <div id="div_pop_contact">
                    <form class="form form-vertical" id="pop_contact_form_id">
                        <div class="form-group">
                            <label class="column-label col-xs-3" for="pop_contact_id" hidden>ID</label>
                            <input class="col-xs-9" type="text" id="pop_contact_id" disabled hidden>
                        </div>
                        <div class="form-group">
                            <label class="column-label col-xs-3" for="pop_contact_name">Name:</label>
                            <input class="col-xs-9" type="text" id="pop_contact_name">
                        </div>
                        <div class="form-group">
                            <label class="column-label col-xs-3" for="pop_contact_role">Role:</label>
                            <input class="col-xs-9" type="text" id="pop_contact_role">
                        </div>
                        <div class="form-group">
                            <label class="column-label col-xs-3" for="pop_contact_phn_nbr">Phone #:</label>
                            <input class="col-xs-9" type="text" id="pop_contact_phn_nbr">
                        </div>
                        <div class="form-group">
                            <label class="column-label col-xs-3" for="pop_contact_email">Email:</label>
                            <input class="col-xs-9" type="text" id="pop_contact_email">
                        </div>
                        <div class="form-group">
                            <label class="column-label col-xs-3" for="pop_contact_address">Address:</label>
                            <input class="col-xs-9" type="text" id="pop_contact_address">
                        </div>
                    </form>
                </div>

                <script>
                    var contacts = $('#tbl_contacts').DataTable({
                        select: {
                            style:          'single'
                        },
                        columnDefs: [
                            {
                                "targets": [ 0 ],
                                "visible": false,
                                "searchable": false
                            }
                        ]
                    });
//                    contacts.on('dblclick', 'tr', function () {
//                        //var data = table.row( this ).data();
//                        var contact = contacts.rows( { selected: true } ).data();
//                        alert( 'You clicked on '+contact[0]+'\'s row' );
//
//
//                    });


                    $("#div_pop_contact").dialog({
                        autoOpen: false,
                        buttons: {
                            Update: function(){

                            },
                            Cancel: function(){
                                $(this).dialog("close");
                            }
                        }
                    });

                    $("#contact_new_btn").click(function(e) {
                        e.preventDefault();
//                        alert("You clicked New");

                        $("#div_pop_contact").dialog("open")
                            .dialog("option", "width", 500);

                    });

                    $("#contact_edit_btn").click(function(e) {
                        e.preventDefault();
//                        var contacts = date_times.rows( { selected: true } ).data();
//                        alert("You clicked Edit")

                        $("#div_pop_contact").dialog("open")
                            .dialog("option", "width", 500);

                        //$("#pop_dt_id_grp").hide();
                    });

                    $("#contact_delete_btn").click(function(e) {
                        e.preventDefault();
//                        alert("You clicked Delete");
                    });


                </script>


            </div>
            <div id="program_exp">Program Exp Goes Here</div>
            <div id="consultant_exp">Consultant Exp Goes Here</div>
            <div id="reports">Reports Goes Here</div>
            <div id="eval_comments">Eval Comments Goes Here</div>
            <div id="sti-pd">STI-PD Goes Here</div>

        </div>
        <script>
            $("#wq_detail_tabs").tabs();
        </script>


</form>

</html>

<?php
mysqli_close($mysqli);
?>

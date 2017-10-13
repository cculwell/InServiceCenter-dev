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

    }
    else
    {
        $request_id = null;
        $request_type = null;
        $workflow_state = null;
        $school = null;
        $system = null;
        $program_nbr = null;
        $workshop = null;
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
                           value="<?php echo $workshop;?>">
                </div>



            </div>

                <div class="row form-group" id="request_type_state_row">

                    <div class="col-xs-6 form-group">
                        <label class="col-xs-6 control-label" for="request_type">Request Type:</label>

                        <div class="col-xs-6 col-xs-pull-1" size="5">
                            <select id="request_type" class="form-control">
                                <option <?php if($request_type == 'General') echo"selected";?> value="General">General</option>
                                <option <?php if($request_type == 'BookStudy') echo"selected";?> value="BookStudy">Book Study</option>
                            </select>
                        </div>
                    </div>
                <div class="col-xs-6 form-group">
                    <label class="col-xs-6 control-label" for="workflow_state">Workflow State:</label>

                    <div class="col-xs-6 col-xs-pull-1">
                        <select id="workflow_state" class="form-control">
                            <option <?php if($workflow_state == 'New') echo"selected";?> value="New">New</option>
                            <option <?php if($workflow_state == 'Under Review') echo"selected";?> value="Under Review">Under Review</option>
                            <option <?php if($workflow_state == 'Board Vote') echo"selected";?> value="Board Vote">Board Vote</option>
                            <option <?php if($workflow_state == 'Start Purchase Order') echo"selected";?> value="Start Purchase Order">Start Purchase Order</option>
                            <option <?php if($workflow_state == 'Order/Contract Issued') echo"selected";?> value="Order/Contract Issued">Order/Contract Issued</option>
                            <option <?php if($workflow_state == 'Completed') echo"selected";?> value="Completed">Completed</option>
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
                </div>

        <div id="wq_detail_tabs">
            <ul id="wq_details_tabs_ul">
                <li><a href="#program_info">Program Info</a></li>
                <li><a href="#contacts">Contacts</a></li>
                <li><a href="#program_exp">Program Expenses</a></li>
                <li><a href="#consultant_exp">Consultant Expense</a></li>
                <li><a href="#reports">Reports</a></li>
                <li><a href="#eval_comments">Evaluation Comments</a></li>
                <li><a href="#sti-pd">STI-PD</a></li>
            </ul>

            <div id="program_info">
                <!-- Request Description -->
                <div class="row form-group" id="request_desc_row">
                    <div class="col-xs-12">
                        <label class="col-md-push-12 pull-left">Request Description</label>
                        <textarea class="form-control col-md-6" style="width:100%" rows="3"
                                  id="request_desc" name="request_desc"></textarea>
                    </div>
                </div>
                <!-- Request Justification -->
                <div class="row form-group" id="request_just_row">
                    <div class="col-xs-12">
                        <label class="col-md-push-12 pull-left">Need / Justification</label>
                        <textarea class="form-control col-md-6" style="width:100%" rows="3"
                                  id="request_just" name="request_just"></textarea>
                    </div>
                </div>
                <!-- Location and Targets -->
                <div class="row form-group" id="location_participants_row">



                    <div class="form-group col-xs-4" id="target_part_sec">
                        <label for="eval_method">Target Participants #</label>
                        <input type="text"  id="target_participants" name="target_participants" maxlength="50">
                    </div>

                    <div class="form-group col-xs-4">
                        <label for="total_cost">Enrolled Participants #</label>
                        <input type="text"  id="enrolled_participants" name="enrolled_participants" maxlength="25">
                    </div>

                    <div class="form-group col-xs-4">
                        <label for="total_cost">Actual Participants #</label>
                        <input type="text"  id="actual_participants" name="actual_participants" maxlength="25">
                    </div>
                </div>



            </div>
            <div id="contacts">
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
                <script>
                    var contacts = $('#tbl_contacts').DataTable({
                        select: {
                            style:          'compact'
                        },
                        columnDefs: [
                            {
                                "targets": [ 0 ],
                                "visible": false,
                                "searchable": false
                            }
                        ]
                    });
                </script>
            </div>
            <div id="program_exp">Program Exp Goes Here</div>
            <div id="consultant_exp">Consultant Exp Goes Here</div>
            <div id="reports">Reports Goes Here</div>
            <div id="eval_comments">Eval Comments Goes Here</div>
            <div id="sti-pd">STI-PD Goes Here</div>


        </div>
        <script>$("#wq_detail_tabs").tabs();</script>


</form>
</html>

<?php
mysqli_close($mysqli);
?>

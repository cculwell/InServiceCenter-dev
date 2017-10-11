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
        $sql .= "request_id, request_type, workflow_state, school, system ";
        $sql .= "from requests where request_id = ";
        $sql .= $request_id;

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

    }
    else
    {
        $request_id = null;
        $request_type = null;
        $workflow_state = null;
        $school = null;
        $system = null;
    }
    ?>
    <!-- Request Info -->

<!--    <div class="panel panel-primary">-->
<!--        <div class="panel-heading">Request Information</div>-->
<!--        <div class="panel-body">-->
            <div class="row form-group" id="request_info">
                <div class="col-xs-12 col-xs-pull-4">
                    <label for="request_id">Request ID:     </label>
<!--                    <label id="request_id">--><?php //echo $request_id;?><!--</label>-->
                    <input type="text" id="request_id" name="request_id" size="20"
                           value="<?php echo $request_id;?>" disabled>
                </div>
            </div>

                <div class="row form-group" id="request_type_state_row">

                    <div class="col-xs-6 form-group">
                        <label class="col-xs-6 control-label" for="request_type">Request Type:</label>

                        <div class="col-xs-6 col-xs-pull-1">
                            <select id="request_type" class="form-control">
                                <option <?php if($request_type == 'General') echo"selected";?> value="General">General Request</option>
                                <option <?php if($request_type == 'BookStudy') echo"selected";?> value="BookStudy">Book Study</option>
                            </select>




                        </div>
                    </div>


<!--                    <div class="col-xs-6">-->
<!--                        <label for="request_type">Request Type</label>-->
<!--                        <input type="text" id="request_type" name="request_type" size="20"-->
<!--                               maxlength="50" value="--><?php //echo $request_type;?><!--">-->
<!--                    </div>-->


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
                                        console.log("workflow_state change made");

//                                        $.ajax({
//                                            type: "POST",
//                                            url:  "workqueue.php", // Don't know asp/asp.net at all so you will have to do this bit
//                                            data: { trigger_name: "workflow_state_change",
//                                                request_id: request_id
//
//                                            },
//                                            success:function(data){
//                                                //$('#stateBoxHook').html(data);
//                                                alert("workflow change successful");
//                                            },
//                                            error:function(data){
//                                                alert("workflow change error");
//                                            }
//                                        });
                                    });

                                });
                            </script>

    <!--                        <input type="text" id="workflow_state" name="workflow_state" size="20"-->
    <!--                           maxlength="50" value="--><?php //echo $workflow_state;?><!--">-->
                        </div>
                    </div>
                </div>

<!--                </div>-->

<!--            </div>-->

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

            <div id="program_info">Program Info Goes Here</div>
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
            <div id="eval_comments">Eval Comments Goes Here</div>
            <div id="sti-pd">STI-PD Goes Here</div>


        </div>
        <script>$("#wq_detail_tabs").tabs();</script>


</form>
</html>

<?php
mysqli_close($mysqli);
?>

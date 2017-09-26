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
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <title>Work Queue</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../resources/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../resources/library/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../../resources/library/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../../resources/library/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="../../resources/library/DataTables/datatables.css">
    <link rel="stylesheet" href="../../resources/library/DataTables/Select/css/select.datatables.css">
    <!--link rel="stylesheet" href="../css/WorkQueue.css"-->

    <script src="../../resources/library/jquery-3.2.1.min.js"></script>
    <script src="../../resources/library/jquery-ui/jquery-ui.min.js"></script>
    <script src="../../resources/library/DataTables/datatables.js"></script>
    <script src="../../resources/library/DataTables/Select/js/dataTables.select.min.js"></script>


</head>
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
    <div class="panel panel-primary">
        <div class="panel-heading">Request Information</div>
        <div class="panel-body">
            <div class="row form-group" id="request_info">
                <div class="col-xs-12 col-xs-pull-3">
                    <label for="request_id">Request ID</label>
                    <input type="text" id="request_id" name="request_id" size="10"
                           maxlength="50" value="<?php echo $request_id;?>">

                </div>
                <div class="row form-group" id="school_system_row">
                <div class="col-xs-6">
                    <label for="request_type">Request Type</label>
                    <input type="text" id="request_type" name="request_type" size="20"
                           maxlength="50" value="<?php echo $request_type;?>">
                </div>
                <div class="col-xs-6">
                    <label for="request_type">Worflow State</label>
                    <input type="text" id="workflow_state" name="workflow_state" size="20"
                           maxlength="50" value="<?php echo $workflow_state;?>">
                </div>
                </div>
            </div>

            <div class="row form-group" id="school_system_row">
                <div class="col-xs-6 pull-left">
                    <label for="school">School</label>
                    <input type="text" id="school" name="school" size="25"
                           maxlength="50" value="<?php echo $school;?>">
                </div>
                <div class="col-xs-6 pull-left">
                    <label for="system">System</label>
                    <input type="text" id="system" name="system" size="25"
                           maxlength="50" value="<?php echo $system;?>">
                </div>
            </div>
        </div>
    </div>
</form>
</html>

<?php
mysqli_close($mysqli);
?>

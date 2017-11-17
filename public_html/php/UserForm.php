<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <title>Users</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../resources/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/library/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../resources/library/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../resources/library/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="../resources/library/DataTables/datatables.css">
    <link rel="stylesheet" href="../resources/library/DataTables/Select/css/select.dataTables.css">
    <link rel="stylesheet" href="css/WorkQueue.css">

    <script src="../resources/library/jquery-3.2.1.min.js"></script>
    <script src="../resources/library/jquery-ui/jquery-ui.min.js"></script>
    <script src="../resources/library/DataTables/datatables.js"></script>
    <script src="../resources/library/DataTables/Select/js/dataTables.select.min.js"></script>
    <script src="../resources/library/jquery_chained/jquery.chained.js"></script>

</head>
<body>

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
	
		<div class="row input-group" id="dt_button_row">
                    <div class="form-group col-xs-12" id="dt_button_sec">
                        <button id="dt_new_btn">New</button>
                        <button id="dt_edit_btn">Edit</button>
                        <button id="dt_delete_btn">Delete</button>
                    </div>
                </div>
				
		</div>
		
		<div id="date_time_div" class="form-group row">
                    <table id="tbl_date_times" class="display table-responsive" cellspacing="0" width="75%">
                        <thead>
                        <tr>
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
		</div>
		<?php	
		
		$sql = "INSERT INTO users (first_name, last_name, user_email, user_password) VALUES ('Faker', 'McFakerton', 'fake@fake.com', 'fakepassword')";
		$sql = "INSERT INTO users (first_name, last_name, user_email, user_password) VALUES ('Noone', 'Bythatname', 'something@fake.com', 'nottapassword')";
		$sql = "INSERT INTO users (first_name, last_name, user_email, user_password) VALUES ('Who?', 'What?', 'Where?@fake.com', 'Huh?password')";
		$sql = "INSERT INTO users (first_name, last_name, user_email, user_password) VALUES ('Pretend', 'Afakeperson', 'nope@fake.com', 'nopassword')";
		if($mysqli->query($sql) === TRUE){
		echo "New record created";}
		else{
		echo "Error: " . $sql . "<br>" . $mysqli->error;
		}
		
		$sql = "SELECT * FROM users ORDER BY last_name";
		if ($result = mysqli_query($mysqli, $sql))
		{
			echo "<table border='1' cellpadding='10'>";
			while ($row=mysqli_fetch_row($result))
                            {
                                echo
                                    "<tr>"
                                        ."<td>".$row[1] ."</td>"
                                        ."<td>".$row[2] ."</td>"
                                        ."<td>".$row[3] ."</td>"
                                        ."<td>".$row[4] ."</td>"
										."<td>".$row[5] ."</td>"
//                                        ."<td>"
//                                            . "<button type='button' class='btn btn-default btn-sm' id=''>"
//                                                . "<span class='glyphicon glyphicon-edit'></span>"
//                                            . "</button>"
//                                        ."</td>"
                                    ."</tr>";
                            }
                            // Free result set
			mysqli_free_result($result);
		}
		?>
<!--		
		<div class="row form-group" id="user_status">
                        <div class="col-xs-4 col-xs-push-0 form-group">
                            <label class="col-xs-3 control-label" for="user_stat">User status:</label>

                            <div class="col-xs-9 col-xs-push-1" size="5">
                                <select id="user_stat" class="form-control">
									<option <?php if($user_stat == '') echo"selected";?> value=""></option>
                                    <option <?php if($user_stat == 'User') echo"selected";?> value="User">User</option>
                                    <option <?php if($user_stat == 'Admin') echo"selected";?> value="Admin">Admin</option>
                                </select>
                            </div>
                        </div>
        </div>
	-->
</body>
</html>
<?php   
    // Set the selected file to the current viewable file
    require "../../../resources/config.php";
    
    $id = (int) $_GET['id'];
    $table = $_GET['table'];

    $db = $config['db']['amsti_01'];
    $link = new mysqli($db['host'], $db['username'], $db['password'], $db['dbname']) or die('There was a problem connecting to the database.');

    $get_state_query = "SELECT * from $table WHERE id=$id";
    $get_state = $link->query($get_state_query) or die($link->error);

    if ($get_state) {
        // Reset all files to 'deactived'
        $query = "UPDATE $table SET current='no' WHERE current='yes'";
        $result = $link->query($query) or die("Error : ".mysqli_error($link));

        if ($result) {
            $row = mysqli_fetch_array($get_state);
            $current_state = $row['current'];

            if ($current_state == 'yes') {
                $query = "UPDATE $table SET current='no' WHERE id=$id LIMIT 1";
            }
            if ($current_state  == 'no') {
                $query = "UPDATE $table SET current='yes' WHERE id=$id LIMIT 1";
            }

            $stmt = $link->query($query) or die($link->error);
            if (!$stmt) {
                echo "<script type='text/javascript'>alert('ERROR: There was a problem setting the state of the selected file.')</script>"; 
            }
        }
        else {
            echo "<script type='text/javascript'>alert('ERROR: There was a problem deactivating the current file.')</script>";  
        }
    }
    else {
        echo "<script type='text/javascript'>alert('ERROR: There was a problem getting the state of the selected file.')</script>";       
    }

    $link->close();
    $url = "../../" . ucwords($table) . ".php";
    header('refresh: 0; URL=' . $url);
?>
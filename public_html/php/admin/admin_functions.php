<?php 
    // Various admin functions

    // Return all of the rows from the database
    function get_all_rows($table) { 

        require "../resources/config.php";

        $db = $config['db']['admin_files'];
        $link = new mysqli($db['host'], $db['username'], $db['password'], $db['dbname']) or die('There was a problem connecting to the database.');

        $query = "SELECT * FROM $table ORDER BY id ASC";
        $stmt = $link->prepare($query) or die('error'); 
        $stmt->execute(); 
        $meta = $stmt->result_metadata(); 
  
        while ($field = $meta->fetch_field()) { 
            $parameters[] = &$row[$field->name]; 
        } 
  
        $results = array(); 

        call_user_func_array(array($stmt, 'bind_result'), $parameters); 
  
        while ($stmt->fetch()) { 
            foreach ($row as $key => $val) { 
                $x[$key] = $val; 
            } 
            $results[] = $x; 
        } 
  
        return $results; 
        
        $results->close(); 
        $link->close(); 
    }

    // Check if a file already exists
    function check_if_file_exists($table, $file) {

        require "../../../resources/config.php";

        $db = $config['db']['admin_files'];
        $link = new mysqli($db['host'], $db['username'], $db['password'], $db['dbname']) or die('There was a problem connecting to the database.');

        $query = "SELECT name FROM $table WHERE name='$file'";
        $result = $link->query($query) or die("Error : ".mysqli_error($link));

        while ($row = mysqli_fetch_array($result)) {
            if ($row['name'] == $file) {
                return 1;
            }       
        }

        $link->close(); 
    }

    // Add a new file to the database and activate it as the 'current' file
    function add_file_to_database($table, $file, $target) {

        require "../../../resources/config.php";

        $db = $config['db']['admin_files'];
        $link = new mysqli($db['host'], $db['username'], $db['password'], $db['dbname']) or die('There was a problem connecting to the database.');

        // Deactivate the 'current' file
        $query = "UPDATE $table SET current='no' WHERE current='yes'";
        $result = $link->query($query) or die("Error : ".mysqli_error($link));

        $target = addslashes($target);
        $query = "INSERT INTO $table (name, current, file_path) VALUES ('$file','yes','$target')";
        $link->query($query) or die("Error : ".mysqli_error($link)); 

        return $link;

        $link->close();
    }
?>
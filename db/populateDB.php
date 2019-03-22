<?php

    // Name of the sql files you want to import 
    $files = array('usergroup.sql', 'user.sql', 'usertoken.sql', 'service.sql', 'appointment.sql', 'appointment_service.sql', 'payment.sql');
    // MySQL host
    $mysql_host = 'localhost';
    // MySQL username
    $mysql_username = 'root';
    // MySQL password
    $mysql_password = '';
    // Database name
    $mysql_database = 'salon';

    // Connect to MySQL server
    $conn = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);

    // Check connnection
    if ($conn->connect_errno) {
        echo "Failed to connect to MySQL: " . $conn->connect_errno;
        echo "<br/>Error: " . $conn->connect_error;
    }

    foreach($files as $filename) {

        // Temporary variable, used to store current query
        $templine = '';

        // echo "DB/" . $filename;
        // exit;

        // Read in entire file
        $lines = file($filename);



        // Loop through each line
        foreach ($lines as $line) {

            // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }               

            // Add this line to the current segment
            $templine .= $line;

            // If it has a semicolon at the end, it's the end of the query
            if (substr(trim($line), -1, 1) == ';') {
                // Perform the query
                $conn->query($templine) or print('Error performing query' . $templine . '\': ' . $conn->error);
                // Reset temp variable to empty
                $templine = '';
            }

        }
        
        echo "{$filename} table imported successfully <br><br>";
        echo ".";

    }

    $conn->close();

?>  
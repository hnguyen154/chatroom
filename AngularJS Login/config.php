<?php
    $servername = "localhost";
    $username = "hnguyen154";
    $password = "hnguyen154";
    $dbname= "hnguyen154";

    $conn = new mysqli($servername, $username, $password,$dbname);

    if ($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }

?>

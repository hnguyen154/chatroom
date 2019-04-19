<?php
        $servername = "localhost";
        $username = "agould5";
        $password = "agould5";
        $dbname= "agould5";

        $conn = new mysqli($servername, $username, $password,$dbname);

        if ($conn->connect_error) {
            die("Connection failed: ".$conn->connect_error);
        }

?>

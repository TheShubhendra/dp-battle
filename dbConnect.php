<?php
    $servername = $_ENV["server_address"];
    $dbname = $_ENV["database"];
    $dbusername = $_ENV["username"];
    $dbpassword = $_ENV["password"];
    $conn = new mysqli($servername,$dbusername,$dbpassword,$dbname);
    ?>
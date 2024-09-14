<?php

$con = new mysqli("localhost", "root", "", "shippingcar");
if ($con->connect_error) die("Connection failed: " . $con->connect_error);

?>
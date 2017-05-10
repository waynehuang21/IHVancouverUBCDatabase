<?php

DEFINE('DB_USER', 'ihvancouverubc');
DEFINE('DB_PASSWORD', '8f8v9v');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'IH Vancouver UBC 2017');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connect to database' . mysqli_connect_error());

?>
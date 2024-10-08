<?php

$DBConnect = mysqli_connect("localhost", "root", "", "rent_a_porter_db");

if (!$DBConnect)
    die("<p>The database server is not available.</p>");

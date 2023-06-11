<?php
    session_start();
    try{
        $conn = new mysqli("localhost","root","","bs-php-email-management");
    }
    catch(mysqli_sql_exception $e)
    {
        echo "Database cannot be connected.";
        exit;
    }
?>
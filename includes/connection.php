<?php
    session_start();
    try{
        $conn = new mysqli("localhost","root","","email-management");
    }
    catch(mysqli_sql_exception $e)
    {
        echo "Database cannot be connected.";
        exit;
    }
?>
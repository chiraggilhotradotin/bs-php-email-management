<?php
    include("includes/connection.php");
    include("includes/session.php");
    if(!isset($_GET['email_id']))
    {
        header("location:deletedemails.php");
        exit;
    }
    $conn->query("UPDATE emails SET email_isdeleted=0 WHERE email_id='{$_GET['email_id']}'");
    header("location:deletedemails.php");
?>
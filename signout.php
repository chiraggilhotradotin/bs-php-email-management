<?php
    session_start();
    unset($_SESSION['admin_id']);
    header("location:signin.php?signout=1");
?>
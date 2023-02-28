<?php
include("includes/connection.php");
include("includes/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emails</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <table class="table">
        <caption class="caption-top h2 text-center">Emails <a href="addemail.php" class="btn btn-secondary">+</a></caption>
        <tr>
            <th>S. No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php
            $emails = $conn->query("SELECT * FROM emails WHERE email_isdeleted=0");
            $count = 1;
            while($email = $emails->fetch_assoc())
            {
                echo "<tr><td>$count</td><td>{$email['email_name']}</td><td>{$email['email_email']}</td><td><a href='editemail.php?email_id={$email['email_id']}'>Edit</a> | <a href='deleteemail.php?email_id={$email['email_id']}' onclick='return confirm(\"Do you really want to delete this email?\");'>Delete</a></td></tr>";
                $count++;
            }
        ?>
    </table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
</body>
</html>
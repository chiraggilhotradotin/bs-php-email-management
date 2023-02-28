<?php
include("includes/connection.php");
include("includes/session.php");
if (isset($_POST['submit'])) {
    try {
        $conn->query("INSERT INTO emails (email_name,email_email) VALUES('{$_POST['email_name']}','{$_POST['email_email']}');");
        $success = "Email successfully saved.";
    } catch (mysqli_sql_exception $e) {
        if (preg_match("/for key 'email_email'/", $e))
            $error = "Email already exists.";
        else
            $error = "Some error occured.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Email</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex align-items-center min-vh-100">
        <div class="container-fluid">
            <div class="row">
                <form class="col-md-6 offset-md-3" method="post">
                    <div class="alert alert-secondary text-center h2">
                        <a href="emails.php" class="text-reset text-decoration-none float-start">&lt;</a>Add Email
                    </div>
                    <?php
                    if (isset($success))
                        echo "<div class='alert alert-success'>$success</div>";
                    else if (isset($error))
                        echo "<div class='alert alert-danger'>$error</div>";
                    ?>
                    <div>
                        <label for="email_name">Name</label>
                        <input type="text" name="email_name" id="email_name" required class="form-control">
                    </div>
                    <div class="mt-3">
                        <label for="email_email">Email</label>
                        <input type="email" name="email_email" id="email_email" required class="form-control">
                    </div>
                    <div class="mt-4">
                        <input type="submit" name="submit" value="Add" class="btn btn-primary w-100">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
</body>

</html>
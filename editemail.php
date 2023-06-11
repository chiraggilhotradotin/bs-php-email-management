<?php
include("includes/connection.php");
include("includes/session.php");
if (!isset($_GET['email_id'])) {
    header("location:emails.php");
    exit;
}
if (isset($_POST['submit'])) {
    try {
        $conn->query("UPDATE emails SET email_name='{$_POST['email_name']}',email_email='{$_POST['email_email']}' WHERE email_id='{$_GET['email_id']}'");
        $success = "Email successfully updated.";
    } catch (mysqli_sql_exception $e) {
        if (preg_match("/for key 'email_email'/", $e))
            $error = "Email already exists.";
        else
            $error = "Some error occured";
    }
}
$emails = $conn->query("SELECT * FROM emails WHERE email_id='{$_GET['email_id']}'");
if ($emails->num_rows == 0) {
    header("location:emails.php");
    exit;
}
$email = $emails->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Email</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
<?php
        include("includes/navbar.php");
    ?>
    <div class="d-flex align-items-center min-vh-100">
        <div class="container-fluid">
            <div class="row">
                <form class="col-md-6 offset-md-3" method="post">
                    <div class="alert alert-secondary text-center h2">
                        <a href="emails.php" class="text-reset text-decoration-none float-start">&lt;</a>Edit Email
                    </div>
                    <?php
                    if (isset($success))
                        echo "<div class='alert alert-success'>$success</div>";
                    else if (isset($error))
                        echo "<div class='alert alert-danger'>$error</div>";
                    ?>
                    <div>
                        <label for="email_name">Name</label>
                        <input type="text" name="email_name" id="email_name" required
                            value="<?php echo $email['email_name']; ?>" class="form-control">
                    </div>
                    <div class="mt-3">
                        <label for="email_email">Email</label>
                        <input type="email" name="email_email" id="email_email" required class="form-control"
                            value="<?php echo $email['email_email']; ?>">
                    </div>
                    <div class="mt-4">
                        <input type="submit" name="submit" value="Update" class="btn btn-primary w-100">
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
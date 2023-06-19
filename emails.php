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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php
    include("includes/navbar.php");
    ?>
    <table class="table mt-5">
        <caption class="caption-top h2">Emails <a href="addemail.php" class="btn btn-secondary">+</a> <a href="deletedemails.php" class="btn btn-secondary">␡</a>
            <form class="float-end mt-2 me-2">
                <div class="input-group"><input type="search" name="query" placeholder="Search query here." class="form-control" value="<?php echo $_GET['query'] ?? ''; ?>"><input type="submit" class="btn btn-primary" value="Search"></div>
            </form>
        </caption>
        <tr>
            <th>S. No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php
        $page = $_GET['page'] ?? 1;
        $perpage = 20;
        $skip = ($page - 1) * $perpage;
        $searchcolumns = "";
        if (isset($_GET['query']))
            $searchcolumns = "AND email_name LIKE '%{$_GET['query']}%'";
        $emails = $conn->query("SELECT * FROM emails WHERE email_isdeleted=0 $searchcolumns LIMIT $skip,$perpage");
        $pages = round($conn->query("SELECT * FROM emails WHERE email_isdeleted=0 $searchcolumns")->num_rows / $perpage);
        $count = $skip + 1;
        while ($email = $emails->fetch_assoc()) {
            echo "<tr><td>$count</td><td>{$email['email_name']}</td><td>{$email['email_email']}</td><td><a href='editemail.php?email_id={$email['email_id']}'>Edit</a> | <a href='deleteemail.php?email_id={$email['email_id']}' onclick='return confirm(\"Do you really want to delete this email?\");'>Delete</a></td></tr>";
            $count++;
        }
        ?>
    </table>
    <ul class="pagination justify-content-center">
        <li class="page-item"><a href="?page=<?php if ($page - 1 > 0) echo $page - 1;
                                                else echo $page; ?>" class="page-link">&lt;</a></li>
        <?php
        $start = $page - 2 > 0 ? $page - 2 : 1;
        $end = $page + 2 <= $pages ? $page + 2 : $pages;
        if ($pages > 4) {
            if ($page < 3)
                $end += (3 - $page);
            else if ($page + 2 > $pages)
                $start -= ($page - $pages + 2);
        }
        for ($i = $start; $i <= $end; $i++) {
        ?>
            <li class="page-item<?php echo $page == $i ? " active" : ""; ?>"><a href="?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
        <?php
        }
        ?>
        <li class="page-item"><a href="?page=<?php if ($page + 1 <= $pages) echo $page + 1;
                                                else echo $pages; ?>" class="page-link">&gt;</a></li>
    </ul>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>
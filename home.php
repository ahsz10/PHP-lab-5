<?php
session_start();
$msg = "Hi<span style='color:red'>" .$_COOKIE['name'];
$msg .= "</span> Welcome to Our Site .";
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Login</title>
</head>
<body>
    <?php include('operations.php'); ?>
    <!-- <p>after include <br></p> -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>Home</h4>
                    </div>
                    <div class="card-body">
                        <?php echo ($msg); ?>
                        <img src="./imgs/img1.jpg" width="100%" height="100%" alt="">
                        <form action="operations.php" method="POST">
                            <div class="mb-3">
                                <button type="submit" name="logout_user" class="btn btn-danger" style="margin-left: 45%; margin-top:5px;">Logout</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
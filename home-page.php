<?php
session_start();
include 'config.php';
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome</title>
</head>
<body>
    <?php if(!empty($_SESSION['message'])):?>
        <div class="container mt-3">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        <?php unset($_SESSION['message']); ?>

    <?php endif; ?>
    <h1>Welcome to the Home Page</h1>
    <button><a href="<?php echo $base_url; ?>/report.php">start</a></button>
    <button><a href="<?php echo $base_url; ?>/login.php">back</a></button>
    <a onclick="return confirm('คุณต้องการออกจากระบบหรือไม่?');" href="<?php echo $base_url; ?>/logout.php" class="btn btn-danger">Logout</a> 
</body>
</html>
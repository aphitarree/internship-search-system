<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$baseUrl = $_ENV['BASE_URL'];

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome</title>
</head>

<body>
    <?php if (!empty($_SESSION['message'])): ?>
        <div class="container mt-3">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        <?php unset($_SESSION['message']); ?>

    <?php endif; ?>
    <h1>Welcome to the Home Page</h1>
    <button><a href="<?php echo $baseUrl; ?>/report.php">start</a></button>
    <button><a href="<?php echo $baseUrl; ?>/login.php">back</a></button>
    <a onclick="return confirm('คุณต้องการออกจากระบบหรือไม่?');" href="<?php echo $baseUrl; ?>/actions/logout.php" class="btn btn-danger">Logout</a>
</body>

</html>
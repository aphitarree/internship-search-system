<?php
require_once __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/../index.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$baseUrl = $_ENV['BASE_URL'];

?>
<form action="<?php echo $baseUrl; ?>/actions/insert_excel.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="excel_file" required>
    <button
        class="flex h-11 rounded-md bg-slate-200 hover:bg-slate-300 px-4 text-center justify-center items-center"
        type="submit" name="submit">
        เพิ่มฐานข้อมูลจาก Excel
    </button>
</form>
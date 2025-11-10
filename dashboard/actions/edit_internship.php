<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../../config/db_config.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
    exit;
}

// รับค่าจากฟอร์ม
$id            = isset($_POST['id']) ? (int)$_POST['id'] : 0;

$organization  = trim($_POST['organization'] ?? '');
$province      = trim($_POST['province'] ?? '');
$faculty       = trim($_POST['faculty'] ?? '');  // ใช้คืนไปอัปเดต DOM
$program       = trim($_POST['program'] ?? '');
$major         = trim($_POST['major'] ?? '');
$year          = trim($_POST['year'] ?? '');
$totalStudent  = trim($_POST['total_student'] ?? '');
$score         = trim($_POST['score'] ?? '');
$contact       = trim($_POST['contact'] ?? '');

if ($id <= 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid ID'
    ]);
    exit;
}

try {
    // อัปเดตเฉพาะตาราง internship_stats
    $sql = "
        UPDATE internship_stats
        SET
            organization   = :organization,
            province       = :province,
            year           = :year,
            total_student  = :total_student,
            score          = :score,
            contact        = :contact
        WHERE id = :id
        LIMIT 1
    ";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':organization',  $organization, PDO::PARAM_STR);
    $stmt->bindParam(':province',      $province,     PDO::PARAM_STR);
    $stmt->bindParam(':year',          $year,         PDO::PARAM_STR);
    $stmt->bindParam(':total_student', $totalStudent, PDO::PARAM_INT);

    if ($score === '') {
        $score = null;
    }

    if ($score === null) {
        $stmt->bindValue(':score', null, PDO::PARAM_NULL);
    } else {
        $stmt->bindParam(':score', $score, PDO::PARAM_STR);
    }

    $stmt->bindParam(':contact',       $contact,      PDO::PARAM_STR);
    $stmt->bindParam(':id',            $id,           PDO::PARAM_INT);

    $stmt->execute();

    echo json_encode([
        'success' => true,
        'data' => [
            'id'            => $id,
            'organization'  => $organization,
            'province'      => $province,
            'faculty'       => $faculty,       // ใช้อัปเดต DOM
            'program'       => $program,
            'major'         => $major,
            'year'          => $year,
            'total_student' => $totalStudent,
            'score'         => $score,
            'contact'       => $contact,
        ]
    ]);
    exit;
} catch (PDOException $e) {
    // ในโปรดักชันควร log error แทน echo
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
    exit;
}

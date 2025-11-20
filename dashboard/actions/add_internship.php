<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/db_config.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$organization = trim($_POST['organization'] ?? '');
$province     = trim($_POST['province'] ?? '');
$faculty      = trim($_POST['faculty'] ?? '');
$program      = trim($_POST['program'] ?? '');
$major        = trim($_POST['major'] ?? '');
$yearRaw      = trim($_POST['year'] ?? '');
$affiliation  = trim($_POST['affiliation'] ?? '');
$totalStudent = $_POST['total_student'] ?? '';
$mouStatus    = trim($_POST['mou_status'] ?? '');
$score        = trim($_POST['score'] ?? '');
$contact      = trim($_POST['contact'] ?? '');

$year = (ctype_digit($yearRaw) ? (int)$yearRaw : 0);
$totalStudent = (ctype_digit((string)$totalStudent) ? (int)$totalStudent : 0);

if (
    $organization === '' ||
    $province === '' ||
    $faculty === '' ||
    $program === '' ||
    $major === '' ||
    $year <= 0 ||
    $totalStudent <= 0 ||
    $mouStatus === '' ||
    $affiliation === ''
) {
    echo json_encode([
        'success' => false,
        'message' => 'กรุณากรอกข้อมูลให้ครบถ้วน (บริษัท / จังหวัด / คณะ / หลักสูตร / สาขา / ปีการศึกษา / สังกัด / จำนวนที่รับ / MOU / คะแนน / ข้อมูลการติดต่อ)'
    ]);
    exit;
}

$scoreToSave = '-';

if ($score === '' || $score === null) {
    $scoreToSave = '-';
} elseif ($score === '-') {
    $scoreToSave = '-';
} else {
    // ถ้าไม่ใช่ "-" ต้องเป็นตัวเลข 0-5 เท่านั้น
    if (!is_numeric($score)) {
        echo json_encode([
            'success' => false,
            'message' => 'รูปแบบคะแนนไม่ถูกต้อง ต้องเป็นตัวเลข 0 - 5 หรือ "-"'
        ]);
        exit;
    }

    $scoreNum = (float)$score;

    if ($scoreNum < 0 || $scoreNum > 5) {
        echo json_encode([
            'success' => false,
            'message' => 'คะแนนต้องอยู่ระหว่าง 0 - 5 หรือใช้ "-" หากไม่ต้องการให้คะแนน'
        ]);
        exit;
    }

    // แปลงเป็นสตริงสำหรับบันทึก เช่น "4.5"
    $scoreToSave = (string)$scoreNum;
}

try {
    // หา major_id จากตาราง faculty_program_major
    $sqlMajor = "
        SELECT id
        FROM faculty_program_major
        WHERE faculty = :faculty
          AND program = :program
          AND major   = :major
        LIMIT 1
    ";
    $stmtMajor = $conn->prepare($sqlMajor);
    $stmtMajor->bindParam(':faculty', $faculty, PDO::PARAM_STR);
    $stmtMajor->bindParam(':program', $program, PDO::PARAM_STR);
    $stmtMajor->bindParam(':major',   $major,   PDO::PARAM_STR);
    $stmtMajor->execute();
    $majorRow = $stmtMajor->fetch(PDO::FETCH_ASSOC);

    if (!$majorRow) {
        echo json_encode([
            'success' => false,
            'message' => 'ไม่พบข้อมูลคณะ/หลักสูตร/สาขาที่เลือกในระบบ'
        ]);
        exit;
    }

    $majorId = (int)$majorRow['id'];

    $sql = "
        INSERT INTO internship_stats
            (organization, province, major_id, year, affiliation, total_student, mou_status, contact, score)
        VALUES
            (:organization, :province, :major_id, :year, :affiliation, :total_student, :mou_status, :contact, :score)
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':organization',  $organization,  PDO::PARAM_STR);
    $stmt->bindParam(':province',      $province,      PDO::PARAM_STR);
    $stmt->bindParam(':major_id',      $majorId,       PDO::PARAM_INT);
    $stmt->bindParam(':year',          $year,          PDO::PARAM_INT);
    $stmt->bindParam(':affiliation',   $affiliation,   PDO::PARAM_STR);
    $stmt->bindParam(':total_student', $totalStudent,  PDO::PARAM_INT);
    $stmt->bindParam(':mou_status',    $mouStatus,     PDO::PARAM_STR);
    $stmt->bindParam(':contact',       $contact,       PDO::PARAM_STR);
    $stmt->bindParam(':score',         $scoreToSave,   PDO::PARAM_STR);

    $stmt->execute();

    echo json_encode([
        'success' => true,
        'message' => 'เพิ่มข้อมูลฝึกงานสำเร็จ'
    ]);
    exit;
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
    exit;
}

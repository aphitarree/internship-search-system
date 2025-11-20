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

// Input form data
$id               = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$organization     = trim($_POST['organization'] ?? '');
$province         = trim($_POST['province'] ?? '');
$faculty          = trim($_POST['faculty'] ?? '');
$program          = trim($_POST['program'] ?? '');
$major            = trim($_POST['major'] ?? '');
$yearInput        = trim($_POST['year'] ?? '');
$totalStudentInput = trim($_POST['total_student'] ?? '');
$mouStatus        = trim($_POST['mou_status'] ?? '');
$score            = trim($_POST['score'] ?? '');
$contact          = trim($_POST['contact'] ?? '');
$affiliation      = trim($_POST['affiliation'] ?? '');

if ($id <= 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid ID'
    ]);
    exit;
}

try {
    $stmtCurrentData = $conn->prepare("
        SELECT year, total_student, mou_status, affiliation
        FROM internship_stats
        WHERE id = :id
        LIMIT 1
    ");
    $stmtCurrentData->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtCurrentData->execute();
    $currentData = $stmtCurrentData->fetch(PDO::FETCH_ASSOC);

    if (!$currentData) {
        echo json_encode([
            'success' => false,
            'message' => 'ไม่พบข้อมูลที่ต้องการแก้ไข'
        ]);
        exit;
    }

    if ($yearInput !== '' && ctype_digit($yearInput)) {
        $year = (int)$yearInput;
    } else {
        $year = (int)$currentData['year'];
    }

    if ($totalStudentInput !== '' && ctype_digit($totalStudentInput)) {
        $totalStudent = (int)$totalStudentInput;
    } else {
        $totalStudent = (int)$currentData['total_student'];
    }

    if ($mouStatus === '') {
        $mouStatusToSave = $currentData['mou_status'];
    } else {
        $mouStatusToSave = $mouStatus;
    }

    if ($affiliation === '') {
        $affiliationToSave = $currentData['affiliation'] ?? '';
    } else {
        $affiliationToSave = $affiliation;
    }

    if ($faculty === '' || $program === '' || $major === '') {
        echo json_encode([
            'success' => false,
            'message' => 'กรุณาเลือกคณะ / หลักสูตร / สาขาให้ครบ'
        ]);
        exit;
    }

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

    $scoreToSave = '-';

    if ($score === '' || $score === null) {
        $scoreToSave = '-';
    } elseif ($score === '-') {
        $scoreToSave = '-';
    } else {
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

        $scoreToSave = (string)$scoreNum;
    }

    $sql = "
        UPDATE internship_stats
        SET
            major_id       = :major_id,
            organization   = :organization,
            province       = :province,
            year           = :year,
            total_student  = :total_student,
            mou_status     = :mou_status,
            score          = :score,
            contact        = :contact,
            affiliation    = :affiliation
        WHERE id = :id
        LIMIT 1
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':major_id',      $majorId,          PDO::PARAM_INT);
    $stmt->bindParam(':organization',  $organization,     PDO::PARAM_STR);
    $stmt->bindParam(':province',      $province,         PDO::PARAM_STR);
    $stmt->bindParam(':year',          $year,             PDO::PARAM_INT);
    $stmt->bindParam(':total_student', $totalStudent,     PDO::PARAM_INT);
    $stmt->bindParam(':mou_status',    $mouStatusToSave,  PDO::PARAM_STR);
    $stmt->bindParam(':score',         $scoreToSave,      PDO::PARAM_STR);
    $stmt->bindParam(':contact',       $contact,          PDO::PARAM_STR);
    $stmt->bindParam(':affiliation',   $affiliationToSave, PDO::PARAM_STR);
    $stmt->bindParam(':id',            $id,               PDO::PARAM_INT);
    $stmt->execute();

    echo json_encode([
        'success' => true,
        'data' => [
            'id'            => $id,
            'organization'  => $organization,
            'province'      => $province,
            'faculty'       => $faculty,
            'program'       => $program,
            'major'         => $major,
            'year'          => $year,
            'total_student' => $totalStudent,
            'mou_status'    => $mouStatusToSave,
            'score'         => $scoreToSave,
            'contact'       => $contact,
            'affiliation'   => $affiliationToSave,
        ]
    ]);
    exit;
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
    exit;
}

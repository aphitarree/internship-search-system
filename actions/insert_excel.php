<?php
require_once __DIR__ . '/../config/db_config.php';
require_once __DIR__ . '/../vendor/autoload.php';
session_start();

use PhpOffice\PhpSpreadsheet\IOFactory;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$baseUrl = $_ENV['BASE_URL'];
if (isset($_POST['submit'])) {

    $FileTmpPath = $_FILES['excel_file']['tmp_name'];
    $FileName = $_FILES['excel_file']['name'];
    $FileExtension = pathinfo($FileName, PATHINFO_EXTENSION);

    $allowed_extension = ['csv', 'xls', 'xlsx'];

    if (in_array($FileExtension, $allowed_extension)) {
        $spreadsheet = IOFactory::load($FileTmpPath);
        $data = $spreadsheet->getActiveSheet()->toArray();
        print_r($data); // Debug: แสดงข้อมูลที่อ่านได้จากไฟล์ Excel

        $count = 0;
        foreach ($data as $row) {
            if ($count > 0) {
                // 📘 ปรับให้สอดคล้องกับไฟล์ Excel ของคุณ
                // ตัวอย่าง: [คณะ, หลักสูตร, สาขา, หน่วยงาน, จังหวัด, ตำแหน่ง, ปี, จำนวนฝึกงาน]
                $organization = trim($row[0]);
                $province = trim($row[1]);
                $position = trim($row[2]);
                $faculty = trim($row[3]);
                $program = trim($row[4]);
                $major = trim($row[5]);
                $year = trim($row[6]);
                $total_student = trim($row[7]);

                // 🔍 ค้นหา major_id จากตาราง faculty_program_major
                $sql_major = "SELECT id FROM faculty_program_major WHERE faculty = :faculty AND program = :program AND major = :major LIMIT 1";
                $stmt_major = $conn->prepare($sql_major);
                $stmt_major->bindParam(':faculty', $faculty);
                $stmt_major->bindParam(':program', $program);
                $stmt_major->bindParam(':major', $major);
                $stmt_major->execute();
                $major_row = $stmt_major->fetch(PDO::FETCH_ASSOC);

                if ($major_row) {
                    $major_id = $major_row['id'];
                } else {
                    // ❗❗❗❗ ถ้ายังไม่มีข้อมูล ให้เพิ่มเข้า faculty_program_major ก่อน ❗❗❗
                    $insert_major = "INSERT INTO faculty_program_major (faculty, program, major) VALUES (:faculty, :program, :major)";
                    $stmt_insert_major = $conn->prepare($insert_major);
                    $stmt_insert_major->bindParam(':faculty', $faculty);
                    $stmt_insert_major->bindParam(':program', $program);
                    $stmt_insert_major->bindParam(':major', $major);
                    $stmt_insert_major->execute();
                    $major_id = $conn->lastInsertId();
                }

                // 💾 บันทึกเข้า internship_stats โดยใช้ major_id ที่ได้
                $sql = 'INSERT INTO internship_stats (organization, position, province, major_id, year, total_student) 
                            VALUES (:organization, :position, :province, :major_id, :year, :total_student)';
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':organization', $organization);
                $stmt->bindParam(':position', $position);
                $stmt->bindParam(':province', $province);
                $stmt->bindParam(':major_id', $major_id);
                $stmt->bindParam(':year', $year);
                $stmt->bindParam(':total_student', $total_student);

                $stmt->execute();
                $msg = true;
            } else {
                $count = 1; // ✅✅✅✅✅✅✅✅✅✅✅ใช้เลข 1 ไม่ต้องใส่เป็น string✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅
            }
        }

        if (isset($msg)) {
            $_SESSION['massge'] = "✅ Successfully Imported";
        } else {
            $_SESSION['massge'] = "⚠️ Not Imported";
        }
        header("Location: {$baseUrl}/index.php");
        exit(0);
    } else {
        $_SESSION['massge'] = "❌ Invalid File";
        header("Location: {$baseUrl}/index.php");
        exit(0);
    }
}

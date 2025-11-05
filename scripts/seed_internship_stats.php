<?php
require_once __DIR__ . '/../config/db_config.php';

echo "Seeding internship_stats...\n";

$provinces = [
    "กรุงเทพมหานคร",
    "เชียงใหม่",
    "ชลบุรี",
    "ขอนแก่น",
    "ภูเก็ต",
    "สงขลา",
    "นครราชสีมา",
    "ระยอง",
    "นครปฐม",
    "นนทบุรี"
];

$contacts = [
    "0123456789",
    "john.doe@hotmail.com",
    "No contact",
    "1123456789"
];

$majors = $conn->query("SELECT id FROM faculty_program_major")->fetchAll(PDO::FETCH_COLUMN);

if (!$majors || count($majors) == 0) {
    die("Error: faculty_program_major ไม่มีข้อมูล!\n");
}

$stmt = $conn->prepare("
    INSERT INTO internship_stats 
    (organization, province,major_id, year, total_student, contact, score)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");

for ($i = 1; $i <= 100; $i++) {

    $organization = "บริษัท ทดสอบ $i จำกัด";
    $province = $provinces[array_rand($provinces)];
    $major_id = $majors[array_rand($majors)];
    $year = rand(2563, 2568);
    $total_student = rand(1, 20);
    $contact = $contacts[array_rand($contacts)];
    $score = rand(1, 5);

    $stmt->execute([
        $organization,
        $province,
        $major_id,
        $year,
        $total_student,
        $contact,
        $score
    ]);
}

echo "✅ Data inserted successfully: 100 records\n";

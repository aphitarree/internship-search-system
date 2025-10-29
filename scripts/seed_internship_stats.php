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

$positions = [
    "นักศึกษาฝึกงานตำแหน่งบัญชี",
    "Web Developer Intern",
    "IT Support Intern",
    "นักศึกษาฝึกงานด้านการตลาด",
    "Graphic Design Intern",
    "Business Analyst Intern",
    "HR Intern",
    "Content Creator Intern",
    "Data Analyst Intern",
    "Sales Coordinator Intern"
];

$majors = $conn->query("SELECT id FROM faculty_program_major")->fetchAll(PDO::FETCH_COLUMN);

if (!$majors || count($majors) == 0) {
    die("Error: faculty_program_major ไม่มีข้อมูล!\n");
}

$stmt = $conn->prepare("
    INSERT INTO internship_stats 
    (organization, province, position, major_id, year, total_student)
    VALUES (?, ?, ?, ?, ?, ?)
");

for ($i = 1; $i <= 100; $i++) {

    $organization = "บริษัท ทดสอบ $i จำกัด";
    $province = $provinces[array_rand($provinces)];
    $position = $positions[array_rand($positions)];
    $major_id = $majors[array_rand($majors)];
    $year = rand(2563, 2568);
    $total_student = rand(1, 20);

    $stmt->execute([
        $organization,
        $province,
        $position,
        $major_id,
        $year,
        $total_student
    ]);
}

echo "✅ Data inserted successfully: 100 records\n";

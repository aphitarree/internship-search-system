<?php
require_once __DIR__ . '/vendor/autoload.php';
$conn = require __DIR__ . '/config/db_config.php'; // PDO connection

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'UTF-8',
    'format' => 'A4',
    'margin_left' => 15,
    'margin_right' => 15,
    'margin_bottom' => 16,
    'margin_header' => 9,
    'margin_footer' => 9,
]);

// ✅ Use PDO properly
$sql = "SELECT * FROM internship_stats";
$stmt = $conn->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

ob_start();
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body,
        table,
        th,
        td,
        h2 {
            font-family: "garuda", sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h2>รายงานสถานประกอบการฝึกงาน</h2>
    <table>
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>คณะ</th>
                <th>ชื่อบริษัท</th>
                <th>จังหวัด</th>
                <th>ตำแหน่ง</th>
                <th>ปึการศึกษา</th>
                <th>จำนวนนักศึกษา</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['major_id']) ?></td>
                    <td><?= htmlspecialchars($row['organization']) ?></td>
                    <td><?= htmlspecialchars($row['province']) ?></td>
                    <td><?= htmlspecialchars($row['position']) ?></td>
                    <td><?= htmlspecialchars($row['year']) ?></td>
                    <td><?= htmlspecialchars($row['total_student']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>

<?php
$html = ob_get_clean();
$mpdf->WriteHTML($html);
$mpdf->Output('internship_report.pdf', 'I');

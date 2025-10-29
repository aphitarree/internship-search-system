<?php
require_once __DIR__ . "/vendor/autoload.php";
require_once "config.php";

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4',
    'margin_left' => 15,
    'margin_right' => 15,
    'margin_top' => 16,
    'margin_bottom' => 9,
    'margin_header' => 9,
    'margin_footer' => 9
]);



















































// use Dompdf\Dompdf;
// use Dompdf\Options;

// $options = new Options();
// $options->setChroot(__DIR__);
// $options->setIsRemoteEnabled(true);

// $dompdf = new Dompdf($options);

// // ดึงข้อมูลจากฐานข้อมูล
// $sql = "SELECT * FROM internship_stats";
// $result = mysqli_query($conn, $sql);

// // เพิ่ม meta charset และ DOCTYPE
// $html = '<!DOCTYPE html>
// <html>
// <head>
// <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
// <style>
// body, table, th, td, h2 {
//     font-family: "thsarabunnew", sans-serif;
// }

// table {
//     border-collapse: collapse;
//     width: 100%;
// }

// th, td {
//     border: 1px solid #000;
//     padding: 8px;
//     text-align: center;
// }

// th {
//     background-color: #f2f2f2;
//     font-weight: bold;
// }

// h2 {
//     text-align: center;
//     margin-bottom: 20px;
// }
// </style>
// </head>
// <body>

// <h2>รายงานสถานประกอบการฝึกงาน</h2>
// <table>
//     <thead>
//         <tr>
//             <th>id</th>
//             <th>คณะ</th>
//             <th>หลักสูตร</th>
//             <th>สาขา</th>
//             <th>บริษัท</th>
//             <th>จังหวัด</th>
//             <th>ตำแหน่ง</th>
//             <th>ปี</th>
//             <th>จำนวนนักศึกษา</th>
//         </tr>
//     </thead>
//     <tbody>';

// while ($row = mysqli_fetch_assoc($result)) {
//     $html .= '
//     <tr>
//         <td>' . htmlspecialchars($row['id']) . '</td>

//         <td>' . htmlspecialchars($row['major_id']) . '</td>
//         <td>' . htmlspecialchars($row['organization']) . '</td>
//         <td>' . htmlspecialchars($row['province']) . '</td>
//         <td>' . htmlspecialchars($row['position']) . '</td>
//         <td>' . htmlspecialchars($row['year']) . '</td>
//         <td>' . htmlspecialchars($row['total_student']) . '</td>
//     </tr>';
// }

// $html .= '</tbody>
// </table>
// </body>
// </html>';



// $dompdf->loadHtml($html);
// $dompdf->setPaper('A4', 'landscape');
// $dompdf->render();
// $dompdf->stream("internship_report.pdf", ["Attachment" => false]);

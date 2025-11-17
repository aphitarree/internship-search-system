<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/db_config.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$request = $_POST ?: $_GET;

// DataTables params
$draw   = isset($request['draw']) ? (int)$request['draw'] : 0;
$start  = isset($request['start']) ? (int)$request['start'] : 0;
$length = isset($request['length']) ? (int)$request['length'] : 10;
$searchValue = $request['search']['value'] ?? '';

$columnsMap = [
    0 => 'id',
    1 => 'is_useful',
    2 => 'comment',
    3 => 'created_at',
];

$orderColumnIndex = isset($request['order'][0]['column']) ? (int)$request['order'][0]['column'] : 0;
$orderDir = (isset($request['order'][0]['dir']) && strtolower($request['order'][0]['dir']) === 'desc') ? 'DESC' : 'ASC';
$orderColumn = $columnsMap[$orderColumnIndex] ?? 'id';

// base
$baseFrom = "FROM feedback";

// total
try {
    $sqlTotal = "SELECT COUNT(*) $baseFrom";
    $recordsTotal = (int)$conn->query($sqlTotal)->fetchColumn();
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}

// where
$where = '';
$params = [];
if ($searchValue !== '') {
    // ให้ค้นจากทั้ง is_useful และ comment
    $where = " WHERE is_useful LIKE :search OR comment LIKE :search ";
    $params[':search'] = '%' . $searchValue . '%';
}

// filtered count
$sqlFiltered = "SELECT COUNT(*) $baseFrom $where";
$stmtFiltered = $conn->prepare($sqlFiltered);
foreach ($params as $k => $v) {
    $stmtFiltered->bindValue($k, $v, PDO::PARAM_STR);
}
$stmtFiltered->execute();
$recordsFiltered = (int)$stmtFiltered->fetchColumn();

// data
$sqlData = "SELECT id, is_useful, comment, created_at $baseFrom $where ORDER BY $orderColumn $orderDir LIMIT :start, :length";
$stmt = $conn->prepare($sqlData);
foreach ($params as $k => $v) {
    $stmt->bindValue($k, $v, PDO::PARAM_STR);
}
$stmt->bindValue(':start', $start, PDO::PARAM_INT);
$stmt->bindValue(':length', $length, PDO::PARAM_INT);
$stmt->execute();

$data = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[] = [
        'id'         => (int)$row['id'],
        'is_useful'  => $row['is_useful'],
        'comment'    => $row['comment'],
        'created_at' => $row['created_at'],
    ];
}

echo json_encode([
    'draw'            => $draw,
    'recordsTotal'    => $recordsTotal,
    'recordsFiltered' => $recordsFiltered,
    'data'            => $data,
], JSON_UNESCAPED_UNICODE);
exit;

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$rows = [
	[
		'id' => 1,
		'organization' => 'บริษัท เอ บี ซี จำกัด',
		'province' => 'กรุงเทพมหานคร',
		'position' => 'นักศึกษาฝึกงานตำแหน่งบัญชี',
		'faculty' => 'คณะนิเทศศาสตร์',
		'program' => 'นิเทศศาสตรบัณฑิต',
		'major' => 'วารสารสนเทศ',
		'year' => 2568,
		'total_student' => 5,
	],
	[
		'id' => 2,
		'organization' => 'บริษัท สมาร์ทเทค จำกัด',
		'province' => 'นนทบุรี',
		'position' => 'Web Developer Intern',
		'faculty' => 'คณะวิทยาการคอมพิวเตอร์',
		'program' => 'วิทยาศาสตรบัณฑิต',
		'major' => 'เทคโนโลยีสารสนเทศ',
		'year' => 2568,
		'total_student' => 3,
	],
	[
		'id' => 3,
		'organization' => 'บริษัท เบสท์ ดีไซน์ จำกัด',
		'province' => 'ปทุมธานี',
		'position' => 'กราฟิกดีไซน์เนอร์',
		'faculty' => 'คณะศิลปกรรมศาสตร์',
		'program' => 'ศิลปบัณฑิต',
		'major' => 'ออกแบบนิเทศศิลป์',
		'year' => 2567,
		'total_student' => 2,
	],
];

// $summary = [
//   'company_count' => count($rows),
//   'student_count' => array_sum(array_column($rows, 'total_student')),
//   'position_count' => count($rows)
// ];
?>

<!doctype html>
<html lang="th">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<link rel="icon" type="image/png" href="public/images/favicon-32x32.png">

	<title>คลังประวัติการฝึกงาน</title>

	<!-- Tailwind CDN -->
	<script src="https://cdn.tailwindcss.com"></script>

	<!-- Choices.js for creating searchable dropdown element -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
</head>

<link rel="stylesheet" href="css/globals.css">
</head>

<body class="bg-white text-gray-900">
	<!-- Navigator bar -->
	<?php include_once './components/navbar.php'; ?>

	<!-- Banner -->
	<section class="relative w-full">
		<img src="public/images/background-1.jpg" alt="Banner" class="w-full h-[185px] object-cover" />
		<div class="absolute inset-0 bg-black/25"></div>
		<h1 class="absolute inset-0 flex items-center justify-center text-white text-2xl md:text-3xl font-semibold text-center">
			คลังประวัติการฝึกงานของมหาวิทยาลัยสวนดุสิต
		</h1>
	</section>

	<div class="md:container md:mx-auto">
		<main class="mx-auto w-full max-w-[1900px] px-4 py-2 mt-4 grid grid-cols-1 gap-6 lg:grid-cols-[2fr,1fr] lg:gap-8">
			<?php include_once './components/chart.php' ?>
			<?php include_once './components/access_stats.php' ?>
		</main>

		<!-- Filters -->
		<?php include_once './components/filter_search.php' ?>

		<!-- Search result table -->
		<?php include_once './components/result_table.php' ?>

		<!-- Pagination -->
		<?php include_once './components/pagination.php' ?>

		<!-- Download report -->
		<?php include_once './components/report.php' ?>
	</div>

	<!-- Footer bar -->
	<?php include_once './components/footer.php'; ?>
</body>

</html>
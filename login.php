<?php
require_once __DIR__ . '/vendor/autoload.php';


use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$baseUrl = $_ENV['BASE_URL'];

session_start();

// ############################  auto login  ###########################################
// if (empty($_SESSION['id']) && !empty($_COOKIE['remember_token'])) {

//     $token = mysqli_real_escape_string($conn, $_COOKIE['remember_token']);
//     // $query = mysqli_query($conn, "SELECT * FROM user WHERE remember_token='{$token}'");
//     $stmt = $conn->prepare("SELECT * FROM user WHERE remember_token= ?");
//     $stmt->bind_param("s", $token);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     if (mysqli_num_rows($result) === 1) {
//         $user = mysqli_fetch_assoc($result);

//         $_SESSION['id'] = $user['id'];
//         $_SESSION['email'] = $user['email'];
//         $_SESSION['username'] = $user['username'];
//         $_SESSION['role'] = $user['role'];

//         if ($user['role'] === 'admin') {
//             header("Location: {$baseUrl}/admin-page.php");
//         } else {
//             header("Location: {$baseUrl}/index.php");
//         }
//         exit;
//     }
// }
// 
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>เข้าสู่ระบบ | ฐานข้อมูลการฝึกงาน</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@400;600;700&display=swap');

        body {
            font-family: 'Sarabun', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-warning alert-dismissible fade show my-4" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>
    <!-- Navigation Bar -->
    <?php include __DIR__ . '/components/navbar.php'; ?>

    <div class="fixed inset-0 z-0">
        <img src="public/images/login_page.jpg" alt="SDU Campus" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-white/70 backdrop-blur-sm"></div>
    </div>
    <!-- Main Content -->
    <div class="relative z-10 pt-24 pb-12 px-4">
        <div class="max-w-md mx-auto">
            <!-- Login Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="inline-block p-3 bg-blue-50 rounded-full mb-4">
                        <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">เข้าสู่ระบบ</h1>
                    <p class="text-gray-500">ฐานข้อมูลการฝึกงานนักศึกษา</p>
                </div>

                <!-- Login Form -->

                <form class="space-y-5" action="<?php echo $baseUrl . '/actions/login_form.php'; ?>" method="POST">
                    <!-- Email Input -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">อีเมล</label>
                        <div class="relative">
                            <input
                                type="email"
                                name="email"
                                placeholder="example@dusit.ac.th"
                                required
                                class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">รหัสผ่าน</label>
                        <div class="relative">
                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="••••••••"
                                required
                                class="w-full pl-11 pr-12 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <!-- <button type="button" onclick="togglePassword()" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600">
                                <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button> -->
                        </div>
                    </div>

                    <!-- Remember & Forgot -->


                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-3 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        เข้าสู่ระบบ
                    </button>

                    <!-- Divider -->
                    <!-- <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">หรือ</span>
                        </div>
                    </div> -->

                    <!-- Register Link -->
                    <!-- <div class="text-center">
                        <p class="text-gray-600">ยังไม่มีบัญชี? <a href="#" class="text-blue-500 hover:text-blue-600 font-semibold transition">ลงทะเบียน</a></p>
                    </div> -->
                </form>
            </div>

            <!-- Additional Info -->
            <div class="mt-6 text-center text-sm text-gray-500">
                <p>สำหรับนักศึกษาและบุคลากร มหาวิทยาลัยสวนดุสิต</p>
                <p class="mt-2">ต้องการความช่วยเหลือ? <a href="#" class="text-blue-500 hover:text-blue-600">ติดต่อเรา</a></p>
            </div>
        </div>
    </div>


</body>

</html>
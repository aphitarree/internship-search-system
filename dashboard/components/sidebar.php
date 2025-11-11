<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/db_config.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

$baseDashboardUrl = $_ENV['BASE_URL'] . '/dashboard' ?? '';

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$requestUri = $_SERVER['REQUEST_URI'];

$fullUrl = $protocol . $host . $requestUri;
?>

<aside id="sidebar" class="w-64 bg-sky-500 text-white flex flex-col min-h-screen shadow-lg transition-all duration-300">

    <!-- Sidebar - Brand -->
    <a href="index.php"
        class="flex items-center px-4 py-4 border-b border-sky-400/70 gap-3">
        <div class="flex items-center justify-center">
            <img src="../public/images/SDU Logo.png"
                alt="SDU Logo"
                class="h-10 w-auto">
        </div>
        <div class="sidebar-text text-base font-semibold tracking-wide whitespace-nowrap">
            Internship
        </div>
    </a>

    <nav class="flex-1 overflow-y-auto py-3 space-y-3">
        <!-- Interface Heading -->
        <div class="sidebar-heading px-4 text-xs font-semibold tracking-wide uppercase text-sky-100/80">
            เมนู
        </div>

        <!-- Dashboard -->
        <div class="px-2">
            <a href="index.php"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium
                <?php echo $fullUrl === $baseDashboardUrl . '/index.php'
                    ? 'bg-sky-600/90 shadow-sm'
                    : 'hover:bg-sky-400/70'; ?>">
                <i class="fas fa-fw fa-tachometer-alt text-sm"></i>
                <span class="sidebar-text">แดชบอร์ด</span>
            </a>
        </div>

        <!-- Charts -->
        <div class="px-2">
            <a href="user.php"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium
                <?php echo $fullUrl === $baseDashboardUrl . '/user.php'
                    ? 'bg-sky-600/90 shadow-sm'
                    : 'hover:bg-sky-400/70'; ?>">
                <i class="fas fa-fw fa-chart-area text-sm"></i>
                <span class="sidebar-text">ตารางข้อมูลผู้ใช้</span>
            </a>
        </div>

        <div class="px-2">
            <a href="page_insert_excel.php"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium
                <?php echo $fullUrl === $baseDashboardUrl . '/page_insert_excel.php'
                    ? 'bg-sky-600/90 shadow-sm'
                    : 'hover:bg-sky-400/70'; ?>">
                <i class="fas fa-fw fa-chart-area text-sm"></i>
                <span class="sidebar-text">เพิ่มข้อมูล Excel</span>
            </a>
        </div>

        <!-- Divider -->
        <div class="sidebar-divider border-t border-sky-400/60 mx-3"></div>


        <!-- Interface Heading -->
        <!-- <div class="sidebar-heading px-4 text-xs font-semibold tracking-wide uppercase text-sky-100/80">
            Interface
        </div> -->

        <!-- Components Collapse -->
        <!-- <div class="px-2">

            <button
                type="button"
                class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium hover:bg-sky-400/70 transition"
                data-collapse-target="sidebar-components">
                <i class="fas fa-fw fa-cog text-sm"></i>
                <span class="sidebar-text">Components</span>
                <span class="sidebar-text ml-auto">
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" data-chevron></i>
                </span>
            </button>

            <div id="sidebar-components" class="sidebar-collapse mt-1 space-y-1 pl-9 hidden">
                <div class="text-[11px] uppercase tracking-wide text-sky-100/80 mt-1 mb-0.5">
                    Custom Components
                </div>
                <a href="buttons.html"
                    class="block px-3 py-1.5 text-sm rounded-md text-sky-50/90 hover:bg-sky-500/70">
                    Buttons
                </a>
                <a href="cards.html"
                    class="block px-3 py-1.5 text-sm rounded-md text-sky-50/90 hover:bg-sky-500/70">
                    Cards
                </a>
            </div>
        </div> -->

        <!-- Utilities Collapse -->
        <!-- <div class="px-2">
            <button
                type="button"
                class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium hover:bg-sky-400/70 transition"
                data-collapse-target="sidebar-utilities">
                <i class="fas fa-fw fa-wrench text-sm"></i>
                <span class="sidebar-text">Utilities</span>
                <span class="sidebar-text ml-auto">
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" data-chevron></i>
                </span>
            </button>

            <div id="sidebar-utilities" class="sidebar-collapse mt-1 space-y-1 pl-9 hidden">
                <div class="text-[11px] uppercase tracking-wide text-sky-100/80 mt-1 mb-0.5">
                    Custom Utilities
                </div>
                <a href="utilities-color.html"
                    class="block px-3 py-1.5 text-sm rounded-md text-sky-50/90 hover:bg-sky-500/70">
                    Colors
                </a>
                <a href="utilities-border.html"
                    class="block px-3 py-1.5 text-sm rounded-md text-sky-50/90 hover:bg-sky-500/70">
                    Borders
                </a>
                <a href="utilities-animation.html"
                    class="block px-3 py-1.5 text-sm rounded-md text-sky-50/90 hover:bg-sky-500/70">
                    Animations
                </a>
                <a href="utilities-other.html"
                    class="block px-3 py-1.5 text-sm rounded-md text-sky-50/90 hover:bg-sky-500/70">
                    Other
                </a>
            </div>
        </div> -->

        <!-- Divider -->
        <!-- <div class="sidebar-divider border-t border-sky-400/60 mx-3"></div> -->

        <!-- Addons Heading -->
        <!-- <div class="sidebar-heading px-4 text-xs font-semibold tracking-wide uppercase text-sky-100/80">
            Addons
        </div> -->

        <!-- Pages Collapse -->
        <!-- <div class="px-2">
            <button
                type="button"
                class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium hover:bg-sky-400/70 transition"
                data-collapse-target="sidebar-pages">
                <i class="fas fa-fw fa-folder text-sm"></i>
                <span class="sidebar-text">Pages</span>
                <span class="sidebar-text ml-auto">
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" data-chevron></i>
                </span>
            </button>

            <div id="sidebar-pages" class="sidebar-collapse mt-1 space-y-1 pl-9 hidden">
                <div class="text-[11px] uppercase tracking-wide text-sky-100/80 mt-1 mb-0.5">
                    Login Screens
                </div>
                <a href="login.html"
                    class="block px-3 py-1.5 text-sm rounded-md text-sky-50/90 hover:bg-sky-500/70">
                    Login
                </a>
                <a href="register.html"
                    class="block px-3 py-1.5 text-sm rounded-md text-sky-50/90 hover:bg-sky-500/70">
                    Register
                </a>
                <a href="forgot-password.html"
                    class="block px-3 py-1.5 text-sm rounded-md text-sky-50/90 hover:bg-sky-500/70">
                    Forgot Password
                </a>

                <div class="border-t border-sky-400/60 my-1.5 mr-3"></div>

                <div class="text-[11px] uppercase tracking-wide text-sky-100/80 mt-1 mb-0.5">
                    Other Pages
                </div>
                <a href="404.html"
                    class="block px-3 py-1.5 text-sm rounded-md text-sky-50/90 hover:bg-sky-500/70">
                    404 Page
                </a>
                <a href="blank.html"
                    class="block px-3 py-1.5 text-sm rounded-md text-sky-50/90 hover:bg-sky-500/70">
                    Blank Page
                </a>
            </div>
        </div> -->
    </nav>

    <!-- Sidebar Toggle -->
    <div class="border-t border-sky-400/60 px-3 py-3">
        <button
            id="sidebarToggle"
            type="button"
            class="w-8 h-8 flex items-center justify-center rounded-full bg-sky-400/80 hover:bg-sky-400/60 border border-sky-300/60 transition mx-auto">
            <i class="fas fa-angle-double-left text-xs" id="toggleIcon"></i>
        </button>
    </div>
</aside>

<script>
    // จัดการ collapse menu (Components / Utilities / Pages)
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[data-collapse-target]').forEach(function(button) {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-collapse-target');
                const target = document.getElementById(targetId);
                if (!target) return;

                target.classList.toggle('hidden');

                const chevron = this.querySelector('[data-chevron]');
                if (chevron) {
                    chevron.classList.toggle('rotate-180');
                }
            });
        });

        // Sidebar Toggle - ย่อ/ขยาย
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const toggleIcon = document.getElementById('toggleIcon');

        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', () => {
                // Toggle ความกว้าง
                sidebar.classList.toggle('w-64');
                sidebar.classList.toggle('w-15');

                // Toggle การแสดงผล text ทั้งหมด
                const texts = sidebar.querySelectorAll('.sidebar-text');
                const headings = sidebar.querySelectorAll('.sidebar-heading');
                const dividers = sidebar.querySelectorAll('.sidebar-divider');
                const collapses = sidebar.querySelectorAll('.sidebar-collapse');

                texts.forEach(text => {
                    text.classList.toggle('hidden');
                });

                headings.forEach(heading => {
                    heading.classList.toggle('hidden');
                });

                dividers.forEach(divider => {
                    divider.classList.toggle('hidden');
                });

                // ซ่อน collapse menu ทั้งหมดเมื่อย่อ sidebar
                collapses.forEach(collapse => {
                    if (sidebar.classList.contains('w-20')) {
                        collapse.classList.add('hidden');
                    }
                });

                // เปลี่ยนทิศทางลูกศร
                if (sidebar.classList.contains('w-20')) {
                    toggleIcon.classList.remove('fa-angle-double-left');
                    toggleIcon.classList.add('fa-angle-double-right');
                } else {
                    toggleIcon.classList.remove('fa-angle-double-right');
                    toggleIcon.classList.add('fa-angle-double-left');
                }
            });
        }
    });
</script>
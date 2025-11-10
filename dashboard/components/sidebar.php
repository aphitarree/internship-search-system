<?php
// ใช้เช็คหน้า active สำหรับไฮไลต์เมนู
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<aside class="w-64 bg-sky-500 text-white flex flex-col min-h-screen shadow-lg">

    <!-- Sidebar - Brand -->
    <a href="index.php"
        class="flex items-center px-4 py-4 border-b border-sky-400/70 gap-3">
        <div class="flex items-center justify-center">
            <img src="../public/images/SDU Logo.png"
                alt="SDU Logo"
                class="h-10 w-auto">
        </div>
        <div class="text-base font-semibold tracking-wide">
            Internship
        </div>
    </a>

    <nav class="flex-1 overflow-y-auto py-3 space-y-3">

        <!-- Dashboard -->
        <div class="px-3">
            <a href="index.php"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium
                <?php echo $currentPage === 'index.php'
                    ? 'bg-sky-600/90 shadow-sm'
                    : 'hover:bg-sky-400/70'; ?>">
                <i class="fas fa-fw fa-tachometer-alt text-sm"></i>
                <span>Dashboard</span>
            </a>
        </div>

        <!-- Divider -->
        <div class="border-t border-sky-400/60 mx-3"></div>

        <!-- Interface Heading -->
        <div class="px-4 text-xs font-semibold tracking-wide uppercase text-sky-100/80">
            Interface
        </div>

        <!-- Components Collapse -->
        <div class="px-2">
            <button
                type="button"
                class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium hover:bg-sky-400/70 transition"
                data-collapse-target="sidebar-components">
                <i class="fas fa-fw fa-cog text-sm"></i>
                <span>Components</span>
                <span class="ml-auto">
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" data-chevron></i>
                </span>
            </button>

            <div id="sidebar-components" class="mt-1 space-y-1 pl-9 hidden">
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
        </div>

        <!-- Utilities Collapse -->
        <div class="px-2">
            <button
                type="button"
                class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium hover:bg-sky-400/70 transition"
                data-collapse-target="sidebar-utilities">
                <i class="fas fa-fw fa-wrench text-sm"></i>
                <span>Utilities</span>
                <span class="ml-auto">
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" data-chevron></i>
                </span>
            </button>

            <div id="sidebar-utilities" class="mt-1 space-y-1 pl-9 hidden">
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
        </div>

        <!-- Divider -->
        <div class="border-t border-sky-400/60 mx-3"></div>

        <!-- Addons Heading -->
        <div class="px-4 text-xs font-semibold tracking-wide uppercase text-sky-100/80">
            Addons
        </div>

        <!-- Pages Collapse -->
        <div class="px-2">
            <button
                type="button"
                class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium hover:bg-sky-400/70 transition"
                data-collapse-target="sidebar-pages">
                <i class="fas fa-fw fa-folder text-sm"></i>
                <span>Pages</span>
                <span class="ml-auto">
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" data-chevron></i>
                </span>
            </button>

            <div id="sidebar-pages" class="mt-1 space-y-1 pl-9 hidden">
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
        </div>

        <!-- Charts -->
        <div class="px-3">
            <a href="charts.html"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium
               <?php echo $currentPage === 'charts.html'
                    ? 'bg-sky-600/90 shadow-sm'
                    : 'hover:bg-sky-400/70'; ?>">
                <i class="fas fa-fw fa-chart-area text-sm"></i>
                <span>Charts</span>
            </a>
        </div>

        <!-- Tables -->
        <div class="px-3">
            <a href="tables.html"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium
               <?php echo $currentPage === 'tables.html'
                    ? 'bg-sky-600/90 shadow-sm'
                    : 'hover:bg-sky-400/70'; ?>">
                <i class="fas fa-fw fa-table text-sm"></i>
                <span>Tables</span>
            </a>
        </div>

    </nav>

    <!-- Sidebar Toggle (ถ้าอยากใช้ทีหลังค่อยผูก JS เพิ่ม) -->
    <div class="border-t border-sky-400/60 px-3 py-3">
        <button
            id="sidebarToggle"
            type="button"
            class="w-8 h-8 flex items-center justify-center rounded-full bg-sky-400/80 hover:bg-sky-400/60 border border-sky-300/60 transition">
            <i class="fas fa-angle-double-left text-xs"></i>
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

        // ถ้าอยากให้ sidebarToggle ทำงานจริง ๆ:
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = sidebarToggle ? sidebarToggle.closest('aside') : null;

        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', () => {
                // toggle แบบง่าย ๆ: ย่อกว้างลง
                sidebar.classList.toggle('w-64');
                sidebar.classList.toggle('w-20');
            });
        }
    });
</script>
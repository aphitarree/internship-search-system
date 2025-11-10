<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<header class="w-full bg-white border-b relative z-10">
    <nav class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="http://localhost/internship-search-system/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="public/images/SDU Logo.png" alt="SDU" class="h-11 w-auto" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">สำนักส่งเสริมวิชาการและงานทะเบียน</span>
            </a>
            <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="http://localhost/internship-search-system/" class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Home</a>
                    </li>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbarabout" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">เกี่ยวกับสำนัก
                            </svg>
                        </button>
                        <!-- Dropdown about -->
                        <div id="dropdownNavbarabout" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="https://regis.dusit.ac.th/main/?page_id=30" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">ปรัชญา วิสัยทัศน์ พันธกิจ</a>
                                </li>
                                <li>
                                    <a href="https://regis.dusit.ac.th/main/?page_id=42" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">บุคลากร</a>
                                </li>
                                <li>
                                    <a href="https://regis.dusit.ac.th/main/?page_id=2630#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">เบอร์โทรศัพท์ หน่วยงาน</a>
                                </li>
                                <li>
                                    <a href="https://regis.dusit.ac.th/main/?page_id=6282" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">สายตรงผู้อำนวยการ</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbarfaculty" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">คณะ/โรงเรียน
                            </svg>
                        </button>
                        <!-- Dropdown faculty -->
                        <div id="dropdownNavbarfaculty" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="https://education.dusit.ac.th/" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">คณะครุศาสตร์</a>
                                </li>
                                <li>
                                    <a href="https://scitech.dusit.ac.th/" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">คณะวิทยาศาสตร์และเทคโนโลยี</a>
                                </li>
                                <li>
                                    <a href="https://m-sci.dusit.ac.th/home/" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">คณะวิทยาการจัดการ</a>
                                </li>
                                <li>
                                    <a href="http://human.dusit.ac.th/main/" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">คณะมนุษย์ศาสตร์และสังคมศาสตร์</a>
                                </li>
                                <li>
                                    <a href="http://nurse.dusit.ac.th/" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">คณะพยาบาลศาสตร์</a>
                                </li>
                                <li>
                                    <a href="http://food.dusit.ac.th/main/" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">โรงเรียนการเรือน</a>
                                </li>
                                <li>
                                    <a href="http://thmdusit.dusit.ac.th/" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">โรงเรียนการท่องเที่ยวและการบริการ</a>
                                </li>
                                <li>
                                    <a href="http://slp.dusit.ac.th/" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">โรงเรียนกฎหมายและการเมือง</a>
                                </li>
                                <li>
                                    <a href="http://www.graduate.dusit.ac.th/" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">บัณฑิตวิทยาลัย</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbarstaff" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">อาจารย์/บุคลากร
                            </svg>
                        </button>
                        <!-- Dropdown staff -->
                        <div id="dropdownNavbarstaff" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="https://regis.dusit.ac.th/main/?page_id=1737" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">สาระน่ารู้</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">ประเมิน</a>
                                </li>
                                <li>
                                    <a href="https://regis.dusit.ac.th/main/?page_id=389" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">แบบฟอร์มสำหรับ อาจารย์/เจ้าหน้าทื่</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbarstudent" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">นักศึกษา
                            </svg>
                        </button>
                        <!-- Dropdown student -->
                        <div id="dropdownNavbarstudent" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="https://regis.dusit.ac.th/main/?p=10234" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">บริการ</a>
                                </li>
                                <li>
                                    <a href="https://regis.dusit.ac.th/main/?page_id=1646" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">สาระน่ารู้</a>
                                </li>
                                <li>
                                    <a href="https://regis.dusit.ac.th/main/?page_id=15464" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">โครงสร้างหลักสูตร</a>
                                </li>
                                <li>
                                    <a href="https://regis.dusit.ac.th/main/?page_id=442" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">แบบฟอร์มสำหรับนักศึกษา</a>
                                </li>
                                <li>
                                    <a href="https://regis.dusit.ac.th/main/?page_id=2494" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">รายชื่อผู้สำเร็จการศึกษา</a>
                                </li>
                                <li>
                                    <a href="https://regis.dusit.ac.th/main/?page_id=2553" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">รายชื่อผู้พ้นสภาพนักศึกษา</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbarnews" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">ข้อมูลเผยแพร่
                            </svg>
                        </button>
                        <!-- Dropdown news -->
                        <div id="dropdownNavbarnews" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="https://docs.google.com/forms/d/e/1FAIpQLSfn7zBBg5J1ASqPXmO9SKojlY2e5lhUr4kHnJ8AldpPZRE4MQ/viewform" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">แบบประเมินความพึงพอใจการรับบริการ</a>
                                </li>
                                <li>
                                    <a href="https://regis.dusit.ac.th/main/?page_id=56" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">เกี่ยวกับงานประกันคุณภาพ</a>
                                </li>
                                <li>
                                    <a href="https://regis.dusit.ac.th/main/?page_id=15143" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">การเปิดเผยข้อมูลสาธารณะ (OIT)</a>
                                </li>
                                <li>
                                    <a href="https://regis.dusit.ac.th/main/?page_id=7805" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">ข้อมูลจำนวนนักศึกษา</a>
                                </li>
                                <li>
                                    <a href="https://regis.dusit.ac.th/main/?page_id=9267" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">สรุปองค์ความรู้กิจกรรมสนับสนุนด้านวิชาการ</a>
                                </li>
                                <li>
                                    <a href="https://regis.dusit.ac.th/main/?page_id=17326" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">การจัดการความปลอดภัย อาชีวอนามัยและสภาพแวดล้อมในการทำงาน</a>
                                </li>
                                <li>
                                    <a href="https://regis.dusit.ac.th/main/?page_id=4918" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">แนวปฏิบัติการคุ้มครองข้อมูลส่วนบุคคล (PDPA)</a>
                                </li>
                            </ul>
                        </div>
                    </li>
            </div>
        </div>
    </nav>
    </div>
</header>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/db_config.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

$baseUrl = $_ENV['BASE_URL'] ?? '';

// ดึงข้อมูลฝึกงานทั้งหมด (เอา id มาด้วยสำหรับใช้ตอนแก้ไข)
$stmt = $conn->prepare("
    SELECT
        internship_stats.id,
        faculty_program_major.faculty,
        faculty_program_major.program,
        faculty_program_major.major,
        internship_stats.organization,
        internship_stats.province,
        internship_stats.contact,
        internship_stats.score,
        internship_stats.year,
        internship_stats.total_student
    FROM internship_stats
    INNER JOIN faculty_program_major
        ON internship_stats.major_id = faculty_program_major.id
    LIMIT 10;
");
$stmt->execute();
$internRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section>
    <!-- ตารางข้อมูลฝึกงาน -->
    <!-- Page Heading -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">
            ข้อมูลสถานที่ฝึกงาน
        </h1>
        <button
            type="button"
            class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg shadow-sm bg-indigo-600 hover:bg-indigo-700 text-white transition">
            <i class="fas fa-download mr-2 text-sm"></i>
            Generate Report
        </button>
    </div>

    <div class="bg-white shadow rounded-xl mb-6">
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
            <div class="flex items-center gap-2 text-gray-700">
                <i class="fas fa-table"></i>
                <span class="font-medium">ข้อมูลการฝึกงาน</span>
            </div>

            <!-- ปุ่มเปิด Add Modal -->
            <button
                id="openAddInternshipModal"
                type="button"
                class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white transition">
                + เพิ่มข้อมูลฝึกงาน
            </button>
        </div>

        <div class="p-4">
            <div class="overflow-x-auto no-scrollbar">
                <table class="min-w-full text-sm text-left text-gray-700">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-3 py-2 font-semibold">NO.</th>
                            <th class="px-3 py-2 font-semibold">บริษัท</th>
                            <th class="px-3 py-2 font-semibold">จังหวัด</th>
                            <th class="px-3 py-2 font-semibold">คณะ</th>
                            <th class="px-3 py-2 font-semibold">หลักสูตร</th>
                            <th class="px-3 py-2 font-semibold">สาขา</th>
                            <th class="px-3 py-2 font-semibold">ปีการศึกษา</th>
                            <th class="px-3 py-2 font-semibold">จำนวนที่รับ</th>
                            <th class="px-3 py-2 font-semibold">ข้อมูลการติดต่อ</th>
                            <th class="px-3 py-2 font-semibold">คะแนน</th>
                            <th class="px-3 py-2 font-semibold text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($internRecords as $index => $internRecord): ?>
                            <tr class="hover:bg-gray-50" data-row-id="<?= (int)$internRecord['id']; ?>">
                                <td class="px-3 py-2 align-center"><?= $index + 1; ?></td>
                                <td class="px-3 py-2 align-center cell-organization"><?= htmlspecialchars($internRecord['organization']); ?></td>
                                <td class="px-3 py-2 align-center cell-province"><?= htmlspecialchars($internRecord['province']); ?></td>
                                <td class="px-3 py-2 align-center cell-faculty"><?= htmlspecialchars($internRecord['faculty']); ?></td>
                                <td class="px-3 py-2 align-center cell-program"><?= htmlspecialchars($internRecord['program']); ?></td>
                                <td class="px-3 py-2 align-center cell-major"><?= htmlspecialchars($internRecord['major']); ?></td>
                                <td class="px-3 py-2 align-center cell-year"><?= htmlspecialchars($internRecord['year']); ?></td>
                                <td class="px-3 py-2 align-center cell-total-student"><?= htmlspecialchars($internRecord['total_student']); ?></td>
                                <td class="px-3 py-2 align-center cell-contact">
                                    <?= htmlspecialchars($internRecord['contact']); ?>
                                </td>
                                <td class="px-3 py-2 align-center cell-score"><?= htmlspecialchars($internRecord['score']); ?></td>
                                <td class="px-3 py-2 align-center text-center">
                                    <!-- ปุ่ม Edit: ใส่ data-* ตาม field จริง -->
                                    <button
                                        type="button"
                                        class="whitespace-nowrap btn-edit inline-flex items-center px-3 py-2 text-xs font-bold rounded-md bg-blue-600 hover:bg-blue-700 text-white transition"
                                        data-id="<?= (int)$internRecord['id']; ?>"
                                        data-organization="<?= htmlspecialchars($internRecord['organization']); ?>"
                                        data-province="<?= htmlspecialchars($internRecord['province']); ?>"
                                        data-faculty="<?= htmlspecialchars($internRecord['faculty']); ?>"
                                        data-program="<?= htmlspecialchars($internRecord['program']); ?>"
                                        data-major="<?= htmlspecialchars($internRecord['major']); ?>"
                                        data-year="<?= htmlspecialchars($internRecord['year']); ?>"
                                        data-total_student="<?= (int)$internRecord['total_student']; ?>"
                                        data-contact="<?= htmlspecialchars($internRecord['contact']); ?>"
                                        data-score="<?= htmlspecialchars($internRecord['score']); ?>">
                                        แก้ไข
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php if (empty($internRecords)): ?>
                            <tr>
                                <td colspan="11" class="px-3 py-6 text-center text-gray-500">
                                    ยังไม่มีข้อมูลฝึกงาน
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Add Internship Modal -->
<div
    id="addInternshipModal"
    class="fixed inset-0 z-50 hidden bg-black/50 items-center justify-center px-2">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-3xl">
        <form method="post" action="./actions/add_internship.php" class="flex flex-col max-h-[90vh] bg-white shadow-md rounded px-8 pt-6 pb-8">
            <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                <h5 class="text-lg font-semibold">เพิ่มข้อมูลฝึกงาน</h5>
                <button
                    type="button"
                    data-close-modal="add"
                    class="text-gray-400 hover:text-gray-600 transition">
                    <span class="text-xl leading-none">&times;</span>
                </button>
            </div>

            <div class="pt-4 space-y-4 overflow-y-auto">
                <!-- ใส่ field ตามที่มีในตาราง -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">บริษัท</label>
                        <input
                            type="text"
                            name="organization"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">จังหวัด</label>
                        <input
                            type="text"
                            name="province"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">คณะ</label>
                        <input
                            type="text"
                            name="faculty"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">หลักสูตร</label>
                        <input
                            type="text"
                            name="program"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">สาขา</label>
                        <input
                            type="text"
                            name="major"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">ปีการศึกษา</label>
                        <input
                            type="number"
                            name="year"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">จำนวนที่รับ</label>
                        <input
                            type="number"
                            name="total_student"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">คะแนน</label>
                        <input
                            type="text"
                            name="score"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">ข้อมูลการติดต่อ</label>
                    <textarea
                        name="contact"
                        rows="3"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4 mt-4 border-t border-gray-200">
                <button
                    type="button"
                    data-close-modal="add"
                    class="px-4 py-2 text-sm font-bold rounded border border-gray-300 text-gray-700 hover:bg-gray-50">
                    ยกเลิก
                </button>
                <button
                    type="submit"
                    class="px-4 py-2 text-sm font-bold rounded bg-blue-500 hover:bg-blue-700 text-white focus:outline-none focus:shadow-outline">
                    บันทึก
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Internship Modal -->
<div
    id="editInternshipModal"
    class="fixed inset-0 z-50 hidden bg-black/50 items-center justify-center px-2">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-3xl">
        <form
            method="post" action="./actions/edit_internship.php"
            class="flex flex-col max-h-[90vh] bg-white shadow-md rounded px-8 pt-6 pb-8"
            id="editForm">
            <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                <h5 class="text-lg font-semibold">แก้ไขข้อมูลฝึกงาน</h5>
                <button
                    type="button"
                    data-close-modal="edit"
                    class="text-gray-400 hover:text-gray-600 transition">
                    <span class="text-xl leading-none">&times;</span>
                </button>
            </div>

            <div class="pt-4 space-y-4 overflow-y-auto">
                <input type="hidden" name="id" id="edit-id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">บริษัท</label>
                        <input
                            type="text"
                            name="organization"
                            id="edit-organization"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">จังหวัด</label>
                        <input
                            type="text"
                            name="province"
                            id="edit-province"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">คณะ</label>
                        <input
                            type="text"
                            name="faculty"
                            id="edit-faculty"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">หลักสูตร</label>
                        <input
                            type="text"
                            name="program"
                            id="edit-program"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">สาขา</label>
                        <input
                            type="text"
                            name="major"
                            id="edit-major"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">ปีการศึกษา</label>
                        <input
                            type="number"
                            name="year"
                            id="edit-year"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">จำนวนที่รับ</label>
                        <input
                            type="number"
                            name="total_student"
                            id="edit-total_student"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">คะแนน</label>
                        <input
                            type="text"
                            name="score"
                            id="edit-score"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">ข้อมูลการติดต่อ</label>
                    <textarea
                        name="contact"
                        id="edit-contact"
                        rows="3"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4 mt-4 border-t border-gray-200">
                <button
                    type="button"
                    data-close-modal="edit"
                    class="px-4 py-2 text-sm font-bold rounded border border-gray-300 text-gray-700 hover:bg-gray-50">
                    ยกเลิก
                </button>
                <button
                    type="submit"
                    name="update"
                    class="px-4 py-2 text-sm font-bold rounded bg-blue-500 hover:bg-blue-700 text-white focus:outline-none focus:shadow-outline">
                    อัปเดต
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addModal = document.getElementById('addInternshipModal');
        const editModal = document.getElementById('editInternshipModal');
        const openAddBtn = document.getElementById('openAddInternshipModal');
        const editForm = document.getElementById('editForm');

        // เปิด Add Modal
        if (openAddBtn && addModal) {
            openAddBtn.addEventListener('click', () => {
                addModal.classList.remove('hidden');
                addModal.classList.add('flex');
            });
        }

        // ปิด Add Modal
        document.querySelectorAll('[data-close-modal="add"]').forEach(btn => {
            btn.addEventListener('click', () => {
                if (!addModal) return;
                addModal.classList.add('hidden');
                addModal.classList.remove('flex');
            });
        });

        // ปิด Edit Modal
        document.querySelectorAll('[data-close-modal="edit"]').forEach(btn => {
            btn.addEventListener('click', () => {
                if (!editModal) return;
                editModal.classList.add('hidden');
                editModal.classList.remove('flex');
            });
        });

        // ปุ่ม Edit ทั้งหมด → เติมค่า + เปิด edit modal
        const editButtons = document.querySelectorAll('.btn-edit');
        editButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                if (!editModal) return;

                const id = btn.getAttribute('data-id') || '';
                const organization = btn.getAttribute('data-organization') || '';
                const province = btn.getAttribute('data-province') || '';
                const faculty = btn.getAttribute('data-faculty') || '';
                const program = btn.getAttribute('data-program') || '';
                const major = btn.getAttribute('data-major') || '';
                const year = btn.getAttribute('data-year') || '';
                const totalStudent = btn.getAttribute('data-total_student') || '';
                const contact = btn.getAttribute('data-contact') || '';
                const score = btn.getAttribute('data-score') || '';

                document.getElementById('edit-id').value = id;
                document.getElementById('edit-organization').value = organization;
                document.getElementById('edit-province').value = province;
                document.getElementById('edit-faculty').value = faculty;
                document.getElementById('edit-program').value = program;
                document.getElementById('edit-major').value = major;
                document.getElementById('edit-year').value = year;
                document.getElementById('edit-total_student').value = totalStudent;
                document.getElementById('edit-contact').value = contact;
                document.getElementById('edit-score').value = score;

                editModal.classList.remove('hidden');
                editModal.classList.add('flex');
            });
        });

        // ส่งฟอร์ม edit แบบ AJAX (ไม่ refresh หน้า)
        if (editForm) {
            editForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const formData = new FormData(editForm);

                try {
                    const res = await fetch(editForm.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const raw = await res.text();
                    let result;

                    try {
                        result = JSON.parse(raw);
                    } catch (parseErr) {
                        console.warn('Response ไม่ใช่ JSON ล้วน จะใช้ค่าจากฟอร์มแทน', raw);
                        // ถ้า parse ไม่ได้ แต่ request สำเร็จ ให้ถือว่า success
                        result = {
                            success: true,
                            data: null
                        };
                    }

                    if (result.success === false) {
                        alert(result.message || 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล');
                        return;
                    }

                    // ดึงข้อมูลจาก result.data ถ้ามี ไม่งั้น fallback ใช้ค่าจากฟอร์ม
                    const d = result.data || {
                        id: document.getElementById('edit-id').value,
                        organization: document.getElementById('edit-organization').value,
                        province: document.getElementById('edit-province').value,
                        faculty: document.getElementById('edit-faculty').value,
                        program: document.getElementById('edit-program').value,
                        major: document.getElementById('edit-major').value,
                        year: document.getElementById('edit-year').value,
                        total_student: document.getElementById('edit-total_student').value,
                        contact: document.getElementById('edit-contact').value,
                        score: document.getElementById('edit-score').value,
                    };

                    const row = document.querySelector(`tr[data-row-id="${d.id}"]`);

                    if (row) {
                        const orgCell = row.querySelector('.cell-organization');
                        const provCell = row.querySelector('.cell-province');
                        const facCell = row.querySelector('.cell-faculty');
                        const progCell = row.querySelector('.cell-program');
                        const majorCell = row.querySelector('.cell-major');
                        const yearCell = row.querySelector('.cell-year');
                        const totalCell = row.querySelector('.cell-total-student');
                        const contactCell = row.querySelector('.cell-contact');
                        const scoreCell = row.querySelector('.cell-score');

                        if (orgCell) orgCell.textContent = d.organization;
                        if (provCell) provCell.textContent = d.province;
                        if (facCell) facCell.textContent = d.faculty;
                        if (progCell) progCell.textContent = d.program;
                        if (majorCell) majorCell.textContent = d.major;
                        if (yearCell) yearCell.textContent = d.year;
                        if (totalCell) totalCell.textContent = d.total_student;
                        if (contactCell) contactCell.textContent = d.contact;
                        if (scoreCell) scoreCell.textContent = d.score ?? '';

                        // อัปเดต data-* บนปุ่ม edit ให้เป็นค่าล่าสุด
                        const editBtn = row.querySelector('.btn-edit');
                        if (editBtn) {
                            editBtn.setAttribute('data-organization', d.organization);
                            editBtn.setAttribute('data-province', d.province);
                            editBtn.setAttribute('data-faculty', d.faculty);
                            editBtn.setAttribute('data-program', d.program);
                            editBtn.setAttribute('data-major', d.major);
                            editBtn.setAttribute('data-year', d.year);
                            editBtn.setAttribute('data-total_student', d.total_student);
                            editBtn.setAttribute('data-contact', d.contact);
                            editBtn.setAttribute('data-score', d.score ?? '');
                        }
                    }

                    // ปิด modal
                    if (editModal) {
                        editModal.classList.add('hidden');
                        editModal.classList.remove('flex');
                    }
                } catch (err) {
                    console.error(err);
                    alert('ไม่สามารถเชื่อมต่อเซิร์ฟเวอร์ได้');
                }
            });
        }

        // ปิด modal เมื่อคลิกพื้นหลัง (overlay)
        [addModal, editModal].forEach(modal => {
            if (!modal) return;
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            });
        });
    });
</script>
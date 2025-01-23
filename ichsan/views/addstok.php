<?php
// public/api/add-stok.php
global $pdo;
include_once 'config/database.php';

header('Content-Type: application/json');

// Cek apakah permintaan adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    // Validasi
    if (!isset($input['nama']) || !isset($input['jumlah']) || !isset($input['status'])) {
        echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
        exit;
    }

    // Simpan data ke database
    try {
        $stmt = $pdo->prepare("INSERT INTO stok (nama_barang, jumlah, status) VALUES (:nama, :jumlah, :status)");
        $stmt->execute([
            ':nama' => $input['nama'],
            ':jumlah' => $input['jumlah'],
            ':status' => $input['status']
        ]);

        echo json_encode(['success' => true, 'message' => 'Stok berhasil ditambahkan']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Metode tidak diizinkan']);
}
?>
<?php
// public/add-stok.php
include '../views/includes/navbar.php'; // Include navbar
?>

<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Tambah Stok Baru</h1>
    <form id="addStokForm" class="bg-white p-6 rounded shadow">
        <div class="mb-4">
            <label for="nama" class="block text-gray-700">Nama Barang:</label>
            <input type="text" id="nama" name="nama" class="w-full border rounded py-2 px-3" required>
        </div>
        <div class="mb-4">
            <label for="jumlah" class="block text-gray-700">Jumlah:</label>
            <input type="number" id="jumlah" name="jumlah" class="w-full border rounded py-2 px-3" required>
        </div>
        <div class="mb-4">
            <label for="status" class="block text-gray-700">Status:</label>
            <select id="status" name="status" class="w-full border rounded py-2 px-3" required>
                <option value="Original">Original</option>
                <option value="OEM">OEM</option>
                <option value="Variasi">Variasi</option>
            </select>
        </div>
        <button type="button" onclick="submitForm()" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</button>
    </form>
</div>

<script>
    async function submitForm() {
        const nama = document.getElementById('nama').value;
        const jumlah = document.getElementById('jumlah').value;
        const status = document.getElementById('status').value;

        try {
            const response = await fetch('/api/add-stok.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ nama, jumlah, status })
            });

            const result = await response.json();
            alert(result.message);

            if (result.success) {
                window.location.href = '/'; // Kembali ke dashboard
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menambahkan stok');
        }
    }
</script>

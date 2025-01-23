<nav class="bg-gray-800 p-4 shadow-lg">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Bagian Judul -->
        <div class="text-white font-bold text-xl flex items-center">
            MANAGEMENT DATA GUDANG
            <span class="ml-2 text-blue-300">ICHSAN MOTOR</span>
        </div>
        <!-- Bagian Info Pengguna -->
        <div class="text-white">
            <button onclick="addStok()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                ADD STOK
            </button>
            <button onclick="printPage()" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                PRINT
            </button>
            <button onclick="exitApp()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                EXIT
            </button>
        </div>
    </div>
</nav>

<script>
    function addStok() {
        window.location.href = '/../role_input.php'; // Arahkan ke halaman input stok
    }

    function printPage() {
        window.print(); // Cetak halaman
    }

    function exitApp() {
        window.location.href = '/dashboard'; // Arahkan ke dashboard
    }
</script>

<?php
require_once 'koneksi.php';

// 1. Ambil ID Pesanan dari URL
$nomor_pesanan = $_GET['id'] ?? null;


if (!$nomor_pesanan) {
    die("<div style='padding: 20px; color: red;'>Error: Nomor Pesanan tidak ditemukan!</div>");
}

$message = ''; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jenis_produk_baru = $_POST['jenis_produk'] ?? '';
    $jml_pesanan_baru = $_POST['jml_pesanan'] ?? '';
    $jml_pesanan_baru = (int)$jml_pesanan_baru;
    $sql_update = "UPDATE KartuPesanan SET JenisProduk = :jenis, JmlPesanan = :jml WHERE NomorPesanan = :id";

    try {
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute([
            ':jenis' => $jenis_produk_baru,
            ':jml'   => $jml_pesanan_baru,
            ':id'    => $nomor_pesanan
        ]);

        if ($stmt_update->rowCount()) {
            $message = "<div class='alert alert-success'>Data Pesanan **" . htmlspecialchars($nomor_pesanan) . "** berhasil diubah!</div>";
        } else {
            $message = "<div class='alert alert-info'>Tidak ada perubahan data, atau data tidak ditemukan.</div>";
        }

    } catch (\PDOException $e) {
        $message = "<div class='alert alert-danger'>Gagal mengupdate data: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
}

// 2. Ambil data pesanan saat ini untuk mengisi form (harus dilakukan setelah logika UPDATE)
$sql_select = "SELECT NomorPesanan, JenisProduk, JmlPesanan FROM KartuPesanan WHERE NomorPesanan = :id";
try {
    $stmt_select = $pdo->prepare($sql_select);
    $stmt_select->execute([':id' => $nomor_pesanan]);
    $pesanan = $stmt_select->fetch(PDO::FETCH_ASSOC);

    if (!$pesanan) {
        die("<div style='padding: 20px; color: red;'>Data pesanan dengan ID: **" . htmlspecialchars($nomor_pesanan) . "** tidak ditemukan di database.</div>");
    }

} catch (\PDOException $e) {
    die("<div style='padding: 20px; color: red;'>Error saat mengambil data: " . htmlspecialchars($e->getMessage()) . "</div>");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan <?php echo htmlspecialchars($pesanan['NomorPesanan']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h1 class="mb-4 text-primary">Edit Data Pesanan</h1>
        <p class="lead">Mengubah data pesanan untuk **Nomor Pesanan: <?php echo htmlspecialchars($pesanan['NomorPesanan']); ?>**</p>
        
        <?php echo $message;?>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="edit.php?id=<?php echo htmlspecialchars($pesanan['NomorPesanan']); ?>" method="POST">
                    
                    <div class="mb-3">
                        <label for="nomor_pesanan" class="form-label">Nomor Pesanan</label>
                        <input type="text" class="form-control" id="nomor_pesanan" value="<?php echo htmlspecialchars($pesanan['NomorPesanan']); ?>" disabled>
                        <small class="form-text text-muted">Nomor Pesanan tidak dapat diubah.</small>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_produk" class="form-label">Jenis Produk</label>
                        <input type="text" class="form-control" id="jenis_produk" name="jenis_produk" 
                               value="<?php echo htmlspecialchars($pesanan['JenisProduk']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="jml_pesanan" class="form-label">Jumlah Pesanan</label>
                        <input type="number" class="form-control" id="jml_pesanan" name="jml_pesanan" 
                               value="<?php echo htmlspecialchars($pesanan['JmlPesanan']); ?>" required min="1">
                    </div>

                    <button type="submit" class="btn btn-success me-2">Simpan Perubahan</button>
                    <a href="tampilan.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
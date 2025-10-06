<?php
require_once 'koneksi.php';

function displaySimpleTable($pdo, $tableName, $title) {
    echo '<div class="card mb-4 shadow-sm border-info">';
    echo '<div class="card-header bg-info text-white"><h5>Data Tabel: ' . htmlspecialchars($title) . '</h5></div>';
    echo '<div class="card-body">';

    try {
        $query = "SELECT * FROM " . $tableName ;
        $stmt = $pdo->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            $columns = array_keys($results[0]);

            echo '<div class="table-responsive">';
            echo '<table class="table table-striped table-bordered table-sm">';
            echo '<thead class="table-dark"><tr>';
            foreach ($columns as $col) {
                echo '<th>' . htmlspecialchars(str_replace('_', ' ', strtoupper($col))) . '</th>';
            }
            echo '</tr></thead>';
            echo '<tbody>';
            foreach ($results as $row) {
                echo '<tr>';
                foreach ($row as $data) {
                    echo '<td>' . htmlspecialchars($data) . '</td>';
                }
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo '<p class="alert alert-warning">Tabel ' . htmlspecialchars($tableName) . ' kosong atau tidak ditemukan.</p>';
        }

    } catch (\PDOException $e) {
        echo '<p class="alert alert-danger"><strong>Error Akses Tabel:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
    }

    echo '</div>';
    echo '</div>'; 
}

$queries = [
    'Q1: Total Biaya per Pesanan & Kelompok' => "SELECT A.NomorPesanan, JenisProduk, JmlPesanan, Kelompok, sum(Jumlah) as JumlahBiaya FROM KartuPesanan A INNER JOIN RincianBiaya B ON A.NomorPesanan = B.NomorPesanan GROUP by A.NomorPesanan, JenisProduk, JmlPesanan, Kelompok ORDER by A.NomorPesanan, JenisProduk, JmlPesanan, Kelompok",
    'Q2: Total Biaya per Bulan dan Kelompok' => "SELECT Year(B.Tanggal) as Tahun, Month(B.Tanggal) as Bulan ,Kelompok, sum(Jumlah) as JumlahBiaya FROM KartuPesanan A INNER JOIN RincianBiaya B ON A.NomorPesanan = B.NomorPesanan GROUP by Year(B.Tanggal) , Month(B.Tanggal) ,Kelompok ORDER by Tahun, Bulan, Kelompok",
    'Q3: Total Biaya per Jenis Produk & Kelompok' => "SELECT JenisProduk,Kelompok, sum(Jumlah) as JumlahBiaya FROM KartuPesanan A INNER JOIN RincianBiaya B ON A.NomorPesanan = B.NomorPesanan GROUP by JenisProduk,Kelompok ORDER by JenisProduk, Kelompok",
    'Q4: Analisis Biaya Produksi per Unit' => "SELECT A.NomorPesanan, JenisProduk, JmlPesanan , SUM(Jumlah) as BiayaLangsung, SUM(Jumlah) * 30/100 as BiayaOverHead, SUM(Jumlah) * 130/100 as TotalBiaya , (SUM(Jumlah) * 130/100) /JmlPesanan as BiayaPerUnit FROM KartuPesanan A INNER JOIN RincianBiaya B ON A.NomorPesanan = B.NomorPesanan GROUP by A.NomorPesanan, JenisProduk, JmlPesanan ORDER by A.NomorPesanan, JenisProduk, JmlPesanan",
    'Q5: Statistik Biaya per Sub Kelompok' => "SELECT SubKelompok, Sum(Jumlah) as JumlahBiaya, Count(Jumlah) as JmlPesanan, Avg(Jumlah) as Rata_Rata, Max(Jumlah) as MaxBiaya, Min(Jumlah) as MinBiaya FROM KartuPesanan A INNER JOIN RincianBiaya B ON A.NomorPesanan = B.NomorPesanan GROUP by SubKelompok ORDER by SubKelompok",
    'Q6: Biaya Pesanan Khusus "Sepatu"' => "SELECT A.NomorPesanan, JenisProduk, JmlPesanan, Kelompok, SUM(Jumlah) AS JumlahBiaya FROM KartuPesanan A INNER JOIN RincianBiaya B ON A.NomorPesanan = B.NomorPesanan WHERE JenisProduk = 'Sepatu' GROUP BY A.NomorPesanan, JenisProduk, JmlPesanan, Kelompok ORDER BY A.NomorPesanan, JenisProduk, JmlPesanan, Kelompok",
    'Q7: Pesanan dengan Total Biaya > 20 Juta (HAVING)' => "SELECT A.NomorPesanan, JenisProduk, JmlPesanan, Kelompok, sum(Jumlah) as JumlahBiaya FROM KartuPesanan A INNER JOIN RincianBiaya B ON A.NomorPesanan = B.NomorPesanan GROUP by A.NomorPesanan, JenisProduk, JmlPesanan, Kelompok HAVING sum(Jumlah) > 20000000 ORDER by A.NomorPesanan, JenisProduk, JmlPesanan, Kelompok",
    'Q8: 3 Pesanan Biaya Tertinggi (LIMIT)' => "SELECT Kelompok AS Kelompok_Biaya, A.JenisProduk, A.NomorPesanan, SUM(Jumlah) AS JumlahBiaya FROM KartuPesanan A INNER JOIN RincianBiaya B ON A.NomorPesanan = B.NomorPesanan GROUP BY A.NomorPesanan, A.JenisProduk, Kelompok ORDER BY SUM(Jumlah) DESC LIMIT 3"
];

function executeQuery($pdo, $query) {
    try {
        $stmt = $pdo->query($query);
        $results = $stmt->fetchAll();
        return [
            'success' => true,
            'data' => $results,
            'columns' => $results ? array_keys($results[0]) : []
        ];
    } catch (\PDOException $e) {
        return [
            'success' => false,
            'error' => $e->getMessage()
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8 Query Analisis Biaya (PHP PDO & Bootstrap)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> 
        body { background-color: #f8f9fa; } 
        .action-col-full { width: 220px; text-align: center; }
        .action-col-detail { width: 100px; text-align: center; } 
        .btn-group { gap: 5px; } 
    </style>
</head>
<body>

    <div class="container mt-5 mb-5">
        <header class="text-center mb-5">
            <h1 class="text-primary">Dasbor Analisis Biaya Produksi</h1>
            <p class="lead">Aplikasi Berbasis Web Interaktif dengan PHP PDO dan Bootstrap.</p>
        </header>
        
        <hr class="mb-5">
        <h2>1. Struktur Data Transaksi</h2>
        <?php 
        displaySimpleTable($pdo, 'KartuPesanan', 'Kartu Pesanan');
        displaySimpleTable($pdo, 'RincianBiaya', 'Rincian Biaya');
        ?>
        <hr class="mt-5 mb-5">
        
        <h2>2. Hasil Query Analisis (Q1 s/d Q8)</h2>

        <?php 
        foreach ($queries as $title => $query): 
            $result = executeQuery($pdo, $query); 
            $has_nomor_pesanan = in_array('NomorPesanan', $result['columns']) || in_array('A.NomorPesanan', $result['columns']);
        ?>

        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5><?php echo htmlspecialchars($title); ?></h5>
            </div>
            <div class="card-body">
                <?php if ($result['success']): ?>

                    <?php if ($result['data']): ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <?php foreach ($result['columns'] as $col): ?>
                                            <th><?php echo htmlspecialchars(str_replace('_', ' ', strtoupper($col))); ?></th>
                                        <?php endforeach; ?>
                                        <th class="<?php echo $has_nomor_pesanan ? 'action-col-full' : 'action-col-detail'; ?>">ACTION</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result['data'] as $row): ?>
                                        <tr>
                                            <?php foreach ($row as $data): ?>
                                                <td>
                                                    <?php 
                                                        if (is_numeric($data) && (strpos($data, '.') !== false || $data > 1000)):
                                                            echo number_format((float)$data, 0, ',', '.');
                                                        else:
                                                            echo htmlspecialchars($data);
                                                        endif;
                                                    ?>
                                                </td>
                                            <?php endforeach; ?>
                                            
                                            <?php 
                                                $id_pesanan = $row['NomorPesanan'] ?? $row['A.NomorPesanan'] ?? null;
                                                $row_data_encoded = http_build_query($row);
                                            ?>
                                            
                                            <td class="<?php echo $has_nomor_pesanan ? 'action-col-full' : 'action-col-detail'; ?>">
                                                <?php if ($has_nomor_pesanan && $id_pesanan): ?>
                                                    <div class="btn-group" role="group" aria-label="Aksi Pesanan">
                                                        <a href="detail.php?query_title=<?php echo urlencode($title); ?>&<?php echo $row_data_encoded; ?>" 
                                                           class="btn btn-info btn-sm text-white" 
                                                           title="Lihat Detail Transaksi">Detail</a>

                                                        <a href="edit.php?id=<?php echo htmlspecialchars($id_pesanan); ?>" 
                                                           class="btn btn-warning btn-sm" 
                                                           title="Edit Data Pesanan">Edit</a>
                                                           
                                                        <a href="#" class="btn btn-danger btn-sm" title="Hapus Data" 
                                                           onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                                                    </div>

                                                <?php elseif (strpos($title, 'Q2:') !== false || strpos($title, 'Q3:') !== false || strpos($title, 'Q5:') !== false): ?>
                                                    <a href="detail.php?query_title=<?php echo urlencode($title); ?>&<?php echo $row_data_encoded; ?>" 
                                                       class="btn btn-info btn-sm text-white" 
                                                       title="Lihat Rincian Data Agregasi">Detail</a>

                                                <?php else: ?>
                                                    <span class="text-muted">N/A</span>
                                                <?php endif; ?>
                                            </td>
                                            
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="alert alert-warning">Tidak ada data yang ditemukan untuk query ini.</p>
                    <?php endif; ?>
                
                <?php else: ?>
                    <p class="alert alert-danger">
                        <strong>Error Query:</strong> <?php echo htmlspecialchars($result['error']); ?>
                    </p>
                    <pre class="bg-light p-2 small"><?php echo htmlspecialchars($query); ?></pre>
                <?php endif; ?>

            </div> 
        </div> 
        <?php endforeach; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

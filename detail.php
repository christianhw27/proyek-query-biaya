<?php
$query_title = $_GET['query_title'] ?? 'Detail Baris Query';
$row_data = $_GET;
unset($row_data['query_title']); 
if (empty($row_data)) {
    die("<div class='alert alert-danger container mt-5'>Error: Data baris tidak ditemukan di URL.</div>");
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail: <?php echo htmlspecialchars($query_title); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> 
        body { background-color: #f8f9fa; } 
        .info-card-grid p { margin-bottom: 0.5rem; }
        .info-card-grid strong { display: inline-block; width: 220px; } 
        .info-card-grid .value { display: inline-block; }
    </style>
</head>
<body>

    <div class="container mt-5 mb-5">
        <h1 class="mb-4 text-primary">Detail Data Baris</h1>
        <p class="lead">Berasal dari <?php echo htmlspecialchars($query_title); ?></p>
        <p><a href="tampilan.php" class="btn btn-secondary btn-sm">← Kembali ke Tampilan Query</a></p>

        <hr>

        <div class="card shadow-sm border-primary mb-5">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Data Baris Terpilih</h5>
            </div>
            <div class="card-body info-card-grid">
                
                <?php foreach ($row_data as $key => $value): 
                    $label = htmlspecialchars(str_replace(['_', 'A.', 'B.'], ' ', ucwords($key)));
                    if (is_numeric($value) && (strpos($value, '.') !== false || $value > 1000)) {
                        $display_value = number_format((float)$value, 0, ',', '.');
                    } else {
                        $display_value = htmlspecialchars($value);
                    }
                ?>
                <p>
                    <strong><?php echo $label; ?>:</strong>
                    <span class="value"><?php echo $display_value; ?></span>
                </p>
                <?php endforeach; ?>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
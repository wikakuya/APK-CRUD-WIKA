<?php
$file = "data.txt";

// Tambah data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $baris = "$nim|$nama|$jurusan\n";
    file_put_contents($file, $baris, FILE_APPEND);
    header("Location: index.php");
    exit;
}

// Ambil data dari file
$data = [];
if (file_exists($file)) {
    $baris = file($file, FILE_IGNORE_NEW_LINES);
    foreach ($baris as $i => $line) {
        list($nim, $nama, $jurusan) = explode("|", $line);
        $data[] = ['id' => $i, 'nim' => $nim, 'nama' => $nama, 'jurusan' => $jurusan];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD Mahasiswa - data.txt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-4">Tambah Data Mahasiswa</h3>
                <form method="post" class="card p-4 shadow-sm bg-white">
                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" name="nim" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jurusan</label>
                        <input type="text" name="jurusan" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>

            <div class="col-md-6 mt-4 mt-md-0">
                <h3 class="mb-4">Data Mahasiswa</h3>
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <table class="table table-bordered table-striped mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Jurusan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($data) > 0): ?>
                                    <?php foreach ($data as $index => $mhs): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= htmlspecialchars($mhs['nim']) ?></td>
                                            <td><?= htmlspecialchars($mhs['nama']) ?></td>
                                            <td><?= htmlspecialchars($mhs['jurusan']) ?></td>
                                            <td>
                                                <a href="hapus.php?id=<?= $mhs['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="text-center">Belum ada data</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

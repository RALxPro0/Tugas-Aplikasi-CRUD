<?php
// Koneksi database
$db = mysqli_connect("localhost", "root", "20050114latif", "db_mahasiswa");

// 1. DELETE
if (isset($_GET['del'])) {
    mysqli_query($db, "DELETE FROM mahasiswa WHERE id = '$_GET[del]'");
    header("Location: crud.php");
    exit;
}

// 2. SIMPAN (INSERT / UPDATE)
if (isset($_POST['simpan'])) {
    $id   = $_POST['id'];
    $nim  = $_POST['nim'];
    $nama = $_POST['nama'];

    if ($id == "") {
        mysqli_query($db, "INSERT INTO mahasiswa (nim, nama) VALUES ('$nim', '$nama')");
    } else {
        mysqli_query($db, "UPDATE mahasiswa SET nim = '$nim', nama = '$nama' WHERE id = '$id'");
    }
    header("Location: crud.php");
    exit;
}

// 3. AMBIL DATA EDIT
$editId = $_GET['edit'] ?? '';
$rowEdit = ['nim' => '', 'nama' => ''];
if ($editId != '') {
    $res = mysqli_query($db, "SELECT * FROM mahasiswa WHERE id = '$editId'");
    $rowEdit = mysqli_fetch_assoc($res) ?? $rowEdit;
}

// 4. AMBIL SEMUA DATA UNTUK TABEL
$data = mysqli_query($db, "SELECT * FROM mahasiswa ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Mahasiswa</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; padding-top: 30px; }
        table { width: 450px; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #333; padding: 6px 10px; }
        .row { margin-bottom: 10px; }
        label { display: inline-block; width: 60px; }
        button { cursor: pointer; }
    </style>
</head>
<body>
<div>
    <!-- TABEL ATAS (READ, EDIT, DELETE) -->
    <table>
        <tr><th>NIM</th><th>Nama</th><th>Aksi</th></tr>
        <?php if (mysqli_num_rows($data) == 0): ?>
            <tr><td colspan="3" align="center">Belum ada data</td></tr>
        <?php else: while ($row = mysqli_fetch_assoc($data)): ?>
            <tr>
                <td><?= htmlspecialchars($row['nim']) ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td>
                    <a href="?edit=<?= $row['id'] ?>">Edit</a> | 
                    <a href="?del=<?= $row['id'] ?>" onclick="return confirm('Hapus?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; endif; ?>
    </table>

    <!-- FORM TENGAH & TOMBOL BAWAH -->
    <form method="POST">
        <input type="hidden" name="id" value="<?= $editId ?>">
        <div class="row"><label>NIM :</label><input type="text" name="nim" value="<?= htmlspecialchars($rowEdit['nim']) ?>" required></div>
        <div class="row"><label>Nama :</label><input type="text" name="nama" value="<?= htmlspecialchars($rowEdit['nama']) ?>" required></div>
        <button type="submit" name="simpan">SIMPAN</button>
        <?php if ($editId != ''): ?><a href="crud.php">Batal</a><?php endif; ?>
    </form>
</div>
</body>
</html>
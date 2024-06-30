<?php
session_start();
require 'db.php';

if (!$_SESSION['username']) {
    echo "<script>alert('Silahkan login !');
        document.location.href= 'login.php';; 
        </script> ";
}


//query data mhs
// $periksaData = query("SELECT periksa.*, dokter.nama as namaDokter, pasien.nama as namaPasien inner join dokter on dokter.id=periksa.id_dokter inner join pasien on pasien.id=periksa.id_pasien FROM periksa, dokter, pasien");
$periksaData = query("SELECT * FROM periksa ");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Periksa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Periksa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="user.php">User</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="pasien.php">Pasien</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="dokter.php">Dokter</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="periksa.php">Periksa</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="obat.php">Obat</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
    <div class="container p-5 m-5">
        <h1>Halaman Periksa</h1>

        <a href="add_periksa_form.php" class="btn btn-primary mt-5">+ Tambah</a>
        
        <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Pasien</th>
            <th scope="col">Nama Dokter</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Catatan</th>
            <th scope="col">Obat</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $i = 1;
        foreach ($periksaData as $m) : ?>
            <tr>
                <th scope="row"><?= $i++?></th>

                <?php $pas = query("SELECT * FROM pasien WHERE id =".$m['id_pasien']); 
                foreach ($pas as $p) : ?>

                <td><?= $p['nama']?></td>

                <?php endforeach; ?>

                <?php $dok = query("SELECT * FROM dokter WHERE id =".$m['id_dokter']); 
                foreach ($dok as $p) : ?>

                <td><?= $p['nama']?></td>

                <?php endforeach; ?>

                <td><?= $m['tgl_periksa']?></td>
                <td><?= $m['catatan']?></td>
                <td>
                    <ul class="list-group">
                    <?php $obat = query("SELECT detail_periksa.*, obat.nama_obat, obat.kemasan FROM detail_periksa INNER JOIN obat ON obat.id=detail_periksa.id_obat WHERE detail_periksa.id_periksa =".$m['id']); 
                    foreach ($obat as $p) : ?>

                    <li class="list-group-item"> <?= $p['nama_obat']?> -  <?= $p['kemasan']?></li>

                    <?php endforeach; ?>
                    </ul>
                
                </td>
                <td>
                    <a class="badge bg-danger text-white" href="hapus_periksa.php?id=<?= $m['id'] ?>">Hapus </a>
                    <a class="badge bg-info text-white" href="edit_periksa_form.php?id=<?= $m['id'] ?>"> Edit</a>
                    <a class="badge bg-primary text-white" href="add_detail_periksa_form.php?id=<?= $m['id'] ?>">Detail </a>
                    <a class="badge bg-warning text-white" href="nota.php?id=<?= $m['id'] ?>">Nota </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>

</html>
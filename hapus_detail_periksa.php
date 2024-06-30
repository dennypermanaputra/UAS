<?php
require 'db.php';
$id = $_GET['id'];
$id_periksa = $_GET['id_periksa'];
if (delDetailPeriksa($id) > 0) {
    echo "<script>alert('Hapus data obat berhasil');
    document.location.href= 'add_detail_periksa_form.php?id=$id_periksa';
    </script>";
} else {

    echo "<script>
    alert('Hapus data obat gagal');
    document.location.href= 'add_detail_periksa_form.php?id=$id_periksa';
    </script>";
}

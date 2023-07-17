<?php
// delete_data.php

// Cek apakah parameter employee_id ada
if(isset($_GET["employee_id"])) {
    $employee_id = $_GET["employee_id"];

    // Mengambil path file gambar sebelum menghapus data
    $connect = mysqli_connect("localhost", "root", "", "input_karyawan");
    $query = "SELECT foto_surat FROM absen WHERE id='$employee_id'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);
    $filePath = $row['foto_surat'];

    // Hapus file gambar jika ada
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Hapus data dari database
    $query = "DELETE FROM absen WHERE id='$employee_id'";
    mysqli_query($connect, $query);

    // Redirect ke halaman lain setelah data berhasil dihapus
    header("Location: index.php");
    exit();
}
?>

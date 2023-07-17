<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Absensi Karyawan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <style>
        .img-preview {
            max-width: 200px;
            max-height: 200px;
        }
        .disable-input {
    pointer-events: none;
         }
    section{
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-ontent:center;
        }

    </style>
    <script>
       function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        document.getElementById("latitude").value = position.coords.latitude;
        document.getElementById("longitude").value = position.coords.longitude;
    }

        function previewImg() {
            var imgFile = document.getElementById("foto_surat").files[0];
            var imgPreview = document.querySelector(".img-preview");

            var reader = new FileReader();

            reader.onload = function (e) {
                imgPreview.src = e.target.result;
            }

            reader.readAsDataURL(imgFile);
        }

    </script>
    <script>



    </script>
</head>
<body onload="getLocation()">
<section>
    <div class="container" style="width:500px;">
        <h3 align="center">Tambah Data Absensi Karyawan</h3>
        <br />
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Latitude</label>
                <input type="text" id="latitude" name="latitude" class="form-control disable-input" required>
            </div>
            <div class="form-group">
                <label>Longitude</label>
                <input type="text" id="longitude" name="longitude" class="form-control disable-input" required>
            </div>
            <div class="form-group">
                <label>User</label>
                <input type="text" name="user" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Jenis Absen</label>
                <select name="jenis_absen" class="form-control" required>
                    <option value="">-- Pilih Jenis Absen --</option>
                    <option value="Masuk kantor">Masuk kantor</option>
                    <option value="Pulang kantor">Pulang kantor</option>
                    <option value="Istirahat keluar">Istirahat keluar</option>
                    <option value="Istirahat masuk">Istirahat masuk</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Izin">Izin</option>
                    <option value="Tugas keluar">Tugas keluar</option>
                </select>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label>Foto/Surat</label>
                <input type="file" name="foto_surat" id="foto_surat" class="form-control" onchange="previewImg()" required></input>
                <div class="col-sm"><br>
                    <img src="" class="img-thumbnail img-preview">
                </div>
            </div>
            <div class="form-group">
                <input id="insert" type="submit" name="insert" value="Tambah" class="btn btn-success" />
            </div>
        </form>

        <div align="right">
            <a href="index.php" class="btn btn-warning">Batal</a>
        </div>
        <br />
    </div>
</section>
</body>
</html>
<?php
// create_data.php

// Cek apakah form telah disubmit
if(isset($_POST["insert"])) {
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];
    $user = $_POST["user"];
    $jenis_absen = $_POST["jenis_absen"];
    $keterangan = $_POST["keterangan"];
    
    // Upload file foto/surat
    $targetDir = "gambar/";
    $foto_surat = $targetDir . basename($_FILES["foto_surat"]["name"]);
    move_uploaded_file($_FILES["foto_surat"]["tmp_name"], $foto_surat);

    // Simpan data ke database
    $connect = mysqli_connect("localhost", "root", "", "input_karyawan");
    $query = "INSERT INTO absen (latitude, longitude, user, jenis_absen, keterangan, foto_surat) 
              VALUES ('$latitude', '$longitude', '$user', '$jenis_absen', '$keterangan', '$foto_surat')";

    if (mysqli_query($connect, $query)) {
        // Redirect ke halaman index.php jika penambahan data berhasil
        header("Location: index.php");
        exit();
    } else {
        // Redirect kembali ke create-data.php jika penambahan data gagal
        header("Location: create-data.php");
        exit();
    }
}
?>
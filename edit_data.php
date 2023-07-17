<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Absensi Karyawan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

<style>
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
</head>
<body>
<section>
    <div class="container" style="width:500px;">
        <h3 align="center">Edit Data Absensi Karyawan</h3>
        <br />
        <?php
        if(isset($_GET["employee_id"]))
        {
            $employee_id = $_GET["employee_id"];
            $connect = mysqli_connect("localhost", "root", "", "input_karyawan");
            $query = "SELECT * FROM absen WHERE id = '$employee_id'";
            $result = mysqli_query($connect, $query);
            while($row = mysqli_fetch_array($result))
            {
                ?>
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="employee_id" value="<?php echo $row['id']; ?>">
                    <div class="form-group">
                        <label>Latitude</label>
                        <input type="text" name="latitude" class="form-control disable-input" value="<?php echo $row['latitude']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Longitude</label>
                        <input type="text" name="longitude" class="form-control disable-input" value="<?php echo $row['longitude']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>User</label>
                        <input type="text" name="user" class="form-control" value="<?php echo $row['user']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Absen</label>
                        <select name="jenis_absen" class="form-control" required>
                            <option value="">-- Pilih Jenis Absen --</option>
                            <option value="Masuk kantor" <?php if($row['jenis_absen'] == 'Masuk kantor') echo 'selected'; ?>>Masuk kantor</option>
                            <option value="Pulang kantor" <?php if($row['jenis_absen'] == 'Pulang kantor') echo 'selected'; ?>>Pulang kantor</option>
                            <option value="Istirahat keluar" <?php if($row['jenis_absen'] == 'Istirahat keluar') echo 'selected'; ?>>Istirahat keluar</option>
                            <option value="Istirahat masuk" <?php if($row['jenis_absen'] == 'Istirahat masuk') echo 'selected'; ?>>Istirahat masuk</option>
                            <option value="Sakit" <?php if($row['jenis_absen'] == 'Sakit') echo 'selected'; ?>>Sakit</option>
                            <option value="Izin" <?php if($row['jenis_absen'] == 'Izin') echo 'selected'; ?>>Izin</option>
                            <option value="Tugas keluar" <?php if($row['jenis_absen'] == 'Tugas keluar') echo 'selected'; ?>>Tugas keluar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" required><?php echo $row['keterangan']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Foto/Surat</label>
                        <input type="file" name="foto_surat" id="foto_surat" class="form-control" onchange="previewImg()"></input>
                        <div class="col-sm"><br>
                            <img src="<?php echo $row['foto_surat']; ?>" width="200px" class="img-thumbnail img-preview">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="update" value="Update" class="btn btn-success" />
                    </div>
                </form>
        
        <div align="right">
            <a href="index.php" class="btn btn-warning">Batal</a>
        </div>
        <br />
                <?php
            }
        }
        ?>
    </div>
</section>
</body>
</html>

<?php
// edit_data.php

// Cek apakah form telah disubmit
if(isset($_POST["update"])) {
    $employee_id = $_POST["employee_id"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];
    $user = $_POST["user"];
    $jenis_absen = $_POST["jenis_absen"];
    $keterangan = $_POST["keterangan"];
    
    // Mengambil informasi file gambar baru
    $foto_surat = $_FILES["foto_surat"]["name"];
    $tmp_name = $_FILES["foto_surat"]["tmp_name"];
    $targetDir = "gambar/";

    // Cek apakah file gambar baru diupload
    if ($foto_surat) {
        // Menghapus file gambar lama jika ada
        $connect = mysqli_connect("localhost", "root", "", "input_karyawan");
        $query = "SELECT foto_surat FROM absen WHERE id='$employee_id'";
        $result = mysqli_query($connect, $query);
        $row = mysqli_fetch_assoc($result);
        $oldFilePath = $row['foto_surat'];
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath);
        }

        // Upload file gambar baru
        $targetPath = $targetDir . $foto_surat;
        move_uploaded_file($tmp_name, $targetPath);

        // Update data di database termasuk pembaruan gambar
        $query = "UPDATE absen SET latitude='$latitude', longitude='$longitude', user='$user', jenis_absen='$jenis_absen', keterangan='$keterangan', foto_surat='$targetPath' WHERE id='$employee_id'";
        mysqli_query($connect, $query);
    } else {
        // Update data di database tanpa pembaruan gambar
        $connect = mysqli_connect("localhost", "root", "", "input_karyawan");
        $query = "UPDATE absen SET latitude='$latitude', longitude='$longitude', user='$user', jenis_absen='$jenis_absen', keterangan='$keterangan' WHERE id='$employee_id'";
        mysqli_query($connect, $query);
    }

    // Redirect ke halaman lain setelah data berhasil diupdate
    header("Location: index.php");
    exit();
}
?>

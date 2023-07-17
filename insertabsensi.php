<?php
//insert.php
//insert.php
$connect = mysqli_connect("localhost", "root", "", "input_karyawan");
if (!empty($_POST)) {
    $output = '';

    // Menerima data dari form input
    $latitude = mysqli_real_escape_string($connect, $_POST["latitude"]);
    $longitude = mysqli_real_escape_string($connect, $_POST["longitude"]);
    $user = mysqli_real_escape_string($connect, $_POST["user"]);
    $jenis_absen = mysqli_real_escape_string($connect, $_POST["jenis_absen"]);
    $keterangan = mysqli_real_escape_string($connect, $_POST["keterangan"]);

    // Mengelola file gambar yang diunggah
   
    $foto_surat = '';
    if (!empty($_FILES['foto_surat']['name'])) {
        $foto_surat = $_FILES['foto_surat']['name'];

        // Tentukan direktori penyimpanan gambar
        $uploadDirectory = './gambar/'; // Ganti dengan direktori yang sesuai

        // Pindahkan file gambar ke direktori yang ditentukan
        if (move_uploaded_file($_FILES['foto_surat']['tmp_name'], $uploadDirectory . $foto_surat)) {
            // File gambar berhasil diunggah, lanjutkan dengan operasi pengisian database
        } else {
            // Terjadi kesalahan saat mengunggah file gambar
            $output .= '<label class="text-danger">Terjadi kesalahan saat mengunggah file gambar.</label>';
            echo $output;
            exit; // Hentikan eksekusi lebih lanjut
        }
    }

    $query = "INSERT INTO absen (latitude, longitude, user, jenis_absen, keterangan, foto_surat)
              VALUES ('$latitude', '$longitude', '$user', '$jenis_absen', '$keterangan', '$foto_surat')";

    if (mysqli_query($connect, $query)) {
        $output .= '<label class="text-success">Data Berhasil Masuk</label>';
        $select_query = "SELECT * FROM absen ORDER BY id DESC";
        $result = mysqli_query($connect, $select_query);
        $output .= '
            <table class="table table-bordered">  
                <tr>  
                    <th width="55%">Nama Karyawan</th>  
                    <th width="15%">Lihat</th>  
                    <th width="15%">Edit</th>  
                    <th width="15%">Hapus</th>  
                </tr>
        ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
                <tr>  
                    <td>' . $row["user"] . '</td>  
                    <td><input type="button" name="view" value="Lihat Detail" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data" /></td>  
                    <td><input type="button" name="edit" value="Edit" id="' . $row["id"] . '" class="btn btn-warning btn-xs edit_data" /></td>       
                    <td><input type="button" name="delete" value="Hapus" id="' . $row["id"] . '" class="btn btn-danger btn-xs hapus_data" /></td>
                </tr>
            ';
        }
        $output .= '</table>';
    } else {
        $output .= mysqli_error($connect);
    }
    echo $output;
}

?>
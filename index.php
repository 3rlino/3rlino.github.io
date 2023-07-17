<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Absensi Karyawan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<style>
  section{
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-ontent:center;
  }
</style>
  </head>
<body>
  <section>
    <div class="container" style="width:700px;">
        <h3 align="center">Data Absensi Karyawan</h3>
        <br />
        <div align="right">
            <a href="create_data.php" class="btn btn-warning">Tambah Data Absensi</a>
        </div>
        <br />
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th width="55%">Nama Karyawan</th>  
                    <th width="15%">Lihat Detail</th>
                    <th width="15%">Edit</th>
                    <th width="15%">Hapus</th>
                </tr>
                <?php
                $connect = mysqli_connect("localhost", "root", "", "input_karyawan");
                $query = "SELECT * FROM absen ORDER BY id DESC";
                $result = mysqli_query($connect, $query);
                while($row = mysqli_fetch_array($result))
                {
                    echo '<tr>
                            <td>'.$row["user"].'</td>
                            <td><a href="lihat_detail.php?employee_id='.$row["id"].'" class="btn btn-info btn-xs">Lihat Detail</a></td>
                            <td><a href="edit_data.php?employee_id='.$row["id"].'" class="btn btn-warning btn-xs">Edit</a></td>
                            <td><a href="delete_data.php?employee_id='.$row["id"].'" class="btn btn-danger btn-xs">Hapus</a></td>
                        </tr>';
                }
                ?>
            </table>
        </div>
    </div>
    </section
</body>
</html>
<script>
function getCurrentLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    console.log("Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {
  var latitude = position.coords.latitude;
  var longitude = position.coords.longitude;
  document.getElementById("latitude").value = latitude;
  document.getElementById("longitude").value = longitude;
}

// Panggil fungsi getCurrentLocation() saat halaman dimuat
getCurrentLocation();
</script>
<script>

  function previewImg(){

    
  const foto_surat = document.querySelector('#foto_surat')
  const fotoLabel = document.querySelector('.custom-label')
  const imgPreview = document.querySelector('.img-preview')

  fotoLabel.textContent = foto_surat.files[0].name;

  const fileFoto = new FileReader();
  fileFoto.readAsDataURL(foto_surat.files[0]);

  fileFoto.onload = function(e){
    imgPreview.src = e.target.result;
  }

  }

  </script>
<script>
$('#update_form').on("submit", function(event){  
  event.preventDefault();  
  if($('#elatitude').val() == "")  
  {  
   alert("Mohon Isi latitude ");  
  }  
  else if($('#elongitude').val() == '')  
  {  
   alert("Mohon Isi longitude");  
  } 
  else if($('#euser').val() == '')  
  {  
   alert("Mohon Isi user");  
  }  
  else if($('#ejenis_absen').val() == '')  
  {  
   alert("Mohon Isi jenis absen");  
  }  
  else if($('#eketerangan').val() == '')  
  {  
   alert("Mohon Isi keterangan");  
  }
  else if($('#efoto_surat').val() == '')  
  {  
   alert("Mohon Isi foto_surat");  
  }      
  
  else 
  {  
   $.ajax({  
    url:"updateabsensi.php",  
    method:"POST",  
    data:$('#update_form').serialize(),  
    beforeSend:function(){  
     $('#update').val("Updating");  
    },  
    success:function(data){  
     $('#update_form')[0].reset();  
     $('#editModal').modal('hide');  
     $('#employee_table').html(data);  
    }  
   });  
  }  
 });
</script>
<?php 
if(isset($_POST["employee_id"]))
{
 $output = '';
 $connect = mysqli_connect("localhost", "root", "", "input_karyawan");
 $query = "SELECT * FROM absen WHERE id = '".$_POST["employee_id"]."'";
 $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
     $output .= '
         <form method="post" id="update_form">
     <label>Latitude</label>
     <input type="hidden" name="id" id="id" value="'.$_POST["employee_id"].'" class="form-control" />
     <input type="text" name="latitude" id="elatitude" value="'.$row['latitude'].'" class="form-control" />
     <br />
     <label>Longitude</label>
     <input type="text" name="longitude" id="elongitude" value="'.$row['longitude'].'" class="form-control" />
     <br />
     <label>User</label>
     <input type="text" name="user" id="euser" value="'.$row['user'].'" class="form-control" />
     <br />
     
     <label>Jenis absen</label>
     <select name="jenis_absen" id="ejenis_absen" class="form-control">';
     if($row['jenis_absen']=="--silakan pilih--"){
      $output .= '<option value="--silakan pilih--" selected>--silakan pilih--</option>
      <option value="Masuk kantor" >Masuk kantor</option>
      <option value="Pulang kantor">Pulang kantor</option>
      <option value="Istirahat keluar">Istirahat keluar</option>
      <option value="Istirahat masuk">Istirahat masuk</option>
      <option value="Sakit">Sakit</option>
      <option value="Izin">Izin</option>
      <option value="Tugas keluar">Tugas keluar</option>';
     }elseif($row['jenis_absen']=="Masuk kantor"){
        $output .= '<option value="--silakan pilih--">--silakan pilih--</option>
        <option value="Masuk kantor" selected>Masuk kantor</option>
        <option value="Pulang kantor" >Pulang kantor</option>
        <option value="Istirahat keluar">Istirahat keluar</option>
        <option value="Istirahat masuk">Istirahat masuk</option>
        <option value="Sakit">Sakit</option>
        <option value="Izin">Izin</option>
        <option value="Tugas keluar">Tugas keluar</option>';
     }elseif($row['jenis_absen']=="Pulang kantor"){
        $output .= '<option value="--silakan pilih--">--silakan pilih--</option>
        <option value="Masuk kantor">Masuk kantor</option>
        <option value="Pulang kantor" selected>Pulang kantor</option>
        <option value="Istirahat keluar" >Istirahat keluar</option>
        <option value="Istirahat masuk">Istirahat masuk</option>
        <option value="Sakit">Sakit</option>
        <option value="Izin">Izin</option>
        <option value="Tugas keluar">Tugas keluar</option>';
     }elseif($row['jenis_absen']=="Istirahat keluar"){
        $output .= '<option value="--silakan pilih--">--silakan pilih--</option>
        <option value="Masuk kantor">Masuk kantor</option>
        <option value="Pulang kantor" >Pulang kantor</option>
        <option value="Istirahat keluar" selected>Istirahat keluar</option>
        <option value="Istirahat masuk" >Istirahat masuk</option>
        <option value="Sakit">Sakit</option>
        <option value="Izin">Izin</option>
        <option value="Tugas keluar">Tugas keluar</option>';
     }elseif($row['jenis_absen']=="Istirahat masuk"){
        $output .= '<option value="--silakan pilih--">--silakan pilih--</option>
        <option value="Masuk kantor">Masuk kantor</option>
        <option value="Pulang kantor">Pulang kantor</option>
        <option value="Istirahat keluar">Istirahat keluar</option>
        <option value="Istirahat masuk selected">Istirahat masuk</option>
        <option value="Sakit" >Sakit</option>
        <option value="Izin">Izin</option>
        <option value="Tugas keluar">Tugas keluar</option>';
     }elseif($row['jenis_absen']=="Sakit"){
        $output .= '<option value="--silakan pilih--">--silakan pilih--</option>
        <option value="Masuk kantor">Masuk kantor</option>
        <option value="Pulang kantor" >Pulang kantor</option>
        <option value="Istirahat keluar">Istirahat keluar</option>
        <option value="Istirahat masuk">Istirahat masuk</option>
        <option value="Sakit" selected>Sakit</option>
        <option value="Izin" >Izin</option>
        <option value="Tugas keluar">Tugas keluar</option>';
     }elseif($row['jenis_absen']=="Izin"){
        $output .= '<option value="--silakan pilih--">--silakan pilih--</option>
        <option value="Masuk kantor">Masuk kantor</option>
        <option value="Pulang kantor" >Pulang kantor</option>
        <option value="Istirahat keluar">Istirahat keluar</option>
        <option value="Istirahat masuk">Istirahat masuk</option>
        <option value="Sakit">Sakit</option>
        <option value="Izin" selected>Izin</option>
        <option value="Tugas keluar" >Tugas keluar</option>';
      }elseif($row['jenis_absen']=="Tugas keluar"){
         $output .= '<option value="--silakan pilih--">--silakan pilih--</option>
         <option value="Masuk kantor">Masuk kantor</option>
         <option value="Pulang kantor" >Pulang kantor</option>
         <option value="Istirahat keluar">Istirahat keluar</option>
         <option value="Istirahat masuk">Istirahat masuk</option>
         <option value="Sakit">Sakit</option>
         <option value="Izin" >Izin</option>
         <option value="Tugas keluar" selected>Tugas keluar</option>';
     }else{
        $output .= '<option value="--silakan pilih--" selected>--silakan pilih--</option>
        <option value="Masuk kantor">Masuk kantor</option>
        <option value="Pulang kantor">Pulang kantor</option>
        <option value="Istirahat keluar">Istirahat keluar</option>
        <option value="Istirahat masuk">Istirahat masuk</option>
        <option value="Sakit">Sakit</option>
        <option value="Izin">Izin</option>
        <option value="Tugas keluar" >Tugas keluar</option>';
     }
     $output .= '</select>
     <br />  
     <label>Keterangan</label>
     <input type="text" name="keterangan" id="eketerangan" value="'.$row['keterangan'].'" class="form-control" />
     <br />
     <label class="custom-label">Foto/Surat</label>
     <input type="file" name="foto_surat" id="foto_surat" class="form-control" onchange="previewImg()" value="'.$row['foto_surat'].'"></input>
     <br />
     <div class="col-sm">
      <img src="./gambar/'.$row['foto_surat'].'" width="200px" class="img-thumbnail img-preview">
     </div>
     <br />
     <input type="submit" name="update" id="update" value="Update" class="btn btn-success" />
 
    </form>
     ';
    echo $output;
}
?>
<script>

function previewImg() {
  const foto_surat = document.querySelector('#foto_surat');
  const fotoLabel = document.querySelector('.custom-label');
  const imgPreview = document.querySelector('.img-preview');

  // Perbarui nama file di elemen label
  fotoLabel.textContent = foto_surat.files[0].name;

  const fileFoto = new FileReader();
  fileFoto.readAsDataURL(foto_surat.files[0]);

  fileFoto.onload = function(e) {
    // Perbarui pratinjau gambar
    imgPreview.src = e.target.result;
  };
}


</script>
<?php  
//index.php
$connect = mysqli_connect("localhost", "root", "", "input_karyawan");
$query = "SELECT * FROM absen ORDER BY id DESC";
$result = mysqli_query($connect, $query);
 ?>  
<!DOCTYPE html>  
<html>  
 <head>  
  <title>Tutorial Popup Input Data Dengan PHP | www.sistemit.com </title>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
 </head>  
 <style>
  .disable-input {
    pointer-events: none;
  }
</style>
 <body>  
 
  <div class="container" style="width:700px;"> 
   <h3 align="center">Input Data Absensi Karyawan</h3>  
   <br />  
   <div class="table-responsive">
    <div align="right">
     <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Tambah Data Absensi</button>
    </div>
    <br />
    <div id="employee_table">
     <table class="table table-bordered">
      <tr>
       <th width="55%">Nama Karyawan</th>  
       <th width="15%">Lihat Detail</th>
       <th width="15%">Edit</th>
       <th width="15%">Hapus</th>
      </tr>
      <?php
      while($row = mysqli_fetch_array($result))
      {
      ?>
      <tr>
       <td><?php echo $row["user"]; ?></td>
       <td><a href="lihat_detail.php?employee_id=<?php echo $row["id"]; ?>" class="btn btn-info btn-xs" target="_blank">Lihat Detail</a></td>
         <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-xs edit_data" /></td> 
        <td><input type="button" onclick="confirmDelete(1)" name="delete" value="Hapus" id="<?php echo $row["id"]; ?>" class="btn btn-danger btn-xs hapus_data" /></td> 
       
      </tr>
      <?php
      }
      ?>
     </table>
    </div>
   </div> 
  </div>
 </body>  
</html>  
 
<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Input Data Tidak Menggunakan Modal Bootstrap</h4>
   </div>
   <div class="modal-body">
    <form method="post" id="insert_form" enctype="multipart/form-data">
    <label>Latitude</label>
    <input type="text" name="latitude" id="latitude" oncopy="return false;" oncut="return false;" onpaste="return false;" class="form-control disable-input" />
    <br />
    <label>Longitude</label>
    <input type="text" name="longitude" id="longitude" oncopy="return false;" oncut="return false;" onpaste="return false;" class="form-control disable-input"></input>
    <br />
     <label>User</label>
     <input name="user" id="user" class="form-control"></input>
     <br />
     <label>Jenis Absen</label>
     <select name="jenis_absen" id="jenis_absen" class="form-control">
     <option value="--silakan pilih--">--silakan pilih--</option>  
      <option value="Masuk kantor">Masuk kantor</option>  
      <option value="Pulang kantor">Pulang kantor</option>
      <option value="Istirahat keluar">Istirahat keluar</option>
      <option value="Istirahat masuk">Istirahat masuk</option>
      <option value="Sakit">Sakit</option>
      <option value="Izin">Izin</option>
      <option value="Tugas keluar">Tugas keluar</option>
     </select>
     <br />
     <label>Keterangan</label>
     <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
     <br />
     <label class="custom-label">Foto/Surat</label>
     <input type="file" name="foto_surat" id="foto_surat" class="form-control" onchange="previewImg()"></input>
     <br />
     <div class="col-sm">
      <img src="" width="200px" class="img-thumbnail img-preview">
     </div>
     <br />
     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
 
    </form>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>
 

 
 
<div id="editModal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Edit Data Karyawan</h4>
   </div>
   <div class="modal-body" id="form_edit">
     
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>
 
<script>  
$(document).ready(function(){
// Begin Aksi Insert
 $('#insert_form').on("submit", function(event){  
  event.preventDefault();  
  if($('#latitude').val() == "")  
  {  
   alert("Mohon Isi Latitude ");  
  }  
  else if($('#longitude').val() == '')  
  {  
   alert("Mohon Isi longitude");  
  } 
  else if($('#user').val() == '')  
  {  
   alert("Mohon Isi user");  
  }  
  else if($('#jenis_absen').val() == '')  
  {  
   alert("Mohon Isi jenis absen");  
  }   
  else if($('#keterangan').val() == '')  
  {  
   alert("Mohon Isi keterangan");  
  }
  else if($('#foto_surat').val() == '')  
  {  
   alert("Mohon Isi foto_surat");  
  }    
  
  else 
  {  
    $('#insert_form').on("submit", function(event) {
  event.preventDefault();

  var form_data = new FormData(this); // Membuat objek FormData dari form

  // Tambahkan nilai latitude dan longitude ke FormData
  form_data.append("latitude", $('#latitude').val());
  form_data.append("longitude", $('#longitude').val());

  // Tambahkan data gambar ke FormData
  var fileInput = $('#foto_surat')[0].files[0]; // Ambil file gambar dari input file
  form_data.append("foto_surat", fileInput);

  // ...

  $.ajax({
    url: "insertabsensi.php",
    method: "POST",
    data: form_data, // Mengirim objek FormData
    contentType: false, // Mengatur tipe konten menjadi false
    processData: false, // Menonaktifkan pengolahan data
    beforeSend: function() {
      $('#insert').val("Inserting");
    },
    success: function(data) {
      $('#insert_form')[0].reset();
      $('#add_data_Modal').modal('hide');
      $('#employee_table').html(data);
    }
  });
});
  }  
 });
//END Aksi Insert
 
//Begin Tampil Detail Karyawan
 $(document).on('click', '.view_data', function(){
  var employee_id = $(this).attr("id");
  $.ajax({
   url:"lihat_detail.php",
   method:"POST",
   data:{employee_id:employee_id},
   success:function(data){
    $('#detail_karyawan').html(data);
    $('#dataModal').modal('show');
   }
  });
 });
//End Tampil Detail Karyawan
  
//Begin Tampil Form Edit
  $(document).on('click', '.edit_data', function(){
  var employee_id = $(this).attr("id");
  $.ajax({
   url:"editabsensi.php",
   method:"POST",
   data:{employee_id:employee_id},
   success:function(data){
    $('#form_edit').html(data);
    $('#editModal').modal('show');
   }
  });
 });
//End Tampil Form Edit
 
//Begin Aksi Delete Data
 $(document).on('click', '.hapus_data', function(){
  var employee_id = $(this).attr("id");
  $.ajax({
   url:"deleteabsensi.php",
   method:"POST",
   data:{employee_id:employee_id},
   success:function(data){
   $('#employee_table').html(data);  
   }
  });
 });
}); 
//End Aksi Delete Data
 </script>
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
  <script>
function confirmDelete(id) {
  var confirmation = confirm("Apakah Anda yakin ingin menghapus data?");

  if (confirmation) {
    deleteData(id);
  } else {
    console.log("Penghapusan dibatalkan");
    return false; // Add this line to prevent further execution
  }
}

function deleteData(id) {
  // Lakukan penghapusan data berdasarkan ID di sini
  // Misalnya, kirim permintaan AJAX ke server untuk menghapus data
  // atau lakukan operasi penghapusan lain yang sesuai
  
  // Contoh pemanggilan AJAX
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "delete_data.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log("Data dengan ID " + id + " berhasil dihapus");
      // Lakukan tindakan lain setelah penghapusan berhasil
    } else if (xhr.readyState === 4 && xhr.status !== 200) {
      console.log("Terjadi kesalahan saat menghapus data");
      // Lakukan tindakan lain jika terjadi kesalahan saat penghapusan
    }
  };
  xhr.send("id=" + id);
}
</script>


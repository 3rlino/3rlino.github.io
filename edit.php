<script>
$('#update_form').on("submit", function(event){  
  event.preventDefault();  
  if($('#enama').val() == "")  
  {  
   alert("Mohon Isi Nama ");  
  }  
  else if($('#ealamat').val() == '')  
  {  
   alert("Mohon Isi Alamat");  
  }  
  
  else 
  {  
   $.ajax({  
    url:"update.php",  
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
 $query = "SELECT * FROM karyawan WHERE id = '".$_POST["employee_id"]."'";
 $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
     $output .= '
         <form method="post" id="update_form">
     <label>Nama Karyawan</label>
     <input type="hidden" name="id" id="id" value="'.$_POST["employee_id"].'" class="form-control" />
     <input type="text" name="nama" id="enama" value="'.$row['nama'].'" class="form-control" />
     <br />
     <label>Alamat Karyawan</label>
     <textarea name="alamat" id="ealamat" class="form-control">'.$row['alamat'].'</textarea>
     <br />
     <label>Jenis Kelamin</label>
     <select name="gender" id="gender" class="form-control">';
     if($row['gender']=="Laki-laki"){
      $output .= '<option value="Laki-laki" selected>Laki-laki</option>  
      <option value="Perempuan">Perempuan</option>';
     }elseif($row['gender']=="Perempuan"){
        $output .= '<option value="Laki-laki">Laki-laki</option>  
      <option value="Perempuan" selected>Perempuan</option>';
     }else{
        $output .= '<option value="Laki-laki">Laki-laki</option>  
      <option value="Perempuan">Perempuan</option>';
     }
     $output .= '</select>
     <br />  
     <label>Umur</label>
     <input type="text" name="umur" id="umur" value="'.$row['umur'].'" class="form-control" />
     <br />
     <input type="submit" name="update" id="update" value="Update" class="btn btn-success" />
 
    </form>
     ';
    echo $output;
}
?>
<?php  
//select.php  
if(isset($_POST["employee_id"]))
{
 $output = '';
 $connect = mysqli_connect("localhost", "root", "", "input_karyawan");
 $query = "SELECT * FROM absen WHERE id = '".$_POST["employee_id"]."'";
 $result = mysqli_query($connect, $query);
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    while($row = mysqli_fetch_array($result))
    {
     $output .= '
     <tr>  
            <td width="30%"><label>Latitude</label></td>  
            <td width="70%">'.$row["latitude"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Longitude</label></td>  
            <td width="70%">'.$row["longitude"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>User</label></td>  
            <td width="70%">'.$row["user"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Jenis Absen</label></td>  
            <td width="70%">'.$row["jenis_absen"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Keterangan</label></td>  
            <td width="70%">'.$row["keterangan"].'</td>  
        </tr>
       
        <tr>  
            <td width="30%"><label>Foto/Surat</label></td>  
            <td width="70%"><img src="./gambar/'.$row['foto_surat'].'" width="200px" class="img-thumbnail img-preview"></td>  
        </tr>
     ';
    }
    $output .= '</table></div>';
    echo $output;
}
?>
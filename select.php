<?php  
//select.php  
if(isset($_POST["employee_id"]))
{
 $output = '';
 $connect = mysqli_connect("localhost", "root", "", "input_karyawan");
 $query = "SELECT * FROM karyawan WHERE id = '".$_POST["employee_id"]."'";
 $result = mysqli_query($connect, $query);
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    while($row = mysqli_fetch_array($result))
    {
     $output .= '
     <tr>  
            <td width="30%"><label>Name</label></td>  
            <td width="70%">'.$row["nama"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Alamat</label></td>  
            <td width="70%">'.$row["alamat"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Gender</label></td>  
            <td width="70%">'.$row["gender"].'</td>  
        </tr>
       
        <tr>  
            <td width="30%"><label>Umur</label></td>  
            <td width="70%">'.$row["umur"].'</td>  
        </tr>
     ';
    }
    $output .= '</table></div>';
    echo $output;
}
?>
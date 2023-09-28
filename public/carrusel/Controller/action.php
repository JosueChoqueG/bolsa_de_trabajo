<?php
//David Ordonez
if(isset($_POST["action"]))
{
 $connect = mysqli_connect("localhost", "root", "", "bolsadet_job_boart");
 if($_POST["action"] == "fetch")
 {  
  $query = "SELECT * FROM carousel ORDER BY id DESC";
  $result = mysqli_query($connect, $query);
  $output = '
   <table class="table table-bordered table-striped">  
    <tr>
     <th width="10%">ID</th>
     <th width="70%">Image</th>
     <th width="10%">Editar</th>
     <th width="10%">Eliminar</th>
    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '

    <tr>
     <td>'.$row["id"].'</td>
     <td>
      <img src="data:image/*;base64,'.base64_encode($row['img'] ).'" height="60" width="75" class="img-thumbnail" />
     </td>
     <td><button type="button" name="update" class="btn btn-warning bt-xs update" id="'.$row["id"].'">Editar</button></td>
     <td><button type="button" name="delete" class="btn btn-danger bt-xs delete" id="'.$row["id"].'">Eliminar</button></td>
    </tr>
   ';
  }
  $output .= '</table>';
  echo $output;
 }

 if($_POST["action"] == "insert")
 {
  $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
  $query = "INSERT INTO carousel(img) VALUES ('$file')";
  if(mysqli_query($connect, $query))
  {
   echo 'Imagen guardada en la base de datos';
  }
  else{
    echo "Error";
  }
 }
 if($_POST["action"] == "update")
 {
  $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
  $query = "UPDATE carousel SET img = '$file' WHERE id = '".$_POST["image_id"]."'";
  if(mysqli_query($connect, $query))
  {
   echo 'Imagen actualizada en la base de datos';
  }
 }
 if($_POST["action"] == "delete")
 {
  $query = "DELETE FROM carousel WHERE id = '".$_POST["image_id"]."'";
  if(mysqli_query($connect, $query))
  {
   echo 'Imagen eliminada de la base de datos';
  }
 }
}
?>
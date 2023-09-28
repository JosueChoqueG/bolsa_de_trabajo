<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Editar Carousel</title>
	<link rel="stylesheet" type="text/css" href="../librerias/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../librerias/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="../librerias/alertifyjs/css/themes/default.css">

	<script src="../librerias/jquery-3.2.1.min.js"></script>
	<script src="../js/funciones.js"></script>
	<script src="../librerias/bootstrap/js/bootstrap.js"></script>
	<script src="../librerias/alertifyjs/alertify.js"></script>
</head>
<body>

	<nav class="navbar navbar-inverse">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Orsade app</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../">BTU-UNAMBA</a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="../">Inicio</a></li>
          
        </ul>
      </div>
    </div>
  </nav>

	<div class="container" style="width:900px;">  
	   <h3 align="center">Controlador Frente Slider</h3>  
	   <br />
	   <div align="right">
	    <button type="button" name="add" id="add" class="btn btn-success">Agregar</button>
	   </div>
	   <br />
	   <div id="image_data">

	   </div>
    </div>  
</body>
</html>

<div id="imageModal" class="modal fade" role="dialog">
	 <div class="modal-dialog ">
	  <div class="modal-content ">
	   <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal">&times;</button>
	    <h4>Agregar imagen</h4>
	   </div>
	   <div class="modal-body">
	    <form id="image_form" method="post" enctype="multipart/form-data">
	     <p><label>Seleccionar imagen</label>
	     <input type="file" name="image" id="image" /></p><br />
	     <input type="hidden" name="action" id="action" value="Insert" />
       <input type="hidden" name="image_id" id="image_id" />
       <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />  
	    </form>
	   </div>
	   <div class="modal-footer">
	    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	   </div>
	  </div>
	 </div>
	</div>



<script>  
$(document).ready(function(){
 
 fetch_data();

 function fetch_data()
 {
  var action = "fetch";
  $.ajax({
   url:"../Controller/action.php",
   method:"POST",
   data:{action:action},
   success:function(data)
   {
    $('#image_data').html(data);
   }
  })
 }
 $('#add').click(function(){
  $('#imageModal').modal('show');
  $('#image_form')[0].reset();
  $('.modal-title').text("Add Image");
  $('#image_id').val('');
  $('#action').val('insert');
  $('#insert').val("Insert");
 });
 $('#image_form').submit(function(event){
  event.preventDefault();
  var image_name = $('#image').val();
  if(image_name == '')
  {
   alert("Porfavor seleccione una imagen");
   return false;
  }
  else
  {
   var extension = $('#image').val().split('.').pop().toLowerCase();
   if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
   {
    alert("Archivo de imagen inválido");
    $('#image').val('');
    return false;
   }
   else
   {
    $.ajax({
     url:"../Controller/action.php",
     method:"POST",
     data:new FormData(this),
     contentType:false,
     processData:false,
     success:function(data)
     {
      alert(data);
      fetch_data();
      $('#image_form')[0].reset();
      $('#imageModal').modal('hide');
     }
    });
   }
  }
 });
 $(document).on('click', '.update', function(){
  $('#image_id').val($(this).attr("id"));
  $('#action').val("update");
  $('.modal-title').text("Update Image");
  $('#insert').val("Update");
  $('#imageModal').modal("show");
 });
 $(document).on('click', '.delete', function(){
  var image_id = $(this).attr("id");
  var action = "delete";
  if(confirm("Esta seguro de remover de la base de datos?"))
  {
   $.ajax({
    url:"../Controller/action.php",
    method:"POST",
    data:{image_id:image_id, action:action},
    success:function(data)
    {
     alert(data);
     fetch_data();
     alertify.success("Eliminado con exito");
    }
   })
  }
  else
  {
   alertify.error("Se cancelo");
   return false;
  }
 });
});  
</script>


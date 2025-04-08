<!-- guadaremos el producto en la base de datos -->
<?php
//conexcion a la base de datos
include("conexionEfra.php");



//recibimos los datos del formulario
$nombreproducto = $_POST['nombre'];
//limpiamos los datos del formulario
$nombreproducto = limpiarDatos($nombreproducto);

$Descripción = $_POST['Descripción'];
$Precio = $_POST['precio'];
$Categoria = $_POST['categoria'];
$imagen = $_FILES['imagen']['name'];
//establecemos la ruta de la imagen para guardarla en la carpeta imagenes
$target_dir = "../../assets/img/productos/";
//subimos la imagen a la carpeta imagenes
$target_file = $target_dir . basename($imagen);
// estado de la carga
$uploadOk = 1;
//tipo de archivo
$imagenFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//verificamos si la imagen es una imagen real o un falso
    $check = getimagesize($_FILES['imagen']['tmp_name']);
    if ($check !== false) {
        echo "El archivo es una imagen - " . $check['mime'] . ".";
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }
//verificamos si el archivo ya existe
if (file_exists($target_file)) {
    echo "Lo siento, el archivo ya existe.";
    $uploadOk = 0;
}
//permitir ciertos tipos de archivo
if ($imagenFileType != "jpg" && $imagenFileType != "png" && $imagenFileType != "jpeg" && $imagenFileType != "gif") {
  echo "Lo siento, solo se permiten archivos JPG, JPEG y PNG.";
  $uploadOk = 0;
}

//verificamos di la bandera esta en true o false
if($uploadOk == 0 ){
echo"Lo sinto, tu archivo no fue subido";

}else{
  // si cumple movemos la imagen a la carpeta de img que esta en assets
  if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)){
    // insertar los datos a la base de dato
    $sqle = "INSERT INTO  productos (nombre, descripcion, precio, Categoria ,imagenes) VALUES ('$nombreproducto', '$Descripción', '$Precio', '$Categoria', '$target_file')";
    //ejecutar la consulta de sql
    if($connn->query($sqle) == true){
    echo "El producto ha sido guardado correctamente";
    }else{
      echo "Error".$sqle."<br>".$connn->error;
    }

  }else{
    echo "Lo sitento, hubo un error al subir el";


  }
}

$connn->close();

//funcion para limpiar los datos del formulario
function limpiarDatos($datos){
  //lipia espacios en blanco al principio y al final
  $datos = trim($datos);
  //quita las barras invertidas de un string con comillas escapadas
  $datos = stripslashes($datos);
  //Convierte caracteres especiales en entidades HTML con htmlspecialchars
  $datos = htmlspecialchars($datos);
  //convierte a minusculas
  $datos = strtolower($datos);
  return $datos;
}
//redirecconar al index despues de  segundos
//header('Refresh: 5; URL=index.php');

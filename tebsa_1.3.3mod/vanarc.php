<?php
/*
* La clase para cualquier tipo de gestión de archivos (nueva carpeta, subir, etc).
*/

/*
*Parte del codigo tomado y modificado de la pagina http://encode-explorer.siineiolekala.net/
*/

class FileManager
{
  function newFolder($location, $dirname)
{
  global $_ERROR;
  global $_LANG;

  if(strlen($dirname) > 0)
  {
    $forbidden = array("", "", "\\");
    for($i = 0; $i < count($forbidden); $i++)
      $dirname = str_replace($forbidden[$i], "", $dirname);
    if(!mkdir($location->getDir(true, false, 0).$dirname, 0777))
      $_ERROR = $_LANG["new_dir_failed"];
    else if(!chmod($location->getDir(true, false, 0).$dirname, 0777))
      $error = $_LANG["chmod_dir_failed"];
  }
}

function uploadFile($location, $userfile)
{

  global $_CONFIG;
  global $_ERROR;
  global $_LANG;
  $tipo_archivo=$_FILES['userfile']['type'];

if ($tipo_archivo == 'application/pdf' && isset($_POST['btnsubir'])){
  echo "<span id='listom'>Entro</span>";
  $name = basename($userfile['name']);
  if(get_magic_quotes_gpc())
    $name = stripslashes($name);

  $upload_dir = $location->getDir(false, true, count($this->location->path) - $i - 1);//Obtiene la ruta del archivo

  $upload_file = $upload_dir . $name;

  if(!is_uploaded_file($userfile['tmp_name']))
  {
    $_ERROR = $_LANG["failed_upload"];
  }
  else if(!@move_uploaded_file($userfile['tmp_name'], $upload_file))
  {
    $_ERROR = $_LANG["failed_move"];
  }

  else

    $almace_archivo=$_FILES['userfile']['size'];
    $nombre_temporal=$_FILES['userfile']['tmp_name'];
    $muebl=$_POST['mueb'];
    $entrep=$_POST['entre'];
    $uniconv=$_POST['uncov'];
    $na=basename($upload_file,'.pdf');

        $ex = mysqli_connect("localhost","root","","tebsa");

            move_uploaded_file($nombre_temporal,$upload_file);

            $insertar_doc="INSERT INTO archivos VALUES ('0', '$na', '$almace_archivo', '$tipo_archivo', '$muebl', '$entrep', '$uniconv', '$upload_file')";
            $re=mysqli_query($ex,$insertar_doc) or die ('nose pudo insertar nada '.mysql_error());

              echo "<span id='listom'>Archivo Guardado</span>";

              header("Location:listadm.php");

              }else {
                 echo "<span id='listom'>El Formato no es Valido(*pdf)</span>";
               }

    }

  //
  // La función principal, comprueba si el usuario desea realizar cualquier operación soportada
  //
  function run($location)
  {
      if(isset($_POST['userdir']) && strlen($_POST['userdir']) > 0)
        $this->newFolder($location, $_POST['userdir']);
      if(isset($_FILES['userfile']['name']) && strlen($_FILES['userfile']['name']) > 0)
        $this->uploadFile($location, $_FILES['userfile']);
  }
}


?>

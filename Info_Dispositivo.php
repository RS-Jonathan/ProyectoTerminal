<?php //Funcion para crear el archivo de host_GNS3
include('Archivos.php');

function recibe_datos(){    
  if(isset($_POST["select"])) {
    $var='select';
    if(!empty($_POST[$var]))
    {
      $var = $_POST[$var];    
    } 
  }
  return $var;
}

$info=[];
$var = recibe_datos();
$info = BuscaInfo($var);

//var_dump($info);
?>

<!DOCTYPE html>
<html>
<head>
  <LINK REL=StyleSheet HREF='CSS/Style.css' TYPE="text/css" MEDIA=screen>
</head>
<body>
  <div  class="boton-centrar"  >
        
        <input type="button" onclick="history.back()" name="volver atrás" value="Volver Atrás" class="boton"> 
    </div>

    <form >
      <form >
       <a class= "table"><table BORDER=500 CELLPADDING=0 CELLSPACING=7 BGCOLOR= #E6E6E6></a>
        <caption><h1>Datos del dispositivo <?php echo $var; ?></h1></caption>
        <tr>
          <th>Nombre de dominio</th>
          <td><?php echo $info['domain'] ?></td>
        </tr>
        <?php  for ($i=0; $i < $info['NumInterface']; $i++) { 

         echo  '<tr ><th colspan="2">Interfaz '.$info['InterfaceName'.$i].'</th></tr>';  
         echo  '<tr><th>IP</th><td >'.strtoupper ($info['InterfaceIp'.$i]).'</td></tr>';
         echo  '<tr><th>Estado</th><td>'.$info['InterfaceState'.$i].'</td></tr>';
         echo  '<tr><th>Tipo de Transmision de datos</th><td>'.$info['InterfaceTtd'.$i].'</td></tr>';
       } ?>
       <tr >
        <th colspan="2">Conectado a los siguientes Dispositivos</th>
      </tr>

      <?php for ($i=1; $i <= $info['NumDevice']; $i++) { 
      echo  '<tr ><th colspan="2">ID: '.$info['DeviceID'.$i].'</th></tr>';

      echo  '<tr><th>IP de conexion</th><td>'.$info['DeviceIP'.$i].'</td></tr>';

      echo  '<tr><th>Platforma:</th><td>'.$info['DevicePlataform'.$i].'</td></tr>';

      echo  '<tr><th>Tipo de Dispositivo:</th><td>'.$info['DeviceTipo'.$i].'</td></tr>';

      echo  '<tr><th>Interfaz local que establece la conexion:</th><td>'.$info['DeviceIntLocal'.$i].'</td></tr>';

      echo  '<tr><th>Interfaz de salida:</th><td>'.$info['DeviceIntOut'.$i].'</td></tr>';

      echo  '<tr><th>Tiempo de respuesta:</th><td>'.$info['DeviceHoldTime'.$i].'</td></tr>';

      echo  '<tr><th>Version de software:</th><td>'.$info['DeviceSw1_'.$i].'<br>'.$info['DeviceSw2_'.$i].'<br>'.$info['DeviceSw3_'.$i].'<br>'.$info['DeviceSw4_'.$i].'</td></tr>';
    }?>

    </table>  
  </form>
</body>
</html>
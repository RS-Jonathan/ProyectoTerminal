<!--Este archivo solicita numero de IPs para establecer coneccion asi como la direccion IP de cada una-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <LINK REL=StyleSheet HREF="CSS/Style.css" TYPE="text/css" MEDIA=screen>
    <title>Document</title>
</head>




<body>
 
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <h1>APLICACION PARA CONFIGURAR LISTAS DE ACCESO</h1>
        <h2>Configuración inicial</h2>
        <p>Coloca el número de dispositivos con conexión ssh</p>
        <input type="number" name="Host" placeholder="Numero de Dispositivos ">
        <?php if(!empty($errores)): ?>
            <div class="error"><?php echo $errores; ?> </div>
        <?php endif; ?>
        <hr/>
        <input type="submit" name="submit" value="Siguiente">
    </form>   
    
    <?php
    $Dispositivos='';
    $i=1;
    
//Isset es una función que permite saber si una variable está declarada y si no es null.
    $errores= '';
    if(isset($_POST['submit'])&& !empty($_POST['Host'])){
	       $Host=$_POST['Host']; // lo que esta sando por el metodo que le enviamos y deb ser igual a los name de los input 
           if (!empty($Host)) {
            $nombre= filter_var($Host, FILTER_SANITIZE_STRING);// deja solamente el nombre 
           //pide ip de host 
            echo '<h2>Datos de Conexión</h2>';
            echo '<p>Introduce la dirección Ip para establecer la conexión SSH</p>';
            for ($i = 1; $i <= $Host; $i++) {
                $nm='ip'.$i;
                $Dispositivos= $Dispositivos.' <input placeholder="X.X.X.X" type="text" name='.$nm.'><br/>';
            }
            
            $n='http://localhost/Proyecto/Muestra_Topologia.php';
            echo '<form action='.$n.' method="POST"> <br>'.$Dispositivos.' <input type="submit" name="subm" value="Obtener Topología" class= "boton">
            </form>';    
            
            echo '<br/><b>*Todos los campos deben ser llenados</b>';
            
        }
        
        
        
    }
    ?>
    
</body>

</html>

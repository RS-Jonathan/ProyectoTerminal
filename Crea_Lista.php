<?php //Funcion para crear el archivo de host_GNS3
include('Archivos.php');


function guardaDispositivos(){    
    $datos[]=[];
    if(isset($_POST["select"])) {
        $var='select';
        $datos[0]= $_POST['tipo']; //datos 0 tipo de lista std /exd  y datos[1] = ip de router  ]
        if(!empty($_POST[$var]))
        {
            $var = $_POST[$var]; 
            $datos[1] = $var;
            PreparaHost($var);   
            return $datos;
        } 
    }
}

$datos = [];
if(isset($_POST["select"])) {
    $datos= guardaDispositivos();
    EscribeNuevaLista($datos);
}
else 
{
 $datos= GetNuevaLista();
}


?>


<!DOCTYPE html>
<html>
<head>
    <LINK REL=StyleSheet HREF='CSS/Style.css' TYPE="text/css" MEDIA=screen>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <h2>Introduce numero de reglas para la lista de acceso</h2>
        <input type="number" name="numRules" placeholder="Numero de Reglas">
        <input type="submit" name="submit" value="Siguiente">
    </form>   
    
    <form action ='http://localhost/Proyecto/NuevaLista.php' method="POST">
        <?php
        if (!strcmp($datos[0],'Standard')){
            $regla='';
            $i=1;
            $ID = ObtenSigIdStandardAccessList($datos[1]);

            echo '<h1>Nueva lista de acceso Standard </h1>';
            echo '<input type="hidden" name="ID" value="'.$ID.'"/>';

            echo '<input type="hidden" name="tipo" value="'.$datos[0].'"/>';
            if(isset($_POST['submit'])&& !empty($_POST['numRules'])){
            $numRules=$_POST['numRules']; // lo que esta sando por el metodo que le enviamos y deb ser igual a los name de los input 
            echo '<input type="hidden" name="numRules" value="'.$numRules.'"/>';
            if (!empty($numRules)) {
            $nombre= filter_var($numRules, FILTER_SANITIZE_STRING);// deja solamente el nombre 
            $n='http://localhost/Proyecto/NuevaLista.php';
            echo '<form action='.$n.' method="POST">';
            ?>
            <a class="table"><table border="1">
                <caption><?php echo '<h2>Datos para la lista de Acceso en '.$datos[1].'</h2>';  echo ' <h2>Access List '.$ID.' </h2>';   ?>
                Aplicar en Interfaz: 
                <select name="Interface">
                    <option value= 'GigabitEthernet1/0'>GigabitEthernet1/0</option>
                    <option value= 'GigabitEthernet2/0'>GigabitEthernet2/0</option>
                    <option value= 'GigabitEthernet3/0'>GigabitEthernet3/0</option>
                    <option selected="selected" value= 'GigabitEthernet4/0'>GigabitEthernet4/0</option>
                    <option value= 'GigabitEthernet5/0'>GigabitEthernet5/0</option>
                    <option value= 'GigabitEthernet6/0'>GigabitEthernet6/0</option>
                </select>
                IN/OUT
                <select name="Interface_port">
                    <option value= 'in'>in</option>
                    <option value= 'out'>out</option>
                </select>
            </caption>
            <tr>
                <th> RULE </th>
                <th>* ACTION</th>
                <th>* ADRESS TO MATCH</th>
                <th>WILDCARD MASK</th>

            </tr>
            <tr>
                <?php  

                for ($i = 1; $i <= $numRules; $i++) {
                $nm='rule'.$i; //identficador en codigo de regla: regla1 regla2 
                //$regla= $regla.' <input placeholder="X.X.X.X" type="text" name='.$nm.'><br/>';
                echo '<th> Rule '.$i.' -> </th>';
                ?>
                <th>
                    <select name=<?php echo "Accion".$nm; ?>>
                        <option value= 'permit'>permit</option>
                        <option value= 'deny'>deny</option>
                    </select>
                </th>


                <?php 
                echo '<th> <input placeholder="ANY" type="text" name=Direccion'.$nm.'></th>';
                echo '<th> <input placeholder="X.X.X.X" type="text" name=WildCard'.$nm.'><br></th>';

                ?>
            </tr>
            <?php  
        }  

       // echo '<a class="CreaLista"><input type="submit" name="subm" value="Crear lista">';  
       // echo '<a class="Warning"><b>*Todos los campos deben ser llenados</b>';
       // echo '<a class="CreaLista" href="https://sensacionweb.com/">Mi Botón</a>';
    }



}
}

else {
   $regla='';
   $i=1;
   $ID = ObtenSigIdExtendedAccessList($datos[1]);

   echo '<h1>Nueva lista de acceso Extended </h1>';
   echo '<input type="hidden" name="ID" value="'.$ID.'"/>';

   echo '<input type="hidden" name="tipo" value="'.$datos[0].'"/>';
   if(isset($_POST['submit'])&& !empty($_POST['numRules'])){
            $numRules=$_POST['numRules']; // lo que esta sando por el metodo que le enviamos y deb ser igual a los name de los input 
            echo '<input type="hidden" name="numRules" value="'.$numRules.'"/>';
            if (!empty($numRules)) {
            $nombre= filter_var($numRules, FILTER_SANITIZE_STRING);// deja solamente el nombre 
            $n='http://localhost/Proyecto/NuevaLista.php';
            echo '<form action='.$n.' method="POST">';
            ?>
            <a class="table"><table border="1">
                <caption><?php echo '<h2>Datos para la lista de Acceso en '.$datos[1].'</h2>';  echo ' <h2>Access List '.$ID.' </h2>';   ?>
                Aplicar en Interfaz: 
                <select name="Interface">
                    <option value= 'GigabitEthernet1/0'>GigabitEthernet1/0</option>
                    <option value= 'GigabitEthernet2/0'>GigabitEthernet2/0</option>
                    <option value= 'GigabitEthernet3/0'>GigabitEthernet3/0</option>
                    <option selected="selected" value= 'GigabitEthernet4/0'>GigabitEthernet4/0</option>
                    <option value= 'GigabitEthernet5/0'>GigabitEthernet5/0</option>
                    <option value= 'GigabitEthernet6/0'>GigabitEthernet6/0</option>
                </select>
                IN/OUT
                <select name="Interface_port">
                    <option value= 'in'>in</option>
                    <option value= 'out'>out</option>
                </select>
                <?php echo '<br>Los puertos solo son permitidos para los protocolos TCP y UDP'; ?>
            </caption>
            <tr>
                <th> Rule </th>
                <th>* Action</th>
                <th>* Protocol</th>
                <th>* Source</th>
                <th> Match Port </th>
                <th> Port Number </th>
                 <th>* Destination</th>
                 <th> Match Port</th>
                 <th> Port Number </th>


            </tr>
            <tr>
                <?php  

                for ($i = 1; $i <= $numRules; $i++) {
                    $nm='rule'.$i; 
                    echo '<th> Rule '.$i.' -> </th>';
                    ?>
                    <th>
                        <select class = "Accion" name=<?php echo "Accion".$nm ?>>
                            <option value= 'permit'>permit</option>
                            <option value= 'deny'>deny</option>
                        </select>
                    </th>

                    <th>
                        <select name=<?php echo "Protocolo".$nm; ?>>
                            <option value= 'ahp'>ahp</option>
                            <option value= 'eigrp'>eigrp</option>
                            <option value= 'esp'>esp</option>
                            <option value= 'gre'>gre</option>
                            <option value= 'icmp'>icmp</option>
                            <option selected="select" value= 'ip'>ip</option>
                            <option value= 'igmp'>igmp</option>
                            <option value= 'ipinip'>ipinip</option>
                            <option value= 'nos'>nos</option>
                            <option value= 'ospf'>ospf</option>
                            <option value= 'pcp'>pcp</option>
                            <option value= 'pim'>pim</option>
                            <option value= 'sctp'>sctp</option>
                            <option value= 'tcp'>tcp</option>
                            <option value= 'udp'>udp</option>
                        </select>
                    </th>

                    <?php 
                    echo '<th> Host : <input placeholder="X.X.X.X" value="" type="text" name=OrigenHost'.$nm.'><br>';
                    echo ' RED : <input placeholder="ANY" value="" type="text" name=Origen'.$nm.'><br>';
                    echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Origen_Wild'.$nm.'><br></th>';
                    ?>

                    <th>
                        <select name=<?php echo "Tipo_Comp_Puerto".$nm; ?>>
                            <option selected="selected" value= 0>Elige</option>
                            <option value= 'eq'>equals</option>
                            <option value= 'neq'>not equals</option>
                            <option value= 'lt'>lower than</option>
                            <option value= 'gt'>greater than</option>
                        </select>
                    </th>

                    <?php 

                    echo '<th> <input placeholder="Port" type="number" name=PuertoNum'.$nm.'><br></th>';

                    ?>
                    <?php 

                    echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
                    echo ' RED : <input placeholder="ANY" value="" type="text" name= Dst'.$nm.'><br>';
                    echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';
                    ?>

                    <th>
                        <select name=<?php echo "Tipo_Comp_Puerto2".$nm; ?>>
                            <option selected="selected" value= '0'>Elige</option>
                            <option value= 'eq'>equals</option>
                            <option value= 'neq'>not equals</option>
                            <option value= 'lt'>lower than</option>
                            <option value= 'gt'>greater than</option>
                        </select>
                    </th>

                    <?php 

                    echo '<th> <input placeholder="Port" type="number" name=PuertoNum2'.$nm.'><br></th>';

                    ?>
                </tr>
                <?php  
            }  

          //  echo '<a class="CreaLista"><input type="submit" name="subm" value="Crear lista">';  
            //echo '<a class="Warning"><b>*Todos los campos deben ser llenados</b>';
       // echo '<a class="CreaLista" href="https://sensacionweb.com/">Mi Botón</a>';
        }



    }
}
?>
</table>
<div  class="boton-centrar"  >
        
        <input type="submit" name="subm" value="Crear lista" class="boton-azul">
        
    </div>
</form>
<div  class="boton-centrar"  >
        
        <input type="button" onclick="history.back()" name="volver atrás" value="Volver Atrás" class="boton"> 
        
    </div>

</body>
</html>
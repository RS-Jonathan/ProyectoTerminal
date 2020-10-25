<?php //Funcion para crear el archivo de host_GNS3
include('Archivos.php');
function getdata(){    
    if(isset($_POST["select"])) {
        $i=1;
        $var='select';     
        if(!empty($_POST[$var]))
        {
            $var = $_POST[$var];    
        } 
    }   
    return $var;
}

$var =getdata();
$AccessList=BuscaListasAcceso($var);

$ExtendedAccessList = $AccessList[0];
$StandardAccessList = $AccessList[1];
$AppliedAccessList =  $AccessList[2];

$contador = 0;
$contador2 = 0;
$i=1;
$j=1;
while(array_key_exists('ID'.$i,$StandardAccessList)){
    if(strpos($StandardAccessList['ID'.$i],'access list'))
        $contador++;
    $i++;
}
$i=1;
while(array_key_exists('ID'.$i,$ExtendedAccessList)){
    if(strpos($ExtendedAccessList['ID'.$i],'access list'))
        $contador2++;
    $i++;
}

PreparaHost($var); //funcion para crear archivo de conexion con un solo host


?>


<!DOCTYPE html>
<html>
<head>
    <LINK REL=StyleSheet HREF='CSS/Style.css' TYPE="text/css" MEDIA=screen>
</head>
<body>
    <form >
        <a class="table"><table border="1">
            <caption><?php echo ' <h1>Listas de acceso Standard actuales en '. $var.' </h1>'; ?></caption>
            <tr>
                <th>ID</th>
                <th>INTERFACE</th>
                <th>ID | RULES</th>
            </tr>
            <?php 
            
            for ($i=1; $i <= $contador; $i++) 
            {    
                ?>
                <tr>
                    <td>
                        <?php   
                    $l = explode(" ",$StandardAccessList['ID'.$i]);   //coloca id de lista de acceso en tabla        
                    echo $l[4];
                    ?>
                </td>

                <td>
                    <?php   

                    if(in_array(trim($l[4]),$AppliedAccessList)){
                        $k=1;
                        while (array_key_exists('ID'.$k, $AppliedAccessList)){
                            if($AppliedAccessList['ID'.$k]==trim($l[4]))
                            echo strtoupper($AppliedAccessList['TYPE'.$k]).'-'.$AppliedAccessList['Interface'.$k].'<br>';
                            $k++;
                        }
                    }
                    else
                       echo 'NO APLICADA';
                   ?>
               </td>

               <td>

                <?php 
                $j= 1;
                while (array_key_exists('Rule'.$j.'_Acl_'.$i,$StandardAccessList))
                {
                    echo strtoupper($StandardAccessList['Rule'.$j.'_Acl_'.$i].'<br>');
                    $j++;
                }

                ?>

            </td>
        </tr>
        <?php 
    } 

    ?>

</table>
</form>

<form >
    <a class="table"><table border="1">
        <caption><?php echo ' <h1>Listas de acceso Extended actuales en '. $var.' </h1>'; ?></caption>
        <tr>
            <th>ID</th>
            <th>INTERFACE</th>
            <th>ID | RULES</th>
        </tr>
        <tr>
        </tr>

        <?php 

        for ($i=1; $i <= $contador2; $i++) 
        {    
            ?>
            <tr>
                <td>
                    <?php   
                    $l = explode(" ",$ExtendedAccessList['ID'.$i]);   //coloca id de lista de acceso en tabla        
                    echo $l[4];
                    ?>
                </td>

                <td>
                    <?php   

                     if(in_array(trim($l[4]),$AppliedAccessList)){
                        $k=1;
                        while (array_key_exists('ID'.$k, $AppliedAccessList)){
                            if($AppliedAccessList['ID'.$k]==trim($l[4]))
                            echo strtoupper($AppliedAccessList['TYPE'.$k]).'-'.$AppliedAccessList['Interface'.$k].'<br>';
                            $k++;
                        }
                    }

                    else
                       echo 'NO APLICADA';
                   ?>
               </td>
               <td>

                <?php 
                $j= 1;
                while (array_key_exists('Rule'.$j.'_Acl_'.$i,$ExtendedAccessList))
                {
                    echo strtoupper($ExtendedAccessList['Rule'.$j.'_Acl_'.$i].'<br>');
                    $j++;
                }

                ?>

            </td>
        </tr>
        <?php 
    } 

    ?>
</table>
</form>


<form action= 'http://localhost/Proyecto/BorraLista.php' method="POST">   
    <h2>Eliminar lista de acceso:</h2>
    <p></p>
     <?php   echo 'ID AccessList' ?>
    <select name="ID_AccessList">
        <?php 
        if($contador>0 || $contador2 >0){
            for ($i=1; $i <= $contador; $i++) { 
                $l = explode(" ",$StandardAccessList['ID'.$i]);   
                ?>
                <option value="<?php  echo $l[4];?>"> <?php echo $l[4];?> </option>
                <?php
            }
            ?> 
            <?php 
            for ($i=1; $i <= $contador2; $i++) { 
                $l = explode(" ",$ExtendedAccessList['ID'.$i]);   
                ?>
                <option value="<?php  echo $l[4];?>"> <?php echo $l[4];?> </option>
                <?php
            }
        }
        ?> 
    </select>
  <?php   echo 'ID RULE' ?>

<input type="number" name="rule" placeholder="Todo"  min="0" >
    <input name="Ejecutar" type="submit" value="Eliminar" >
</form> 


<form action= 'http://localhost/Proyecto/Edita_Lista_Std_Ext.php' method="POST">   
    <h2>Editar lista de acceso :</h2>
    <p></p>
     <?php   echo 'ID AccessList' ?>
    <select name="ID_AccessList">
        <?php 
        if($contador>0 || $contador2 >0){
            for ($i=1; $i <= $contador; $i++) { 
                $l = explode(" ",$StandardAccessList['ID'.$i]);   
                ?>
                <option value="<?php  echo $l[4];?>"> <?php echo $l[4];?> </option>
                <?php
            }
            ?> 
            <?php 
            for ($i=1; $i <= $contador2; $i++) { 
                $l = explode(" ",$ExtendedAccessList['ID'.$i]);   
                ?>
                <option value="<?php  echo $l[4];?>"> <?php echo $l[4];?> </option>
                <?php
            }
        }
        ?> 
    </select>
  <?php   echo 'ID RULE' ?>
    <input name="Ejecutar" type="submit" value="Siguiente" >
</form> 


<div  class="boton-centrar"  >
        
        <input type="button" onclick="history.back()" name="volver atrás" value="Volver Atrás" class="boton"> 
        
    </div>

<!--
<a class="boton_personalizado"><input type="button" onclick="history.back()" name="volver atrás" value="volver atrás">
-->
</body>
</html>

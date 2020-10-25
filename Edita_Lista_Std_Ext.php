<?php 
include('Archivos.php');
include('SeleccionFormEditar.php');
function recibeListaParaEditar(){    
	if(isset($_POST["ID_AccessList"])) {
		$ID=' ';
		if(!empty($_POST["ID_AccessList"]))
		{
			$ID = $_POST["ID_AccessList"];    
		} 

	}
	$rule = '';
	$regreso = array($ID , $rule );

	return $regreso;
}

function getRouter()
{
	$ruta = "/opt/lampp/htdocs/Proyecto/host_GNS3";
	$file = fopen($ruta,'r');
	while(! feof($file)) {

		$line = fgets($file);
		
		if (strpos($line,'ansible_host'))
		{
			$porciones = explode(" ", $line);

			return $porciones[0];	
		}
	}
}


function Edita($lista)
{
	$IDlista=trim($lista);

	$AccessList=BuscaListasAcceso(getRouter());

	$ExtendedAccessList = $AccessList[0];
	$StandardAccessList = $AccessList[1];
	$AppliedAccessList =  $AccessList[2];
	$datos = [];
	$countDatos=0;
	$contador = 0;
	$contador2 = 0;
	$i=1;
	$j=1;
	$rule = '';


	while(array_key_exists('ID'.$i,$StandardAccessList)){

		if(strpos($StandardAccessList['ID'.$i],'access list')){

			$temp = explode(' ', $StandardAccessList['ID'.$i]);
			$temp[4] = trim($temp[4]);
			$rule = 'no access-list '.$temp[4];
			

			if(array_key_exists('Rule1_Acl_'.$i,$StandardAccessList) && $temp[4] == $IDlista){
				
				$temp = explode(' ', $StandardAccessList['Rule1_Acl_'.$i]);
				$k= 5;
				while (array_key_exists($k,$temp)){

					$rule = $rule.' '.$temp[$k];
					$k++;
				} 
				
				$w=1;



				while (array_key_exists('Rule'.$w.'_Acl_'.$i,$StandardAccessList)){
					$temp = explode(' ', $StandardAccessList['ID'.$i]);
					$temp[4] = trim($temp[4]);
					$rule = 'access-list '.$temp[4];
					$temp = explode(' ', $StandardAccessList['Rule'.$w.'_Acl_'.$i]);
					$k= 5;
					while (array_key_exists($k,$temp)){
						$rule = $rule.' '.$temp[$k];
						$k++;
					} 
					$datos[$countDatos] = $rule;
					$countDatos++;
					$w++;
				} 

				$datos['numReglas']= $w-1;

				$temp = explode(' ', $StandardAccessList['ID'.$i]);

				if(in_array(trim($temp[4]),$AppliedAccessList)){

					$k=1;
					while (array_key_exists('ID'.$k, $AppliedAccessList)){
						if($AppliedAccessList['ID'.$k]==trim($temp[4]) ){
							$datos[$countDatos] = 'int '.$AppliedAccessList['Interface'.$k];
							$countDatos++;
							$datos[$countDatos] = 'ip access-group '.$IDlista.' '.$AppliedAccessList['TYPE'.$k];
							$countDatos++;
						}
						$k++;
					}
				}

				

			}
			
			$contador++;
		}
		$i++;
	}

	$i=1;


	while(array_key_exists('ID'.$i,$ExtendedAccessList)){
		if(strpos($ExtendedAccessList['ID'.$i],'access list')){
			$temp = explode(' ', $ExtendedAccessList['ID'.$i]);
			$temp[4] = trim($temp[4]);
			$rule = 'no access-list '.$temp[4]; 
			
			if(array_key_exists('Rule1_Acl_'.$i,$ExtendedAccessList) && $temp[4] == $IDlista){

				$temp = explode(' ', $ExtendedAccessList['Rule1_Acl_'.$i]);
				$k= 5;
				while (array_key_exists($k,$temp)){

					$rule = $rule.' '.$temp[$k];
					$k++;
				} 

				$w=1;

				while (array_key_exists('Rule'.$w.'_Acl_'.$i,$ExtendedAccessList)){
					$temp = explode(' ', $ExtendedAccessList['ID'.$i]);
					$temp[4] = trim($temp[4]);
					$rule = 'access-list '.$temp[4];
					$temp = explode(' ', $ExtendedAccessList['Rule'.$w.'_Acl_'.$i]);
					$k= 5;
					while (array_key_exists($k,$temp)){
						$rule = $rule.' '.$temp[$k];
						$k++;
					} 

					$datos[$countDatos] = $rule;
					$countDatos++;
					$w++;
				} 
				$datos['numReglas']= $w-1;


				$temp = explode(' ', $ExtendedAccessList['ID'.$i]);

				if(in_array(trim($temp[4]),$AppliedAccessList)){

					$k=1;
					while (array_key_exists('ID'.$k, $AppliedAccessList)){
						if($AppliedAccessList['ID'.$k]==trim($temp[4])){
							$datos[$countDatos] = 'int '.$AppliedAccessList['Interface'.$k];
							$countDatos++;
							$datos[$countDatos] = 'ip access-group '.$IDlista.' '.$AppliedAccessList['TYPE'.$k];
							$countDatos++;

						}
						$k++;
					}
				}


			}
			$contador2++;
		}
		$i++;
	}

	return $datos;

}

/////////////////////////////////////////////


$datos = recibeListaParaEditar();
//echo $datos[0];   Este muestra el id de la lista de acceso .. 100<Extendida y 100>Standard
$reglas = Edita($datos[0]);
//var_dump($reglas);
?>



<!DOCTYPE html>
<html>
<head>
	<LINK REL=StyleSheet HREF='CSS/Style.css' TYPE="text/css" MEDIA=screen>
</head>
<body>
	<form action ='http://localhost/Proyecto/GuardaDatos_EditaLista.php' method="POST">
		<?php
		if ($datos[0]<100){
			$regla='';
			$i=1;
			$ID = $datos[0];
			echo '<input type="hidden" name="ID" value="'.$ID.'"/>';
			echo '<input type="hidden" name="ID_AccessList" value="'.$ID.'"/>';

			echo '<input type="hidden" name="tipo" value="Standard"/>';

			$numRules=$reglas['numReglas']; 
			echo '<input type="hidden" name="numRules" value="'.$numRules.'"/>';
			if (!empty($numRules)) {
            $nombre= filter_var($numRules, FILTER_SANITIZE_STRING);// deja solamente el nombre 
            $n='http://localhost/Proyecto/NuevaLista.php';
            echo '<form action='.$n.' method="POST">';
            ?>
            <a class="table"><table border="1">
            	<caption><?php echo '<h2>Edite los cambios correspondientes a la Access List '.$ID.' en '.getRouter().'</h2>'; ?>
            	Aplicar en Interfaz: 
            	<select name="Interface">
            		<?php SeleccionInterfaceEditarStd($reglas);   ?>
            	</select>
            	IN/OUT
            	<select name="Interface_port">
            		<?php SeleccionInterfaceFlujoEditarStd($reglas);   ?>
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

            	for ($i = 0; $i < $numRules; $i++) {
                $nm='rule'.$i; //identficador en codigo de regla: regla1 regla2 
                $x=$i+1;
                echo '<th> Rule '.$x.' -> </th>';
                ?>
                <th>
                	<select name=<?php echo "Accion".$nm; ?>>
                		<?php 
                		if (strpos($reglas[$i], 'permit') !== false)
                		{
                			echo "<option value= 'permit'>permit</option>";
                			echo "<option value= 'deny'>deny</option>";
                		}

                		else {
                			echo "<option value= 'deny'>deny</option>";
                			echo "<option value= 'permit'>permit</option>";
                		}

                		?>

                	</select>
                </th>


                <?php 
                $array = explode(" ", $reglas[$i]);
                $array = array_filter($array); //funcion para eliminar elementos nulos en este caso espacios en blanco de mas 
                

                if(count($array)==5 && array_key_exists(3,$array) && array_key_exists(4,$array)){
                	echo '<th> <input value='.$array[3].' type="text" name=Direccion'.$nm.'></th>'; 
                	echo '<th> <input value='.$array[4].' type="text" name=WildCard'.$nm.'><br></th>';
                }
                else if(count($array)==4 && array_key_exists(3,$array)){
                	echo '<th> <input value='.$array[3].' type="text" name=Direccion'.$nm.'></th>'; 
                	echo '<th> <input placeholder="X.X.X.X" type="text" name=WildCard'.$nm.'><br></th>';
                }

                else if(count($array)==5 && array_key_exists(5,$array) && array_key_exists(6,$array)){
                	echo '<th> <input value='.$array[5].' type="text" name=Direccion'.$nm.'></th>'; 
                	echo '<th> <input value='.$array[6].' type="text" name=WildCard'.$nm.'><br></th>';
                }

                else if(count($array)==4 && array_key_exists(5,$array)){
                	echo '<th> <input value='.$array[5].' type="text" name=Direccion'.$nm.'></th>'; 
                	echo '<th> <input placeholder="X.X.X.X" type="text" name=WildCard'.$nm.'><br></th>';
                }
                ?>
            </tr>
            <?php  
        }  

     //   echo '<a class="CreaLista"><input type="submit" name="subm" value="Guardar Cambios">';  
      //  echo '<a class="Warning"><b>*Todos los campos deben ser llenados</b>';

    }

}


else if($datos[0]>100){
	$regla='';
	$i=1;
	$ID = $datos[0];
	echo '<input type="hidden" name="ID" value="'.$ID.'"/>';
	echo '<input type="hidden" name="ID_AccessList" value="'.$ID.'"/>';
	echo '<input type="hidden" name="tipo" value="Extended"/>';

	$numRules=$reglas['numReglas']; 
	echo '<input type="hidden" name="numRules" value="'.$numRules.'"/>';
	if (!empty($numRules)) {
            $nombre= filter_var($numRules, FILTER_SANITIZE_STRING);// deja solamente el nombre 
            $n='http://localhost/Proyecto/NuevaLista.php';
            echo '<form action='.$n.' method="POST">';
            ?>
            <a class="table"><table border="1">
            	<caption><?php echo '<h2>Edite los cambios correspondientes a la Access List '.$ID.' en '.getRouter().'</h2>'; ?>
            	Aplicar en Interfaz: 
            	<select name="Interface">
            		<?php SeleccionInterfaceEditarStd($reglas);   ?>
            	</select>
            	IN/OUT
            	<select name="Interface_port">
            		<?php SeleccionInterfaceFlujoEditarStd($reglas);   ?>
            	</select>
            	<?php echo '<br>Los puertos solo son permitidos para los protocolos TCP y UDP';
            	 echo '<br>Las modificaciones de Puerto se expresan en Numero de Puerto'; ?>
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

            	for ($i = 0; $i < $numRules; $i++) {
            		$array = explode(" ", $reglas[$i]);
            		$array = array_filter($array);
            		/*var_dump($array); //imprimiendo reglas a editar
            		echo '<br>';
            		echo '<br>';
*/

            		$nm='rule'.$i; 
            		$x=$i+1;
            		echo '<th> Rule '.$x.' -> </th>';
            		?>
            		<th>
            			<select class = "Accion" name=<?php echo "Accion".$nm ?>>
            				<?php 
            				if (strpos($reglas[$i], 'permit') !== false)
            				{
            					echo "<option value= 'permit'>permit</option>";
            					echo "<option value= 'deny'>deny</option>";
            				}

            				else {
            					echo "<option value= 'deny'>deny</option>";
            					echo "<option value= 'permit'>permit</option>";
            				}
            				?>
            			</select>
            		</th>

            		<th>
            			<select name=<?php echo "Protocolo".$nm; ?>>
            				<?php SeleccionProtocolo($array); ?>
            			</select>
            		</th>

            		<?php OrigenExtended($array,$nm); ?>

            		<th>
            			<select name=<?php echo "Tipo_Comp_Puerto".$nm; ?>>
            				<?php OrigenExtendedPort($array); ?>
            			</select>
            		</th>

            		
            		 <?php OrigenExtendedPortNum($array,$nm); ?> 
            		 <?php DstExtended($array,$nm); ?> 
            		

            		<th>
            			<select name=<?php echo "Tipo_Comp_Puerto2".$nm; ?>>
            				<?php DstExtendedPort($array,$nm); 	?>
            			</select>
            		</th> 
            		<?php DstExtendedPortNum($array,$nm); 	?> 

            	</tr>
            	<?php  
            }  
    //    echo '<a class="CreaLista"><input type="submit" name="subm" value="Guardar Cambios">';  
     //   echo '<a class="Warning"><b>*Todos los campos deben ser llenados</b>';

        }




    }

    ?>
</table>
<div  class="boton-centrar"  >
	<input type="submit" name="subm" value="Guardar Cambios" class= "boton">
</div>

</form>
<div  class="boton-centrar"  >
        
        <input type="button" onclick="history.back()" name="volver atrás" value="Volver Atrás" class="boton"> 
        
    </div>
</body>
</html>



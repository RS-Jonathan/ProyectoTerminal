<?php 
include('Archivos.php');
function recibeListaParaBorrar(){    
	if(isset($_POST["ID_AccessList"])) {
		$ID=' ';
		if(!empty($_POST["ID_AccessList"]))
		{
			$ID = $_POST["ID_AccessList"];    
		} 

	}
	if(isset($_POST["rule"])) {
		$rule = '';
		if(!empty($_POST['rule']))
		{
			$rule = $_POST['rule'];    
		} 
		else 
			$rule = '0';
	}
	$regreso = array($ID , $rule );
 //var_dump($regreso);
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



function CreaTarea_Ansible($datos)
{
	$ruta = "/opt/lampp/htdocs/Proyecto/BorraAccessList.yml";
	$file = fopen($ruta,'w');

	fwrite($file, '##Borra Lista de acceso' . PHP_EOL);
	fwrite($file, '---'.PHP_EOL);
	fwrite($file, PHP_EOL);
	fwrite($file, '- name: Erasing access-list' . PHP_EOL);
	fwrite($file, '  hosts: ROUTERS'.PHP_EOL);
	fwrite($file, '  gather_facts: false'.PHP_EOL);
	fwrite($file, '  connection: local' . PHP_EOL);
	fwrite($file, PHP_EOL);
	fwrite($file, '  tasks:'.PHP_EOL);
	fwrite($file, '    - name: Erasing access-list' . PHP_EOL);
	fwrite($file, '      ios_config:'.PHP_EOL);
	fwrite($file, '        lines:'.PHP_EOL);



	for ($i=0; $i < count($datos); $i++) { 
		fwrite($file, '          - '.$datos[$i].PHP_EOL);
	}	


	fclose($file); 
}


function BorraTodo($IDlista)
{ 
	//echo $IDlista;
	$IDlista=trim($IDlista);

	$AccessList=BuscaListasAcceso(getRouter());

	$ExtendedAccessList = $AccessList[0];
	$StandardAccessList = $AccessList[1];
	$AppliedAccessList =  $AccessList[2];
	$datos = [];
	$countDatos =0;
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
				$datos[$countDatos] = $rule;
				$countDatos++;

				$temp = explode(' ', $StandardAccessList['ID'.$i]);

				if(in_array(trim($temp[4]),$AppliedAccessList)){

					$k=1;
					while (array_key_exists('ID'.$k, $AppliedAccessList)){
						if($AppliedAccessList['ID'.$k]==trim($temp[4])){

							$datos[$countDatos] = 'int '.$AppliedAccessList['Interface'.$k];
							$countDatos++;
							$datos[$countDatos] = 'no ip access-group '.$IDlista.' '.$AppliedAccessList['TYPE'.$k];
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

				$datos[$countDatos] = $rule;
				$countDatos++;
				$temp = explode(' ', $ExtendedAccessList['ID'.$i]);

				if(in_array(trim($temp[4]),$AppliedAccessList)){

					$k=1;
					while (array_key_exists('ID'.$k, $AppliedAccessList)){
						if($AppliedAccessList['ID'.$k]==trim($temp[4])){

							$datos[$countDatos] = 'int '.$AppliedAccessList['Interface'.$k];
							$countDatos++;
							$datos[$countDatos] = 'no ip access-group '.$IDlista.' '.$AppliedAccessList['TYPE'.$k];
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



function BorraRegla($lista,$regla)
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


					if(strpos($StandardAccessList['Rule'.$w.'_Acl_'.$i],$regla )==0)
					{
						$datos[$countDatos] = $rule;
						$countDatos++;
						
					}
					$w++;
				} 

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


					if(strpos($ExtendedAccessList['Rule'.$w.'_Acl_'.$i],$regla )==0)
					{
						$datos[$countDatos] = $rule;
						$countDatos++;
						
					}
					$w++;
				} 



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






$datos = recibeListaParaBorrar();
if(count($datos)!=0 && $datos[1] == 0){
	CreaTarea_Ansible(BorraTodo($datos[0]));
}
else 
{
	
CreaTarea_Ansible(BorraTodo($datos[0]));
$comando= 'ansible-playbook -i host_GNS3 BorraAccessList.yml';
	$return = [];
	$salida = exec($comando,$return);
CreaTarea_Ansible(BorraRegla($datos[0],$datos[1]));
}

$comando= 'ansible-playbook -i host_GNS3 BorraAccessList.yml';
	$return = [];
	$salida = exec($comando,$return);

?>

<!DOCTYPE html>
<html>
<head>
	<LINK REL=StyleSheet HREF='CSS/Style.css' TYPE="text/css" MEDIA=screen>
</head>
<body>
<h1> Eliminación Exitosa</h1>
<a class="boton_Recarga" href="javascript:window.history.go(-3);">Aceptar</a>
</body>
</html>


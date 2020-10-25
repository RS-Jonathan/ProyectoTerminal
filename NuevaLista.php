<?php 

function CreaTarea_Ansible($datos)
{
	$ruta = "/opt/lampp/htdocs/Proyecto/CreaLista.yml";
	$file = fopen($ruta,'a');

	fwrite($file, '##Crea Lista de acceso' . PHP_EOL);
	fwrite($file, '---'.PHP_EOL);
	fwrite($file, PHP_EOL);
	fwrite($file, '- name: Creating AccessList' . PHP_EOL);
	fwrite($file, '  hosts: ROUTERS'.PHP_EOL);
	fwrite($file, '  gather_facts: false'.PHP_EOL);
	fwrite($file, '  connection: local' . PHP_EOL);
	fwrite($file, PHP_EOL);
	fwrite($file, '  tasks:'.PHP_EOL);
	fwrite($file, '    - name: Creating access-list' . PHP_EOL);
	fwrite($file, '      ios_config:'.PHP_EOL);
	fwrite($file, '        lines:'.PHP_EOL);

	for ($i=0; $i < count($datos); $i++) { 
		fwrite($file, '          - '.$datos[$i].PHP_EOL);
	}	

	fclose($file); 
}



function EnviaListaStandard(){    
	$i=1;
	$datos =[];
	$countDatos=0;
	if(isset($_POST["ID"])) {

		$IdAccessList=$_POST["ID"];
		$numRules= $_POST["numRules"];
		$interface=$_POST["Interface"];
		$interface_port=$_POST["Interface_port"];

		for ($i=1; $i <= $numRules; $i++) { 
			$Accion=$_POST['Accionrule'.$i];
			$Direccion=$_POST['Direccionrule'.$i];
			$Wildcard=$_POST['WildCardrule'.$i];

			if(empty($_POST["Direccionrule".$i]) && !empty($_POST['WildCardrule'.$i])){
				echo 'Faltan Datos en la regla '.$i.' Imposible completar acción';
				return false;
			}
			else if(empty($_POST['Direccionrule'.$i])){
				$Direccion='any';
				$Wildcard='';
			}

			$datos[$countDatos] ='access-list '.trim($IdAccessList).' '.trim($Accion).' '.trim($Direccion).' '.trim($Wildcard);
			$countDatos++;

		}

		$datos[$countDatos] = 'int '.trim($interface);
		$countDatos++;
		$datos[$countDatos]= 'ip access-group '.trim($IdAccessList).' '.trim($interface_port);
		$countDatos++;


		CreaTarea_Ansible($datos);

		$comando= 'ansible-playbook -i host_GNS3 CreaLista.yml';
		$return = [];
		$salida = exec($comando,$return);

		echo '<h1> Lista Creada Exitosamente</h1>';
		echo '<a class="boton_Recarga" href="javascript:window.history.go(-4);">Aceptar</a>';

	}

}


function EnviaListaExtended(){   
	$i=1;
	$datos =[];
	$countDatos=0;
	if(isset($_POST["ID"])) {

		echo '<br>';
		$IdAccessList=$_POST["ID"];
		$numRules= $_POST["numRules"];
		$Interface=$_POST["Interface"];
		$Interface_port=$_POST["Interface_port"];

		for ($i=1; $i <=$numRules; $i++) { 
			$Accion     = $_POST['Accionrule'.$i];    //Permit-Deny 
			$Protocol   = $_POST['Protocolorule'.$i];  
			$IpSource   = $_POST['Origenrule'.$i];	
			$WildSource = $_POST['Origen_Wildrule'.$i];
			$MatchPort  = $_POST['Tipo_Comp_Puertorule'.$i];
			$Port       = $_POST['PuertoNumrule'.$i];
			$IpSource2   = $_POST['Dstrule'.$i];
			$WildSource2 = $_POST['Destino_Wildrule'.$i];
			$MatchPort2  = $_POST['Tipo_Comp_Puerto2rule'.$i];
			$Port2       = $_POST['PuertoNum2rule'.$i];

			//Primero se verifican errores
			
//Error si el destino es un host y una red al mismo tiempo
			if((!empty($_POST["Dstrule".$i]) && !empty($_POST["DstHostrule".$i]))) 
			{
				echo 'Error en la regla '.$i.' el destino debe ser un Host o Una red';
				return false;
			}
//Error si el Origen es un host y una red al mismo tiempo
		    if((!empty($_POST["Origenrule".$i]) && !empty($_POST["OrigenHostrule".$i]))) 
			{
				echo 'Error en la regla '.$i.' la fuente debe ser un Host o Una red ';
				return false;
			}

//Error si No hay IP de red pero si Wildcard en el Origen
		   if(empty($_POST["Origenrule".$i]) && !empty($_POST["Origen_Wildrule".$i]))
			{
				echo 'Error falta Ip Fuente en la regla '.$i;
				return false;
			}
//Error si No hay IP de red pero si Wildcard en el destino
		   if(empty($_POST["Dstrule".$i]) && !empty($_POST["Destino_Wildrule".$i]))
			{
				echo 'Error falta Ip Destino en la regla '.$i;
				return false;
			}
//Error si En el destino o fuente se coloca un puerto para cualquier protocolo distinto de tcp o udp 
		   if(( !($Protocol == 'tcp' || $Protocol == 'udp')) &&  !empty($_POST["PuertoNumrule".$i]) || ( !($Protocol == 'tcp' || $Protocol == 'udp')) &&  !empty($_POST["PuertoNum2rule".$i]))
			{
				echo 'Los puertos no estan permitidos para protocolos distintos de TCP o UDP en la regla '.$i;
				return false;
			}
//Error si se coloca tipo de match con puerto pero no el numero de este
		   if( (!strcmp($MatchPort, '0') != 1 &&  empty($_POST["PuertoNumrule".$i]))   || (!strcmp($MatchPort2, '0') != 1 &&  empty($_POST["PuertoNum2rule".$i])))
			{
				echo '1 Falto especificar número de puerto en la regla '.$i;
				return false;
			}
//Error si se coloca el puerto pero no el tipo de match de este
		   if( (!strcmp($MatchPort, '0') == 1 &&  !empty($_POST["PuertoNumrule".$i]))   || (!strcmp($MatchPort2, '0') == 1 &&  !empty($_POST["PuertoNum2rule".$i])))
			{
				echo 'Falto especificar tipo de Match con el número de puerto en la regla '.$i;
				return false;
			}

//Error si se coloca id de red fuente pero no la wildcard 
		   if(!empty($_POST["Origenrule".$i]) && empty($_POST["Origen_Wildrule".$i]))
			{
				echo 'Falto añadir WildCard la IP Fuente en la regla '.$i;
				return false;
			}
//Error si se coloca id de red Destino pero no la wildcard 
		    if(!empty($_POST["Dstrule".$i]) && empty($_POST["Destino_Wildrule".$i]))
			{
				echo 'Falto añadir WildCard la IP Destino en la regla '.$i;
				return false;
			}
//Inicia la creacion de las reglas
/*
no red origen 
no red destino
no host origen
no host destino
no puerto origen-destino
no numero puerto origen-destino 
*/
			if(empty($_POST["Origenrule".$i]) && empty($_POST["Dstrule".$i])  && empty($_POST["DstHostrule".$i]) && empty($_POST["OrigenHostrule".$i]) && empty($_POST["PuertoNum2rule".$i]) && empty($_POST["PuertoNumrule".$i]) && empty($_POST['Tipo_Comp_Puerto2rule'.$i]) && empty($_POST['Tipo_Comp_Puertorule'.$i])){
				$datos[$countDatos]='access-list '.trim($IdAccessList).' '.trim($Accion).' '.trim($Protocol).' any any'.' # regla 0';
				$countDatos++;
			}	

/*
no red origen 
no red destino
no host origen
no host destino
	Si puerto origen-destino
	Si numero puerto origen-destino 
*/
			else if(empty($_POST["Origenrule".$i]) && empty($_POST["Dstrule".$i])  && empty($_POST["DstHostrule".$i]) && empty($_POST["OrigenHostrule".$i]) && !empty($_POST['Tipo_Comp_Puerto2rule'.$i]) && !empty($_POST['PuertoNum2rule'.$i]) && !empty($_POST['Tipo_Comp_Puertorule'.$i]) && !empty($_POST['PuertoNumrule'.$i])){
				$datos[$countDatos]='access-list '.trim($IdAccessList).' '.trim($Accion).' '.trim($Protocol).' any '.trim($MatchPort).' '.trim($Port).' any '.trim($MatchPort2).' '.trim($Port2).' # regla 1';
				$countDatos++;
			}

/*
no red origen 
no red destino
no host origen
no host destino
	Si puerto origen
no puerto destino
	Si numero puerto origen
no numero puerto destino 
*/
			else if(empty($_POST["Origenrule".$i]) && empty($_POST["Dstrule".$i])  && empty($_POST["DstHostrule".$i]) && empty($_POST["OrigenHostrule".$i]) && empty($_POST['Tipo_Comp_Puerto2rule'.$i]) && empty($_POST['PuertoNum2rule'.$i]) && !empty($_POST['Tipo_Comp_Puertorule'.$i]) && !empty($_POST['PuertoNumrule'.$i])){
				$datos[$countDatos]='access-list '.trim($IdAccessList).' '.trim($Accion).' '.trim($Protocol).' any '.trim($MatchPort).' '.trim($Port).' any '.' # regla 2';
				$countDatos++;
			}

/*
no red origen 
no red destino
no host origen
no host destino
no puerto origen
	Si puerto destino
no numero puerto origen
	Si numero puerto destino 
*/
			else if(empty($_POST["Origenrule".$i]) && empty($_POST["Dstrule".$i])  && empty($_POST["DstHostrule".$i]) && empty($_POST["OrigenHostrule".$i]) && !empty($_POST['Tipo_Comp_Puerto2rule'.$i]) && !empty($_POST['PuertoNum2rule'.$i]) && empty($_POST['Tipo_Comp_Puertorule'.$i]) && empty($_POST['PuertoNumrule'.$i])){
				$datos[$countDatos]='access-list '.trim($IdAccessList).' '.trim($Accion).' '.trim($Protocol).' any'.' any '.trim($MatchPort2).' '.trim($Port2).' # regla 3';
				$countDatos++;
			}
/*
no red origen 
no red destino
 opciones posibles:    Si host origen y Si host destino
   					  Si host origen y no host destino
					   Puertos Opcionales
*/

           else if(empty($_POST["Origenrule".$i]) && !empty($_POST["OrigenHostrule".$i]))
			{
				if(!empty($_POST["DstHostrule".$i]))
				{
					$IpSource2   = 'host '.$_POST['DstHostrule'.$i];
				}
				else if (empty($_POST["Dstrule".$i]))
					$IpSource2   = 'any';

				$IpSource = 'host '.$_POST['OrigenHostrule'.$i];
				if(strcmp($MatchPort, '0')===0){
					$MatchPort = '';
				}
				if(strcmp($MatchPort2, '0')===0){
					$MatchPort2 = '';
				}
				$datos[$countDatos]= 'access-list '.trim($IdAccessList).' '.trim($Accion).' '.trim($Protocol).' '.trim($IpSource).' '.trim($WildSource).' '.trim($MatchPort).' '.trim($Port).' '.trim($IpSource2).' '.trim($WildSource2).' '.trim($MatchPort2).' '.trim($Port2).' # regla 4 ';
				$countDatos++;
			}


/*
no red origen 
no red destino
 opciones posibles:    Si host origen y Si host destino
   					  no host origen y Si host destino
					   Puertos Opcionales
*/

			else if(empty($_POST["Dstrule".$i]) && !empty($_POST["DstHostrule".$i]))
			{
				if(!empty($_POST["OrigenHostrule".$i]) )
				{
					$IpSource   = 'host '.$_POST['OrigenHostrule'.$i];
				}
				else if (empty($_POST["Origenrule".$i]))
					$IpSource   = 'any';

				$IpSource2 = 'host '.$_POST['DstHostrule'.$i];
				if(strcmp($MatchPort, '0')===0){
					$MatchPort = '';
				}
				if(strcmp($MatchPort2, '0')===0){
					$MatchPort2 = '';
				}
				$datos[$countDatos]= 'access-list '.trim($IdAccessList).' '.trim($Accion).' '.trim($Protocol).' '.trim($IpSource).' '.trim($WildSource).' '.trim($MatchPort).' '.trim($Port).' '.trim($IpSource2).' '.trim($WildSource2).' '.trim($MatchPort2).' '.trim($Port2).' # regla 5 ';
				$countDatos++;
			}
            
/*
Si red origen 
Si red destino
 opciones posibles:    Si red origen y no red destino
					   Puertos Opcionales
*/

			else if(!empty($_POST["Origenrule".$i]) && empty($_POST["OrigenHostrule".$i]))
			{
				if(!empty($_POST["DstHostrule".$i]))
				{
					$IpSource2   = 'host '.$_POST['DstHostrule'.$i];
				}
				else if (empty($_POST["Dstrule".$i]))
					$IpSource2   = 'any';

				$IpSource =$_POST['Origenrule'.$i];
				if(strcmp($MatchPort, '0')===0){
					$MatchPort = '';
				}
				if(strcmp($MatchPort2, '0')===0){
					$MatchPort2 = '';
				}
				$datos[$countDatos]= 'access-list '.trim($IdAccessList).' '.trim($Accion).' '.trim($Protocol).' '.trim($IpSource).' '.trim($WildSource).' '.trim($MatchPort).' '.trim($Port).' '.trim($IpSource2).' '.trim($WildSource2).' '.trim($MatchPort2).' '.trim($Port2).' # regla 6 ';
				$countDatos++;
			}

/*
Si red origen 
Si red destino
 opciones posibles:    No red origen y Si red destino
					   Puertos Opcionales
*/

else if(!empty($_POST["Dstrule".$i]) && empty($_POST["DstHostrule".$i]))
			{
				if(!empty($_POST["OrigenHostrule".$i]) )
				{
					$IpSource   = 'host '.$_POST['OrigenHostrule'.$i];
				}
				else if (empty($_POST["Origenrule".$i]))
					$IpSource   = 'any';

				$IpSource2 = $_POST['Dstrule'.$i];
				if(strcmp($MatchPort, '0')===0){
					$MatchPort = '';
				}
				if(strcmp($MatchPort2, '0')===0){
					$MatchPort2 = '';
				}
				$datos[$countDatos]= 'access-list '.trim($IdAccessList).' '.trim($Accion).' '.trim($Protocol).' '.trim($IpSource).' '.trim($WildSource).' '.trim($MatchPort).' '.trim($Port).' '.trim($IpSource2).' '.trim($WildSource2).' '.trim($MatchPort2).' '.trim($Port2).' # regla 7 ';
				$countDatos++;
			}
            

		}


		$datos[$countDatos] = 'int '.trim($Interface);
		$countDatos++;
		$datos[$countDatos]= 'ip access-group '.trim($IdAccessList).' '.trim($Interface_port);
		$countDatos++;
	}


	CreaTarea_Ansible($datos);
		$comando= 'ansible-playbook -i host_GNS3 CreaLista.yml';
		$return = [];
		$salida = exec($comando,$return);

		echo '<h1> Lista Creada Exitosamente</h1>';
		echo '<a class="boton_Recarga" href="javascript:window.history.go(-4);">Aceptar</a>';

	}


	if (!strcmp($_POST["tipo"], 'Standard'))
	{
		EnviaListaStandard();
	}
	else if(!strcmp($_POST["tipo"], 'Extended'))
	{

		EnviaListaExtended();
	}
	else 
		echo 'Sin datos';
	?>



	<!DOCTYPE html>
	<html>
	<head>
		<LINK REL=StyleSheet HREF='CSS/Style.css' TYPE="text/css" MEDIA=screen>
	</head>
	<body>

	</body>
	</html>




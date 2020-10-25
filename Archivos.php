<?php 
function ObtenVecinos($lim)
{//Se realiza la conexion con cada uno de los dispositivos y posteriormente se guardan los archivos
	$comando= 'ansible-playbook -i host_GNS3 cdp.yml';
	$return = [];
	$salida = exec($comando,$return);
//////////////////////////////
	$Devices=[];
	$Devices_Info=[];
$itera = 1; //sacamos la informacion importante
while ($itera <= $lim) {
//obteniendo archivo de vecinos 
	$numRouter = $itera;
	$name = "_Neighbors.txt";
	$ruta = "/opt/lampp/htdocs/Proyecto/Info_GNS3/R".$numRouter.$name;
	$archivo = file($ruta, FILE_IGNORE_NEW_LINES);
////////////////////////////////////
//obteniendo conexion con vecinos, nombre ip e interfaz
	$i=0;
    foreach ($archivo as &$linea) {//Este for separa el archivo en lineas que recupera ansible
    	$p= explode('\n',$linea);
    } //fin del while
    $linea =$p; 
    $j=-1;
            while( $i < count($linea)) {  //buscamos informacion del dispositivo para armar topologia
            if (strpos($linea[$i], 'hostname') !== false){//buscamos el nombre del router con que se conecta    
            	$porciones = explode(" ", $linea[$i]);
            	$Devices_Info['nombre'] = $porciones[1];
            	$j=1;
            }
            if (strpos($linea[$i], 'Device ID') !== false) //buscamos el nombre de sus vecions 
            {   
            	$porciones = explode(":", $linea[$i]);
            	$Devices_Info['vecinoID'.$j] = $porciones[1];
            }
            if(strpos($linea[$i], 'Interface') !== false){ //buscamos la IP de los vecinos
            	$porciones = explode(":", $linea[$i]);
            	$porciones = explode(",", $porciones[1]);  
            	$Devices_Info['vecinoInt'.$j] = $porciones[0];
            	$j++;
            }
            $i++;
          }

$Devices_Info['numVecinos']=$j; //guardamos cuantos vecinos encontramos
$Devices[$itera] = $Devices_Info; //Almacena la informacion asociada al router actual 

$itera++;
}//fin del while
unset($linea);
return $Devices;
}


function buscaConexion($ip)
{	$result = false;
	$file = fopen('host_GNS3', "r");
	while(! feof($file)) {
		$line = fgets($file);
		if (strpos($line,$ip))
		{
			$result = true;
		}
	}
	return $result;
}


function cambianombre()
{
	$num = 1;
	$fichero = '/opt/lampp/htdocs/Proyecto/Info_GNS3/R'.$num.'_Neighbors.txt';
	$router = ' ';
	$ExtendedAccessList= [];
	$StandardAccessList= [];
	while (file_exists($fichero)) {
		$file = fopen($fichero, "r");
		while(! feof($file)) {
			$line = fgets($file);
			$p= explode('\n',$line);
		}
		$i =0;
        while( $i < count($p)) {  //buscamos informacion del dispositivo para armar topologia
            if (strpos($p[$i], 'hostname') !== false){//buscamos el nombre del router con que se conecta    
            	$porciones = explode(" ", $p[$i]);
            	$nuevo_fichero = '/opt/lampp/htdocs/Proyecto/Info_GNS3/'.$porciones[1];
            	/*if (!copy($fichero,$nuevo_fichero)) {
            				echo "Error al copiar $fichero...\n";
            			}*/
            			$file2 = fopen($nuevo_fichero, "w");
            			$ffile= fopen($fichero, "r");
            			while(!feof($ffile)) {
            				$line = fgets($ffile);
            				$p1= explode('\n',$line);
            			}

            			for($j=0;$j<count($p1);$j++)
            				fwrite($file2, $p1[$j].PHP_EOL);
            			fclose($file2);
            		}
            		if (strpos($p[$i],'ip address') !== false){
            			$separaLinea= explode(' ',$p[$i]);
            			if(count($separaLinea)==5){
            				$ip= $separaLinea[3];
            				if(buscaConexion($ip)){
            					$file2 = fopen($nuevo_fichero, "a+");
            					fwrite($file2, PHP_EOL.'Conexion:'.$ip.PHP_EOL);
            					fclose($file2);
            				}
            			}
            		}
            		$i++;
            	}
            	$num++;
            	$fichero = '/opt/lampp/htdocs/Proyecto/Info_GNS3/R'.$num.'_Neighbors.txt';
            }
          }



          function BuscaListasAcceso( $var ){
           $nombre_fichero = '/opt/lampp/htdocs/Proyecto/Info_GNS3/'.$var;
           $ExtendedAccessList= [];
           $ID_Extended=0;

           $StandardAccessList= [];
           $ID_Standard=0;

           $IsRuleStandard= false;
           $IsRuleExtended= false;
           $file = fopen($nombre_fichero, "r");
           $line = ' ';
           $contador_ftell=1;
           $ftell_pool= [];

           $AccessList=[3];

           $AppliedAccessList = [];
           $AppliedCount = 0;
           while(!feof($file)) {
            $open = true;
            $line = fgets($file);
            $ftell_pool[$contador_ftell] = ftell ($file);
            $contador_ftell++;
            $Rules_Extended=0;
            $Rules_Standard=0;
            if (strpos($line, 'access-group') ){

        			//echo $line.'<br>';  // entrada/salida tipo de aplicacion de la lista de acceso 
             $separacion= explode(' ',$line);
             $AppliedCount++;
             $AppliedAccessList['ID'.$AppliedCount] =  $separacion[3];
             $AppliedAccessList['TYPE'.$AppliedCount] =  $separacion[4];

             $back = $contador_ftell;
             $back--;


             $i=0;
             while($i<5){
              $back--;
              fseek($file, $ftell_pool[$back]);
              $line = fgets($file);
              $pos = strpos($line, 'interface');

              if($pos === 0)
                { $separacion= explode(' ',$line);
              $AppliedAccessList['Interface'.$AppliedCount] =  $separacion[1];
        				//	echo $separacion[1].'<br>';//interfaz en la que esta aplicada la lista de acceso 
            }
            $i++;
          }

          $contador_ftell--;
          fseek($file, $ftell_pool[$contador_ftell]);

        }

        else if (strpos($line, 'access list') ){
        			$aux = ftell ($file);     //guarda posicion actual del puntero file 
        			//echo '<br>';
        			$trash = explode(", u'", $line);
        			
        			if(count($trash)==2){
        				if(strpos($trash[1],'Standard') === 0){
        					//echo $trash[1].'*   es Standard<br>';
        					$IsRuleStandard= true;
        					$IsRuleExtended= false;
        					$ID_Standard++;
        					$StandardAccessList['ID'.$ID_Standard]= $trash[1];

        				}

        				else 
        				{
        					//echo $trash[1].'*   es Extended<br>';
        					$IsRuleStandard= false;
        					$IsRuleExtended= true;
        					$ID_Extended++;
        					$ExtendedAccessList['ID'.$ID_Extended]= $trash[1];
        				}
        				
        			}
        			else{

        				if(strpos($line,'Standard') === 0){
        					$IsRuleStandard= true;
        					$IsRuleExtended= false;
        					$ID_Standard++;
        					$StandardAccessList['ID'.$ID_Standard]= $line;
        					//echo $line.'*   es Standard<br>';
        				}
        				else {
        					//echo $line.'*   es Extended<br>';
        					$IsRuleStandard= false;
        					$IsRuleExtended= true;
        					$ID_Extended++;
        					$ExtendedAccessList['ID'.$ID_Extended]= $line;

        				}
        				
        			}


        			while (strpos($line, 'permit') || strpos($line, 'deny') || $open ){
        				$line = fgets($file);
        				if(strpos($line, 'permit') || strpos($line, 'deny')){
        					$trash2 = explode("')", $line);
        					if(count($trash2)==2){

        						if($IsRuleExtended){
        							//echo $trash2[0].'<br>';
        							$Rules_Extended++;
        							$ExtendedAccessList['Rule'.$Rules_Extended.'_Acl_'.$ID_Extended]= str_replace(',','',$trash2[0]);  ;

        						}
        						else if ($IsRuleStandard)
        						{
        							$Rules_Standard++;
        							$StandardAccessList['Rule'.$Rules_Standard.'_Acl_'.$ID_Standard]= str_replace(',','',$trash2[0]);
        							$StandardAccessList['Rule'.$Rules_Standard.'_Acl_'.$ID_Standard]= str_replace('wildcard bits ','',$StandardAccessList['Rule'.$Rules_Standard.'_Acl_'.$ID_Standard]);
                      $StandardAccessList['Rule'.$Rules_Standard.'_Acl_'.$ID_Standard]= str_replace(strrchr($StandardAccessList['Rule'.$Rules_Standard.'_Acl_'.$ID_Standard], "("),'',$StandardAccessList['Rule'.$Rules_Standard.'_Acl_'.$ID_Standard]);
                    }

                  }
                  else {
                    if($IsRuleExtended){
        							//echo $line.'<br>';
                     $Rules_Extended++;
                     $ExtendedAccessList['Rule'.$Rules_Extended.'_Acl_'.$ID_Extended]= str_replace(',','',$line);

                   }
                   else if ($IsRuleStandard)
                   {
                     $Rules_Standard++;
                     $StandardAccessList['Rule'.$Rules_Standard.'_Acl_'.$ID_Standard]= str_replace(',','',$line);
                     $StandardAccessList['Rule'.$Rules_Standard.'_Acl_'.$ID_Standard]= str_replace('wildcard bits ','',$StandardAccessList['Rule'.$Rules_Standard.'_Acl_'.$ID_Standard]);

                     $StandardAccessList['Rule'.$Rules_Standard.'_Acl_'.$ID_Standard]= str_replace(strrchr($StandardAccessList['Rule'.$Rules_Standard.'_Acl_'.$ID_Standard], "("),'',$StandardAccessList['Rule'.$Rules_Standard.'_Acl_'.$ID_Standard]);
                   }


                 }

               }

               $open= false;
             }
        			fseek($file, $aux);//coloca el puntero en la pocision $aux
        		}

        	}
        	fclose($file);  

         // ordenaStandard($StandardAccessList);
          $StandardAccessList = ordenaStandard($StandardAccessList);
          $AccessList[0]=$ExtendedAccessList;
          $AccessList[1]=$StandardAccessList;
          $AccessList[2]=$AppliedAccessList;


          return $AccessList;
        }


        function ordenaStandard($StandardAccessList)
        {
          $i=1;
          
   
          while(array_key_exists('ID'.$i,$StandardAccessList)){
          
            $j=1;
            $temp = [];
            while(array_key_exists('Rule'.$j.'_Acl_'.$i,$StandardAccessList)){
              $temp [$j]= $StandardAccessList['Rule'.$j.'_Acl_'.$i];
              $j++;
            }
           array_multisort($temp);
            $j=1;
            $k=0;
           while(array_key_exists('Rule'.$j.'_Acl_'.$i,$StandardAccessList)){
               $StandardAccessList['Rule'.$j.'_Acl_'.$i]= $temp[$k];
              $j++;
              $k++;
            }

           $i++;
         }

return $StandardAccessList;
       }

       function PreparaHost($var)
       {
        $ruta = "/opt/lampp/htdocs/Proyecto/host_GNS3";
        $file = fopen($ruta,'w');

        fwrite($file, '## Ansible Hosts Files' . PHP_EOL);
        fwrite($file, PHP_EOL);
        fwrite($file, '[ROUTERS]'.PHP_EOL);

        fwrite($file,$var.' ansible_host='.BuscaIP($var) . PHP_EOL);


        fwrite($file, PHP_EOL);
        fwrite($file, '[ROUTERS:vars]'.PHP_EOL);
        fwrite($file, 'ansible_user=cisco'.PHP_EOL);
        fwrite($file, 'ansible_ssh_pass=cisco'.PHP_EOL);


        fclose($file);   

      }

      function BuscaIP($var)
      {
       $ruta = "/opt/lampp/htdocs/Proyecto/Info_GNS3/$var";
       $file = fopen($ruta,'r');
       while(! feof($file)) {
        $line = fgets($file);
        if (strpos($line,'Conexion:')===0)
        {
         $porciones = explode(":", $line);
         return $porciones[1];	
       }
     }


   }

function EscribeNuevaLista($datos) //CHECALO BIEN
{  
 $ruta = "/opt/lampp/htdocs/Proyecto/CreaLista.yml";
 $file = fopen($ruta,'w');
 fwrite($file, '## '. $datos[0].PHP_EOL);
 fwrite($file, '## '. $datos[1].PHP_EOL);
 fclose($file);   
}


function GetNuevaLista(){
  $datos = [];
  $ruta = "/opt/lampp/htdocs/Proyecto/CreaLista.yml";
  $file = fopen($ruta, "r");

  $line = fgets($file);
  $porciones = explode(" ", $line);
  $datos[0]= trim($porciones[1]);

  $line = fgets($file);
  $porciones = explode(" ", $line);
  $datos[1]= trim($porciones[1]);
  return $datos;
}



function ObtenSigIdStandardAccessList($routername)
{

  $AccessList=BuscaListasAcceso($routername);

  $ExtendedAccessList = $AccessList[0];
  $StandardAccessList = $AccessList[1];
  $AppliedAccessList =  $AccessList[2];

  $i=1;

  while(array_key_exists('ID'.$i,$StandardAccessList)){

    $separa= explode(' ',$StandardAccessList['ID'.$i]);

    if($i!=$separa[4]){
      break; 
    }
    $i++;
  } 

  return trim($i);
}


function ObtenSigIdExtendedAccessList($routername)
{
  $AccessList=BuscaListasAcceso($routername);

  $ExtendedAccessList = $AccessList[0];
  $StandardAccessList = $AccessList[1];
  $AppliedAccessList =  $AccessList[2];

  $contador2 = 0;

  $i=1;
  $k=101;

  while(array_key_exists('ID'.$i,$ExtendedAccessList)){

    $separa= explode(' ',$ExtendedAccessList['ID'.$i]);

    if($k!=$separa[4]){
      break; 
    }
    $k++;
    $i++;
  } 

  return trim($k);
}


function BuscaInfo( $var ){
  $num = 1;
  $nombre_fichero = '/opt/lampp/htdocs/Proyecto/Info_GNS3/R'.$num.'_Neighbors.txt';
  $router = ' ';
  $info= [];

  while (file_exists($nombre_fichero) && $router!=$var) {
    $num++;
    $file = fopen($nombre_fichero, "r");

    while(! feof($file)) {
      $line = fgets($file);
      $p= explode('\n',$line);
    }

    $i =0;
        while( $i < count($p)) {  //buscamos informacion del dispositivo para armar topologia

            if (strpos($p[$i], 'hostname') !== false){//buscamos el nombre del router con que se conecta    
              $porciones = explode(" ", $p[$i]);
              $router =$porciones[1];
              break;
            }
            $i++;
          }

          if($router==$var){
            $i=0;
            $CountInt=0;
            $CountDevice=0;

            while( $i < count($p)) {      
              $porciones = explode("!", $p[$i]);

               if (strpos($porciones[0], 'ip domain name') !== false){   //Nombre del dominio

                $info ['domain'] = substr($porciones[0], 15);
              }
               if (strpos($porciones[0], 'interface') !== false){   // Informacion de Interfaz
                 $x=$i;
                 $porciones = explode("!", $p[$x]);
                 $info ['InterfaceName'.$CountInt] = substr($porciones[0], 10);
                 $x++;
                 $porciones = explode("!", $p[$x]);
                 if (strpos($porciones[0], 'no') == false)
                   $info ['InterfaceIp'.$CountInt] = substr($porciones[0], 12);
                 else 
                  $info ['InterfaceIp'.$CountInt] = $porciones[0];

                $x++;
                $porciones = explode("!", $p[$x]);

                if (strpos($porciones[0], 'ip access-group') !== false){
                 $x++;
                 $porciones = explode("!", $p[$x]);
               }
               if (strpos($porciones[0], 'shutdown') !== false){
                 $info ['InterfaceState'.$CountInt] = 'Apagada';
                 $x++;    
               }
               else {
                $info ['InterfaceState'.$CountInt] = 'Encendida';

              }

              $porciones = explode("!", $p[$x]);
              $info ['InterfaceTtd'.$CountInt] = $porciones[0];
              $CountInt++;
            }
            $info ['NumInterface'] = $CountInt-1;

            if (strpos($porciones[0], 'Device ID:') !== false){   // Nombre de Entradas al router
              $CountDevice++;
              $info ['DeviceID'.$CountDevice] = substr($porciones[0], 11);
            }
               if (strpos($porciones[0], 'Entry address(es): ') !== false){   // Información Entradas de router
                 $x=$i+1;    

                 $porciones = explode("!", $p[$x]);
                 $info ['DeviceIP'.$CountDevice] = substr($porciones[0], 14);
                 $x++;

                 $porciones = explode("!", $p[$x]);
                 $porciones = explode(",", $p[$x]);
                 $info ['DevicePlataform'.$CountDevice] = substr($porciones[0],10);
                 $info ['DeviceTipo'.$CountDevice] = substr($porciones[1],16,-1);
                 $x++;

                 $porciones = explode("!", $p[$x]);
                 $porciones = explode(",", $p[$x]);
                 $info ['DeviceIntLocal'.$CountDevice] = substr($porciones[0],11);
                 $info ['DeviceIntOut'.$CountDevice] = substr($porciones[1],27);
                 $x++;

                 $porciones = explode("!", $p[$x]);
                 $info ['DeviceHoldTime'.$CountDevice] = substr($porciones[0],11);
               }
               if (strpos($porciones[0], 'Cisco IOS Software') !== false){   // Informacion de Version sobre entradas
                $info ['DeviceSw1_'.$CountDevice] = $porciones[0];
              }
               if (strpos($porciones[0], 'Technical Support') !== false){   //
                $info ['DeviceSw2_'.$CountDevice] = $porciones[0];
              }
               if (strpos($porciones[0], 'Copyright') !== false){   //
                $info ['DeviceSw3_'.$CountDevice] = $porciones[0];
              }
               if (strpos($porciones[0], 'Compiled') !== false){   //
                $info ['DeviceSw4_'.$CountDevice] = $porciones[0];
              }


              $i++;
              $info ['NumDevice'] =$CountDevice;
            }

          }

          fclose($file);  
          $nombre_fichero = '/opt/lampp/htdocs/Proyecto/Info_GNS3/R'.$num.'_Neighbors.txt';
        }

        $numRouter = 1;
        $name = "_Neighbors.txt";
        $ruta = "/opt/lampp/htdocs/Proyecto/Info_GNS3/R".$numRouter.$name;
        $archivo = file($ruta, FILE_IGNORE_NEW_LINES);

        return $info;
      }
      ?>

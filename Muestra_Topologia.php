<!--Programa para guardar las Ips en un archivo y conecta con cada uno para obtener informacion en un txt-->

<?php //Funcion para crear el archivo de host_GNS3
include('Archivos.php');


function guardaDispositivos(){    
  $ruta = "/opt/lampp/htdocs/Proyecto/host_GNS3";
  $file = fopen($ruta,'w');
  if ( !$file ) {
   echo 'no se pudo abrir';
   echo $file;
 }
 else
 {
  if(isset($_POST["subm"])) {
    $i=1;
    $var='ip'.$i;
    fwrite($file, '## Ansible Hosts Files' . PHP_EOL);
    fwrite($file, PHP_EOL);
    fwrite($file, '[ROUTERS]'.PHP_EOL);
    
    while(!empty($_POST[$var]))
    {
      $var = $_POST[$var];    
      fwrite($file,'R'.$i.' ansible_host='.$var . PHP_EOL);
      $i=$i+1;
      $var='ip'.$i;
    } 
    fwrite($file, PHP_EOL);
    fwrite($file, '[ROUTERS:vars]'.PHP_EOL);
    fwrite($file, 'ansible_user=cisco'.PHP_EOL);
    fwrite($file, 'ansible_ssh_pass=cisco'.PHP_EOL);

    
    fclose($file);   
  }   }
  
  return $i-1;      
}

$numDisp=guardaDispositivos();
$Devices = ObtenVecinos($numDisp);

$Dispositivo='';
for ($i=1; $i < count($Devices)+1; $i++) { 
  $Dispositivo= $Dispositivo.implode($Devices[$i]).',';    
}

cambianombre();//Creamos archivos con ip y nombre de conexion

/////////////Mostrando topologia 

?>



<!doctype html>
<html>
<head>
  <LINK REL=StyleSheet HREF='CSS/Style.css' TYPE="text/css" MEDIA=screen>
</head>
<h1>TOPOLOGIA ACTUAL</h1>


<script type="text/javascript" src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>



<script type="text/javascript"> 
  var DIR = 'Img/';
  var eCount = 0;
  var nodes = [100];
  var edges = [500];
  var network = null;

    // Called when the Visualization API is loaded.
    function draw() {
      var DIR = 'Img/';

    var l = '<?php echo $Dispositivo; ?>'; //recibimos todos los datos de los routers como string 
    //Empezamos a separar cada dato 
    var separacion1 = l.split(","); //quedan de la forma : R4 R3.cisco.com GigabitEthernet1/02
    
    for(var i=0;i<separacion1.length-1;i++){ //Aqui se crean los nodos 
    var separacion = separacion1[i].split(" "); //Elimina espacios y guarda 3 elementos para el ejemplo de arriba
    for (var j= 0; j < separacion.length; j++) {
     var p = separacion[0];
   }
   var aux=  {id: p,  shape: 'circularImage', image: DIR + 'router.png', label: p };
   nodes[i] = aux;
    //console.log(nodes[i] );
  }
  



  var anterior1 = '';
  var anterior2 = '';
  var posible = true; 

//Intentando crear enlaces
for(var i=0;i<separacion1.length-1;i++){
    var separacion = separacion1[i].split(" "); //Elimina espacios y guarda 3 elementos para el ejemplo de arriba
    for (var j= 0; j < separacion.length; j++) 
      { var k = j-2;
        if(separacion[j].includes('cisco.com') && !separacion[j-1].includes('GigabitEthernet')  ){
             // console.log( separacion[j-1] +" - "+separacion[j]);
             var separac1 = separacion[j].split(".");
             edges [eCount] = {from: separacion[j-1] , to: separac1[0]};

             eCount++;
           }
           if (j>1 && separacion[j-1].includes('GigabitEthernet') ) {
            while(!separacion[k].includes('GigabitEthernet') && !separacion[k].includes('cisco.com')){
              k--;
            }
            if(separacion[k-1].includes('R')){
                //console.log(separacion[k-1]);      
                k--;
                var separac1 = separacion[j].split(".");
                
                if (posible){
                 anterior1 = separacion[k]; 
                 anterior2= separac1[0]; 
                 posible = false; 
               }
               
               else if(!posible && anterior1 == separac1[0] && anterior2 == separacion[k] )
               { 
                edges[eCount]={from: separacion[k] , to: separac1[0] };
                eCount++;
                edges[eCount]={from: separac1[0] , to: separacion[k] };
                eCount++;
                posible = true; 
              }  
              
              
              
              
            }
          }
          
        }
      }

      for (var i = 0; i < nodes.length; i++) {
        console.log(nodes[i]);
      }  
      
      // create a network
      var container = document.getElementById('mynetwork');
      var data = {
        nodes: nodes,
        edges: edges
      };
      var options = {
        nodes: {
          borderWidth:4,
          size:30,
          color: {
            border: '#222222',
            background: '#666666'
          },
          font:{color:'#eeeeee'}
        },
        edges: {
          color: 'lightgray'
        }
      };
      network = new vis.Network(container, data, options);
    }

  </script>

  <body onload="draw()">
    <div id="mynetwork"></div>
  </body>

  <form action= 'http://localhost/Proyecto/Info_Dispositivo.php' method="POST">   
    <h2>Informacion de Dispositivo :</h2>
    <select name="select">
      <?php 
      for ($i=1; $i < count($Devices)+1; $i++) { 
        $tmp =  $Devices[$i];
        ?>
        <option value="<?php echo $tmp['nombre']?>"> <?php echo $tmp['nombre']?> </option>
        <?php
      }
      ?> 
    </select>
    <input name="Ejecutar" type="submit" value="Ejecutar" >
  </form>

  <form action= 'http://localhost/Proyecto/Crea_Lista.php' method="POST">   
    <h2>Crea lista de acceso:</h2>
    <select name="select">
      <?php 
      for ($i=1; $i < count($Devices)+1; $i++) { 
        $tmp =  $Devices[$i];
        ?>
        <option value="<?php echo $tmp['nombre']?>"> <?php echo $tmp['nombre']?> </option>
        <?php
      }
      ?> 
    </select>
    <?php echo '<br>'; ?>
    <input type="radio" name="tipo" value="Standard">
    <label for="Standard">Standard</label><br>
    <input type="radio" name="tipo" value="Extended">
    <label for="Extended">Extended</label><br>
    <input name="Ejecutar" type="submit" value="Ejecutar" >

  </form>
  
  <form action= 'http://localhost/Proyecto/Edita_Lista.php' method="POST">   
    <h2>Ver listas de acceso:</h2>
    <select name="select">
      <?php 
      for ($i=1; $i < count($Devices)+1; $i++) { 
        $tmp =  $Devices[$i];
        ?>
        <option value="<?php echo $tmp['nombre']?>"> <?php echo $tmp['nombre']?> </option>
        <?php
      }
      ?> 
    </select>

    <input name="Ejecutar" type="submit" value="Ejecutar" >
  </form>


  </html>


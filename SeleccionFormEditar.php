<?php 
function SeleccionInterfaceEditarStd($reglas)
{
	$isAplied= $reglas['numReglas']+1;
	if(count($reglas) == $isAplied){
		echo '<option selected="selected" value= "0">NO APLICADA</option>';
		echo '<option value= "GigabitEthernet1/0">GigabitEthernet1/0</option>';
		echo '<option value= "GigabitEthernet2/0">GigabitEthernet2/0</option>';
		echo '<option value= "GigabitEthernet3/0">GigabitEthernet3/0</option>';
		echo '<option value= "GigabitEthernet4/0">GigabitEthernet4/0</option>';
		echo '<option value= "GigabitEthernet5/0">GigabitEthernet5/0</option>';
		echo '<option value= "GigabitEthernet6/0">GigabitEthernet6/0</option>';
	}
	else{

		if(strpos($reglas[$isAplied-1], 'GigabitEthernet1/0') !== false){
			echo '<option value= "0">NO APLICADA</option>';
			echo '<option selected="selected" value= "GigabitEthernet1/0">GigabitEthernet1/0</option>';
			echo '<option value= "GigabitEthernet2/0">GigabitEthernet2/0</option>';
			echo '<option value= "GigabitEthernet3/0">GigabitEthernet3/0</option>';
			echo '<option value= "GigabitEthernet4/0">GigabitEthernet4/0</option>';
			echo '<option value= "GigabitEthernet5/0">GigabitEthernet5/0</option>';
			echo '<option value= "GigabitEthernet6/0">GigabitEthernet6/0</option>';
		}
		else if(strpos($reglas[$isAplied-1], 'GigabitEthernet2/0') !== false){
			echo '<option value= "0">NO APLICADA</option>';
			echo '<option value= "GigabitEthernet1/0">GigabitEthernet1/0</option>';
			echo '<option selected="selected" value= "GigabitEthernet2/0">GigabitEthernet2/0</option>';
			echo '<option value= "GigabitEthernet3/0">GigabitEthernet3/0</option>';
			echo '<option value= "GigabitEthernet4/0">GigabitEthernet4/0</option>';
			echo '<option value= "GigabitEthernet5/0">GigabitEthernet5/0</option>';
			echo '<option value= "GigabitEthernet6/0">GigabitEthernet6/0</option>';
		}
		else if(strpos($reglas[$isAplied-1], 'GigabitEthernet3/0') !== false){
			echo '<option value= "0">NO APLICADA</option>';
			echo '<option value= "GigabitEthernet1/0">GigabitEthernet1/0</option>';
			echo '<option value= "GigabitEthernet2/0">GigabitEthernet2/0</option>';
			echo '<option selected="selected" value= "GigabitEthernet3/0">GigabitEthernet3/0</option>';
			echo '<option value= "GigabitEthernet4/0">GigabitEthernet4/0</option>';
			echo '<option value= "GigabitEthernet5/0">GigabitEthernet5/0</option>';
			echo '<option value= "GigabitEthernet6/0">GigabitEthernet6/0</option>';
		}
		else if(strpos($reglas[$isAplied-1], 'GigabitEthernet4/0') !== false){
			echo '<option value= "0">NO APLICADA</option>';
			echo '<option value= "GigabitEthernet1/0">GigabitEthernet1/0</option>';
			echo '<option value= "GigabitEthernet2/0">GigabitEthernet2/0</option>';
			echo '<option value= "GigabitEthernet3/0">GigabitEthernet3/0</option>';
			echo '<option selected="selected" value= "GigabitEthernet4/0">GigabitEthernet4/0</option>';
			echo '<option value= "GigabitEthernet5/0">GigabitEthernet5/0</option>';
			echo '<option value= "GigabitEthernet6/0">GigabitEthernet6/0</option>';
		}
		else if(strpos($reglas[$isAplied-1], 'GigabitEthernet5/0') !== false){
			echo '<option value= "0">NO APLICADA</option>';
			echo '<option value= "GigabitEthernet1/0">GigabitEthernet1/0</option>';
			echo '<option value= "GigabitEthernet2/0">GigabitEthernet2/0</option>';
			echo '<option value= "GigabitEthernet3/0">GigabitEthernet3/0</option>';
			echo '<option value= "GigabitEthernet4/0">GigabitEthernet4/0</option>';
			echo '<option selected="selected" value= "GigabitEthernet5/0">GigabitEthernet5/0</option>';
			echo '<option value= "GigabitEthernet6/0">GigabitEthernet6/0</option>';
		}
		else if(strpos($reglas[$isAplied-1], 'GigabitEthernet6/0') !== false){
			echo '<option value= "0">NO APLICADA</option>';
			echo '<option value= "GigabitEthernet1/0">GigabitEthernet1/0</option>';
			echo '<option value= "GigabitEthernet2/0">GigabitEthernet2/0</option>';
			echo '<option value= "GigabitEthernet3/0">GigabitEthernet3/0</option>';
			echo '<option value= "GigabitEthernet4/0">GigabitEthernet4/0</option>';
			echo '<option value= "GigabitEthernet5/0">GigabitEthernet5/0</option>';
			echo '<option selected="selected" value= "GigabitEthernet6/0">GigabitEthernet6/0</option>';
		}


	} 
}


function SeleccionInterfaceFlujoEditarStd($reglas)
{
	$isAplied= $reglas['numReglas']+1;
	if(count($reglas) != $isAplied){
		if(strpos($reglas[$isAplied], 'in') !== false){
			echo '<option value= "in">in</option>';
			echo '<option value= "out">out</option>';
		}
		else if(strpos($reglas[$isAplied], 'out') !== false){
			echo '<option value= "out">out</option>';
			echo '<option value= "in">in</option>';
		} 

	}
	else
	{
		echo '<option value= "in">in</option>';
		echo '<option value= "out">out</option>';
	}

}


function SeleccionProtocolo($regla)
{	
	if(in_array("ahp", $regla)){
		echo '<option selected="selected" value= "ahp">ahp</option>';
		echo '<option value= "eigrp">eigrp</option>';
		echo '<option value= "esp">esp</option>';
		echo '<option value= "gre">gre</option>';
		echo '<option value= "icmp">icmp</option>';
		echo '<option value= "ip">ip</option>';
		echo '<option value= "igmp">igmp</option>';
		echo '<option value= "ipinip">ipinip</option>';
		echo '<option value= "nos">nos</option>';
		echo '<option value= "ospf">ospf</option>';
		echo '<option value= "pcp">pcp</option>';
		echo '<option value= "pim">pim</option>';
		echo '<option value= "sctp">sctp</option>';
		echo '<option value= "tcp">tcp</option>';
		echo '<option value= "udp">udp</option>';
	}

	else if(in_array("eigrp", $regla)){
		echo '<option value= "ahp">ahp</option>';
		echo '<option selected="selected" value= "eigrp">eigrp</option>';
		echo '<option value= "esp">esp</option>';
		echo '<option value= "gre">gre</option>';
		echo '<option value= "icmp">icmp</option>';
		echo '<option value= "ip">ip</option>';
		echo '<option value= "igmp">igmp</option>';
		echo '<option value= "ipinip">ipinip</option>';
		echo '<option value= "nos">nos</option>';
		echo '<option value= "ospf">ospf</option>';
		echo '<option value= "pcp">pcp</option>';
		echo '<option value= "pim">pim</option>';
		echo '<option value= "sctp">sctp</option>';
		echo '<option value= "tcp">tcp</option>';
		echo '<option value= "udp">udp</option>';
	}

	else if(in_array("esp", $regla)){
		echo '<option value= "ahp">ahp</option>';
		echo '<option value= "eigrp">eigrp</option>';
		echo '<option selected="selected" value= "esp">esp</option>';
		echo '<option value= "gre">gre</option>';
		echo '<option value= "icmp">icmp</option>';
		echo '<option value= "ip">ip</option>';
		echo '<option value= "igmp">igmp</option>';
		echo '<option value= "ipinip">ipinip</option>';
		echo '<option value= "nos">nos</option>';
		echo '<option value= "ospf">ospf</option>';
		echo '<option value= "pcp">pcp</option>';
		echo '<option value= "pim">pim</option>';
		echo '<option value= "sctp">sctp</option>';
		echo '<option value= "tcp">tcp</option>';
		echo '<option value= "udp">udp</option>';
	}

	else if(in_array("gre", $regla)){
		echo '<option value= "ahp">ahp</option>';
		echo '<option value= "eigrp">eigrp</option>';
		echo '<option value= "esp">esp</option>';
		echo '<option selected="selected" value= "gre">gre</option>';
		echo '<option value= "icmp">icmp</option>';
		echo '<option value= "ip">ip</option>';
		echo '<option value= "igmp">igmp</option>';
		echo '<option value= "ipinip">ipinip</option>';
		echo '<option value= "nos">nos</option>';
		echo '<option value= "ospf">ospf</option>';
		echo '<option value= "pcp">pcp</option>';
		echo '<option value= "pim">pim</option>';
		echo '<option value= "sctp">sctp</option>';
		echo '<option value= "tcp">tcp</option>';
		echo '<option value= "udp">udp</option>';
	}

	else if(in_array("icmp", $regla)){
		echo '<option value= "ahp">ahp</option>';
		echo '<option value= "eigrp">eigrp</option>';
		echo '<option value= "esp">esp</option>';
		echo '<option value= "gre">gre</option>';
		echo '<option selected="selected" value= "icmp">icmp</option>';
		echo '<option value= "ip">ip</option>';
		echo '<option value= "igmp">igmp</option>';
		echo '<option value= "ipinip">ipinip</option>';
		echo '<option value= "nos">nos</option>';
		echo '<option value= "ospf">ospf</option>';
		echo '<option value= "pcp">pcp</option>';
		echo '<option value= "pim">pim</option>';
		echo '<option value= "sctp">sctp</option>';
		echo '<option value= "tcp">tcp</option>';
		echo '<option value= "udp">udp</option>';
	}

	else if(in_array("ip", $regla)){
		echo '<option value= "ahp">ahp</option>';
		echo '<option value= "eigrp">eigrp</option>';
		echo '<option value= "esp">esp</option>';
		echo '<option value= "gre">gre</option>';
		echo '<option value= "icmp">icmp</option>';
		echo '<option selected="selected" value= "ip">ip</option>';
		echo '<option value= "igmp">igmp</option>';
		echo '<option value= "ipinip">ipinip</option>';
		echo '<option value= "nos">nos</option>';
		echo '<option value= "ospf">ospf</option>';
		echo '<option value= "pcp">pcp</option>';
		echo '<option value= "pim">pim</option>';
		echo '<option value= "sctp">sctp</option>';
		echo '<option value= "tcp">tcp</option>';
		echo '<option value= "udp">udp</option>';
	}

	else if(in_array("igmp", $regla)){
		echo '<option value= "ahp">ahp</option>';
		echo '<option value= "eigrp">eigrp</option>';
		echo '<option value= "esp">esp</option>';
		echo '<option value= "gre">gre</option>';
		echo '<option value= "icmp">icmp</option>';
		echo '<option value= "ip">ip</option>';
		echo '<option selected="selected" value= "igmp">igmp</option>';
		echo '<option value= "ipinip">ipinip</option>';
		echo '<option value= "nos">nos</option>';
		echo '<option value= "ospf">ospf</option>';
		echo '<option value= "pcp">pcp</option>';
		echo '<option value= "pim">pim</option>';
		echo '<option value= "sctp">sctp</option>';
		echo '<option value= "tcp">tcp</option>';
		echo '<option value= "udp">udp</option>';
	}

	else if(in_array("ipinip", $regla)){
		echo '<option value= "ahp">ahp</option>';
		echo '<option value= "eigrp">eigrp</option>';
		echo '<option value= "esp">esp</option>';
		echo '<option value= "gre">gre</option>';
		echo '<option value= "icmp">icmp</option>';
		echo '<option value= "ip">ip</option>';
		echo '<option value= "igmp">igmp</option>';
		echo '<option selected="selected" value= "ipinip">ipinip</option>';
		echo '<option value= "nos">nos</option>';
		echo '<option value= "ospf">ospf</option>';
		echo '<option value= "pcp">pcp</option>';
		echo '<option value= "pim">pim</option>';
		echo '<option value= "sctp">sctp</option>';
		echo '<option value= "tcp">tcp</option>';
		echo '<option value= "udp">udp</option>';
	}

	else if(in_array("nos", $regla)){
		echo '<option value= "ahp">ahp</option>';
		echo '<option value= "eigrp">eigrp</option>';
		echo '<option value= "esp">esp</option>';
		echo '<option value= "gre">gre</option>';
		echo '<option value= "icmp">icmp</option>';
		echo '<option value= "ip">ip</option>';
		echo '<option value= "igmp">igmp</option>';
		echo '<option value= "ipinip">ipinip</option>';
		echo '<option selected="selected" value= "nos">nos</option>';
		echo '<option value= "ospf">ospf</option>';
		echo '<option value= "pcp">pcp</option>';
		echo '<option value= "pim">pim</option>';
		echo '<option value= "sctp">sctp</option>';
		echo '<option value= "tcp">tcp</option>';
		echo '<option value= "udp">udp</option>';
	}

	else if(in_array("ospf", $regla)){
		echo '<option value= "ahp">ahp</option>';
		echo '<option value= "eigrp">eigrp</option>';
		echo '<option value= "esp">esp</option>';
		echo '<option value= "gre">gre</option>';
		echo '<option value= "icmp">icmp</option>';
		echo '<option value= "ip">ip</option>';
		echo '<option value= "igmp">igmp</option>';
		echo '<option value= "ipinip">ipinip</option>';
		echo '<option value= "nos">nos</option>';
		echo '<option selected="selected" value= "ospf">ospf</option>';
		echo '<option value= "pcp">pcp</option>';
		echo '<option value= "pim">pim</option>';
		echo '<option value= "sctp">sctp</option>';
		echo '<option value= "tcp">tcp</option>';
		echo '<option value= "udp">udp</option>';
	}

	else if(in_array("pcp", $regla)){
		echo '<option value= "ahp">ahp</option>';
		echo '<option value= "eigrp">eigrp</option>';
		echo '<option value= "esp">esp</option>';
		echo '<option value= "gre">gre</option>';
		echo '<option value= "icmp">icmp</option>';
		echo '<option value= "ip">ip</option>';
		echo '<option value= "igmp">igmp</option>';
		echo '<option value= "ipinip">ipinip</option>';
		echo '<option value= "nos">nos</option>';
		echo '<option value= "ospf">ospf</option>';
		echo '<option selected="selected" value= "pcp">pcp</option>';
		echo '<option value= "pim">pim</option>';
		echo '<option value= "sctp">sctp</option>';
		echo '<option value= "tcp">tcp</option>';
		echo '<option value= "udp">udp</option>';
	}

	else if(in_array("pim", $regla)){
		echo '<option value= "ahp">ahp</option>';
		echo '<option value= "eigrp">eigrp</option>';
		echo '<option value= "esp">esp</option>';
		echo '<option value= "gre">gre</option>';
		echo '<option value= "icmp">icmp</option>';
		echo '<option value= "ip">ip</option>';
		echo '<option value= "igmp">igmp</option>';
		echo '<option value= "ipinip">ipinip</option>';
		echo '<option value= "nos">nos</option>';
		echo '<option value= "ospf">ospf</option>';
		echo '<option value= "pcp">pcp</option>';
		echo '<option selected="selected" value= "pim">pim</option>';
		echo '<option value= "sctp">sctp</option>';
		echo '<option value= "tcp">tcp</option>';
		echo '<option value= "udp">udp</option>';
	}	

	else if(in_array("sctp", $regla)){
		echo '<option value= "ahp">ahp</option>';
		echo '<option value= "eigrp">eigrp</option>';
		echo '<option value= "esp">esp</option>';
		echo '<option value= "gre">gre</option>';
		echo '<option value= "icmp">icmp</option>';
		echo '<option value= "ip">ip</option>';
		echo '<option value= "igmp">igmp</option>';
		echo '<option value= "ipinip">ipinip</option>';
		echo '<option value= "nos">nos</option>';
		echo '<option value= "ospf">ospf</option>';
		echo '<option value= "pcp">pcp</option>';
		echo '<option value= "pim">pim</option>';
		echo '<option selected="selected" value= "sctp">sctp</option>';
		echo '<option value= "tcp">tcp</option>';
		echo '<option value= "udp">udp</option>';
	}	

	else if(in_array("tcp", $regla)){
		echo '<option value= "ahp">ahp</option>';
		echo '<option value= "eigrp">eigrp</option>';
		echo '<option value= "esp">esp</option>';
		echo '<option value= "gre">gre</option>';
		echo '<option value= "icmp">icmp</option>';
		echo '<option value= "ip">ip</option>';
		echo '<option value= "igmp">igmp</option>';
		echo '<option value= "ipinip">ipinip</option>';
		echo '<option value= "nos">nos</option>';
		echo '<option value= "ospf">ospf</option>';
		echo '<option value= "pcp">pcp</option>';
		echo '<option value= "pim">pim</option>';
		echo '<option value= "sctp">sctp</option>';
		echo '<option selected="selected" value= "tcp">tcp</option>';
		echo '<option value= "udp">udp</option>';
	}	

	else if(in_array("udp", $regla)){
		echo '<option value= "ahp">ahp</option>';
		echo '<option value= "eigrp">eigrp</option>';
		echo '<option value= "esp">esp</option>';
		echo '<option value= "gre">gre</option>';
		echo '<option value= "icmp">icmp</option>';
		echo '<option value= "ip">ip</option>';
		echo '<option value= "igmp">igmp</option>';
		echo '<option value= "ipinip">ipinip</option>';
		echo '<option value= "nos">nos</option>';
		echo '<option value= "ospf">ospf</option>';
		echo '<option value= "pcp">pcp</option>';
		echo '<option value= "pim">pim</option>';
		echo '<option value= "sctp">sctp</option>';
		echo '<option value= "tcp">tcp</option>';
		echo '<option selected="selected" value= "udp">udp</option>';
	}	
	
}

function OrigenExtended($regla,$nm)
{
	if($regla[4] =='host'){
		echo '<th> Host : <input placeholder="X.X.X.X" value='.$regla[5].' type="text" name=OrigenHost'.$nm.'><br>';
		echo ' RED : <input placeholder="ANY" value="" type="text" name=Origen'.$nm.'><br>';
		echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Origen_Wild'.$nm.'><br></th>';
	}

	else if($regla[4] =='any')
	{
		echo '<th> Host : <input placeholder="X.X.X.X" value="" type="text" name=OrigenHost'.$nm.'><br>';
		echo ' RED : <input placeholder="ANY" value="ANY" type="text" name=Origen'.$nm.'><br>';
		echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Origen_Wild'.$nm.'><br></th>';
	}

	else 
	{
		echo '<th> Host : <input placeholder="X.X.X.X" value="" type="text" name=OrigenHost'.$nm.'><br>';
		echo ' RED : <input placeholder="ANY" value='.$regla[4].' type="text" name=Origen'.$nm.'><br>';
		echo ' Wildcard : <input placeholder="X.X.X.X" value='.$regla[5].' type="text" name=Origen_Wild'.$nm.'><br></th>';
	}

}

function OrigenExtendedPort($regla)
{
	if($regla[3] == 'tcp' || $regla[3] == 'udp'){
		if($regla[4] == 'any'){
//solo aplica para any como origen y luego se busca un puerto si lo hay 
			if($regla[5] =='eq'){
				echo '<option value= 0>Elige</option>';
				echo '<option selected="selected" value= "eq">equals</option>';
				echo '<option value= "neq">not equals</option>';
				echo '<option value= "lt">lower than</option>';
				echo '<option value= "gt">greater than</option>';
			}

		else if($regla[5] =='neq'){//solo puede estar en la pocision 6,5
			echo '<option value= 0>Elige</option>';
			echo '<option value= "eq">equals</option>';
			echo '<option selected="selected" value= "neq">not equals</option>';
			echo '<option value= "lt">lower than</option>';
			echo '<option value= "gt">greater than</option>';
		}

		else if($regla[5] =='lt'){//solo puede estar en la pocision 6,5
			echo '<option value= 0>Elige</option>';
			echo '<option value= "eq">equals</option>';
			echo '<option value= "neq">not equals</option>';
			echo '<option selected="selected" value= "lt">lower than</option>';
			echo '<option value= "gt">greater than</option>';
		}

		else if($regla[5] =='gt'){//solo puede estar en la pocision 6,5
			echo '<option value= 0>Elige</option>';
			echo '<option value= "eq">equals</option>';
			echo '<option value= "neq">not equals</option>';
			echo '<option value= "lt">lower than</option>';
			echo '<option selected="selected" value= "gt">greater than</option>';
		}

		else {
			echo '<option selected="selected" value= 0>Elige</option>';
			echo '<option value= "eq">equals</option>';
			echo '<option value= "neq">not equals</option>';
			echo '<option value= "lt">lower than</option>';
			echo '<option value= "gt">greater than</option>';

		} 
	}
	else 
	{
	     if($regla[5] =='eq' || $regla[6] =='eq'){//solo puede estar en la pocision 6,5
	     	echo '<option value= 0>Elige</option>';
	     	echo '<option selected="selected" value= "eq">equals</option>';
	     	echo '<option value= "neq">not equals</option>';
	     	echo '<option value= "lt">lower than</option>';
	     	echo '<option value= "gt">greater than</option>';
	     }

		else if($regla[5] =='neq' || $regla[6] =='neq'){//solo puede estar en la pocision 6,5
			echo '<option value= 0>Elige</option>';
			echo '<option value= "eq">equals</option>';
			echo '<option selected="selected" value= "neq">not equals</option>';
			echo '<option value= "lt">lower than</option>';
			echo '<option value= "gt">greater than</option>';
		}

		else if($regla[5] =='lt' || $regla[6] =='lt'){//solo puede estar en la pocision 6,5
			echo '<option value= 0>Elige</option>';
			echo '<option value= "eq">equals</option>';
			echo '<option value= "neq">not equals</option>';
			echo '<option selected="selected" value= "lt">lower than</option>';
			echo '<option value= "gt">greater than</option>';
		}

		else if($regla[5] =='gt' || $regla[6] =='gt'){//solo puede estar en la pocision 6,5
			echo '<option value= 0>Elige</option>';
			echo '<option value= "eq">equals</option>';
			echo '<option value= "neq">not equals</option>';
			echo '<option value= "lt">lower than</option>';
			echo '<option selected="selected" value= "gt">greater than</option>';
		}

		else {
			echo '<option selected="selected" value= 0>Elige</option>';
			echo '<option value= "eq">equals</option>';
			echo '<option value= "neq">not equals</option>';
			echo '<option value= "lt">lower than</option>';
			echo '<option value= "gt">greater than</option>';
		}
	}
}
else
{
	echo '<option selected="selected" value= 0>Elige</option>';
	echo '<option value= "eq">equals</option>';
	echo '<option value= "neq">not equals</option>';
	echo '<option value= "lt">lower than</option>';
	echo '<option value= "gt">greater than</option>';
}

}


function OrigenExtendedPortNum($regla,$nm)
{
	if($regla[3] == 'tcp' || $regla[3] == 'udp'){
		if($regla[4] == 'any'){

		if(array_key_exists(5,$regla) && $regla[5] =='eq' ){//solo puede estar en la pocision 6,5
			if($regla[5] =='eq' && array_key_exists(5,$regla))
				echo '<th> <input placeholder="Port" value = '.$regla[6].' type="text" name=PuertoNum'.$nm.'><br></th>';
		}
		else if(array_key_exists(5,$regla) && $regla[5] =='neq' && array_key_exists(5,$regla)){//solo puede estar en la pocision 6,5
			if($regla[5] =='neq' && array_key_exists(5,$regla))
				echo '<th> <input placeholder="Port" value = '.$regla[6].' type="text" name=PuertoNum'.$nm.'><br></th>';
		}
		else if(array_key_exists(5,$regla) && $regla[5] =='lt'){//solo puede estar en la pocision 6,5
			if($regla[5] =='lt' && array_key_exists(5,$regla))
				echo '<th> <input placeholder="Port" value = '.$regla[6].' type="text" name=PuertoNum'.$nm.'><br></th>';
		}
		else if(array_key_exists(5,$regla) && $regla[5] =='gt'){//solo puede estar en la pocision 6,5
			if($regla[5] =='gt' && array_key_exists(5,$regla))
				echo '<th> <input placeholder="Port" value = '.$regla[6].' type="text" name=PuertoNum'.$nm.'><br></th>';
		}

		else {
			echo '<th> <input placeholder="Port" type="text" name=PuertoNum'.$nm.'><br></th>';
		}
	}
	else {
	     if(array_key_exists(5,$regla) && $regla[5] =='eq' ){//solo puede estar en la pocision 6,5
	     	if($regla[5] =='eq' && array_key_exists(5,$regla))
	     		echo '<th> <input placeholder="Port" value = '.$regla[6].' type="text" name=PuertoNum'.$nm.'><br></th>';
	     	else if($regla[6] =='eq' && array_key_exists(6,$regla))
	     		echo '<th> <input placeholder="Port" value = '.$regla[7].' type="text" name=PuertoNum'.$nm.'><br></th>';
	     }
		if( array_key_exists(6,$regla) &&  $regla[6] =='eq' ){//solo puede estar en la pocision 6,5
			if($regla[5] =='eq' && array_key_exists(5,$regla))
				echo '<th> <input placeholder="Port" value = '.$regla[6].' type="text" name=PuertoNum'.$nm.'><br></th>';
			else if($regla[6] =='eq' && array_key_exists(6,$regla))
				echo '<th> <input placeholder="Port" value = '.$regla[7].' type="text" name=PuertoNum'.$nm.'><br></th>';
		}

		else if(array_key_exists(5,$regla) && $regla[5] =='neq' && array_key_exists(5,$regla)){//solo puede estar en la pocision 6,5
			if($regla[5] =='neq' && array_key_exists(5,$regla))
				echo '<th> <input placeholder="Port" value = '.$regla[6].' type="text" name=PuertoNum'.$nm.'><br></th>';
			else if($regla[6] =='neq' && array_key_exists(6,$regla))
				echo '<th> <input placeholder="Port" value = '.$regla[7].' type="text" name=PuertoNum'.$nm.'><br></th>';	
		}

		else if(array_key_exists(6,$regla) && $regla[6] =='neq'){//solo puede estar en la pocision 6,5
			if($regla[5] =='neq' && array_key_exists(5,$regla))
				echo '<th> <input placeholder="Port" value = '.$regla[6].' type="text" name=PuertoNum'.$nm.'><br></th>';
			else if($regla[6] =='neq' && array_key_exists(6,$regla))
				echo '<th> <input placeholder="Port" value = '.$regla[7].' type="text" name=PuertoNum'.$nm.'><br></th>';	
		}

		else if(array_key_exists(5,$regla) && $regla[5] =='lt'){//solo puede estar en la pocision 6,5
			if($regla[5] =='lt' && array_key_exists(5,$regla))
				echo '<th> <input placeholder="Port" value = '.$regla[6].' type="text" name=PuertoNum'.$nm.'><br></th>';
			else if($regla[6] =='lt' && array_key_exists(6,$regla))
				echo '<th> <input placeholder="Port" value = '.$regla[7].' type="text" name=PuertoNum'.$nm.'><br></th>';
		}

		else if(array_key_exists(6,$regla) && $regla[6] =='lt'){//solo puede estar en la pocision 6,5
			if($regla[5] =='lt' && array_key_exists(5,$regla))
				echo '<th> <input placeholder="Port" value = '.$regla[6].' type="text" name=PuertoNum'.$nm.'><br></th>';
			else if($regla[6] =='lt' && array_key_exists(6,$regla))
				echo '<th> <input placeholder="Port" value = '.$regla[7].' type="text" name=PuertoNum'.$nm.'><br></th>';
		}
		else if(array_key_exists(5,$regla) && $regla[5] =='gt'){//solo puede estar en la pocision 6,5
			if($regla[5] =='gt' && array_key_exists(5,$regla))
				echo '<th> <input placeholder="Port" value = '.$regla[6].' type="text" name=PuertoNum'.$nm.'><br></th>';
			else if($regla[6] =='gt' && array_key_exists(6,$regla))
				echo '<th> <input placeholder="Port" value = '.$regla[7].' type="text" name=PuertoNum'.$nm.'><br></th>';
		}
		else if(array_key_exists(6,$regla) && $regla[6] =='gt'){//solo puede estar en la pocision 6,5
			if($regla[5] =='gt' && array_key_exists(5,$regla))
				echo '<th> <input placeholder="Port" value = '.$regla[6].' type="text" name=PuertoNum'.$nm.'><br></th>';
			else if($regla[6] =='gt' && array_key_exists(6,$regla))
				echo '<th> <input placeholder="Port" value = '.$regla[7].' type="text" name=PuertoNum'.$nm.'><br></th>';
		}

		else {
			echo '<th> <input placeholder="Port" type="text" name=PuertoNum'.$nm.'><br></th>';
		}

	}

}
else
{
	echo '<th> <input placeholder="Port" type="text" name=PuertoNum'.$nm.'><br></th>';
}

}



function DstExtendedPortNum($regla,$nm)
{
	$pos = count($regla);
	$x = $pos-2; //La penultima poscion contiene el match del puerto destino en caso que exista
	$y = $pos -1; //La ultima pocision contiene el numero de puerto si existe
	if($regla[3] == 'tcp' || $regla[3] == 'udp'){

	    if(array_key_exists($x,$regla) && $regla[$x] =='eq' ){//solo puede estar en la pocision 6,5

	    	echo '<th> <input placeholder="Port" value = '.$regla[$y].' type="text" name=PuertoNum2'.$nm.'><br></th>';

	    }
	     else if(array_key_exists($x,$regla) && $regla[$x] =='neq' ){//solo puede estar en la pocision 6,5
	     	
	     	echo '<th> <input placeholder="Port" value = '.$regla[$y].' type="text" name=PuertoNum2'.$nm.'><br></th>';
	     	
	     }

	     else if(array_key_exists($x,$regla) && $regla[$x] =='lt' ){//solo puede estar en la pocision 6,5

	     	echo '<th> <input placeholder="Port" value = '.$regla[$y].' type="text" name=PuertoNum2'.$nm.'><br></th>';
	     	
	     }

	     else if(array_key_exists($x,$regla) && $regla[$x] =='gt' ){//solo puede estar en la pocision 6,5
	     	echo '<th> <input placeholder="Port" value = '.$regla[$y].' type="text" name=PuertoNum2'.$nm.'><br></th>';
	     	
	     }

	     else {
	     	echo '<th> <input placeholder="Port" type="text" name=PuertoNum2'.$nm.'><br></th>';
	     }
	 }
	 else
	 {
	 	echo '<th> <input placeholder="Port" type="text" name=PuertoNum2'.$nm.'><br></th>';
	 }

	}


	function DstExtendedPort($regla,$nm){
		$pos = count($regla);

	$x = $pos-2; //La penultima poscion contiene el match del puerto destino en caso que exista
	$y = $pos -1; //La ultima pocision contiene el numero de puerto si existe
	if($regla[3] == 'tcp' || $regla[3] == 'udp'){

	    if(array_key_exists($x,$regla) && $regla[$x] =='eq' ){//solo puede estar en la pocision 6,5
	    	echo '<option value= 0>Elige</option>';
	    	echo '<option selected="selected" value= "eq">equals</option>';
	    	echo '<option value= "neq">not equals</option>';
	    	echo '<option value= "lt">lower than</option>';
	    	echo '<option value= "gt">greater than</option>';

	    }
	     else if(array_key_exists($x,$regla) && $regla[$x] =='neq' ){//solo puede estar en la pocision 6,5
	     	echo '<option value= 0>Elige</option>';
	     	echo '<option value= "eq">equals</option>';
	     	echo '<option selected="selected" value= "neq">not equals</option>';
	     	echo '<option value= "lt">lower than</option>';
	     	echo '<option value= "gt">greater than</option>';
	     	
	     }

	     else if(array_key_exists($x,$regla) && $regla[$x] =='lt' ){//solo puede estar en la pocision 6,5
	     	echo '<option value= 0>Elige</option>';
	     	echo '<option value= "eq">equals</option>';
	     	echo '<option value= "neq">not equals</option>';
	     	echo '<option selected="selected" value= "lt">lower than</option>';
	     	echo '<option value= "gt">greater than</option>';	
	     }

	     else if(array_key_exists($x,$regla) && $regla[$x] =='gt' ){//solo puede estar en la pocision 6,5
	     	echo '<option value= 0>Elige</option>';
	     	echo '<option value= "eq">equals</option>';
	     	echo '<option value= "neq">not equals</option>';
	     	echo '<option value= "lt">lower than</option>';
	     	echo '<option selected="selected" value= "gt">greater than</option>';  	
	     }

	     else {
	     	echo '<option selected="selected" value= 0>Elige</option>';
	     	echo '<option value= "eq">equals</option>';
	     	echo '<option value= "neq">not equals</option>';
	     	echo '<option value= "lt">lower than</option>';
	     	echo '<option value= "gt">greater than</option>';		
	     }
	 }
	 else
	 {
	 	echo '<option selected="selected" value= 0>Elige</option>';
	 	echo '<option value= "eq">equals</option>';
	 	echo '<option value= "neq">not equals</option>';
	 	echo '<option value= "lt">lower than</option>';
	 	echo '<option value= "gt">greater than</option>';
	 }

	}

	function DstExtended($regla,$nm)
	{
		if($regla[3] == 'tcp' || $regla[3] == 'udp')
		{
			{
			//Protocolo TCP/ UDP
   			//6		acesslist 101 permit Protoclo any any 
				if(count($regla) == 6)
				{
					echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
					echo ' RED : <input placeholder="ANY" value="ANY" type="text" name= Dst'.$nm.'><br>';
					echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';	
				}

			//7		acesslist 101 permit Protoclo host 	IP 	Any
			//7		acesslist 101 permit Protoclo  Any host	IP
				else if(count($regla) == 7)
				{
					if( strpos($regla[6], 'any') !== false){
						echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
						echo ' RED : <input placeholder="ANY" value="ANY" type="text" name= Dst'.$nm.'><br>';
						echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';	
					}
					else if( strpos($regla[5], 'host') !== false){
						echo '<th> Host: <input placeholder="X.X.X.X" value='.$regla[6].' type="text" name= DstHost'.$nm.'><br>';
						echo ' RED : <input placeholder="ANY" value="ANY" type="text" name= Dst'.$nm.'><br>';
						echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';	
					}
					else if( strpos($regla[4], 'any') !== false){
						echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
						echo ' RED : <input placeholder="ANY" value='.$regla[5].' type="text" name= Dst'.$nm.'><br>';
						echo ' Wildcard : <input placeholder="X.X.X.X" value='.$regla[6].' type="text" name=Destino_Wild'.$nm.'><br></th>';	
					}
				}
			/*
   			
   			8		acesslist 101 permit Protoclo any tipoPuerto numPuerto any
   			8		acesslist 101 permit Protoclo any any tipoPuerto numPuerto
	
			8		acesslist 101 permit Protoclo host 	IP 		host 	IP
			8		acesslist 101 permit Protoclo  IP 	wildacard 	host 	IP
			8		acesslist 101 permit Protoclo host 	IP 		IP 		wildcard
			8		acesslist 101 permit Protoclo  IP 	wildacard 	IP 		wildacard
			*/

			else if(count($regla) == 8)
			{

				if(( strpos($regla[7], 'any') !== false) || ( strpos($regla[5], 'any') !== false)){
					echo '<th> Host: <input placeholder="X.X.X.X" value = "" type="text" name= DstHost'.$nm.'><br>';
					echo ' RED : <input placeholder="ANY" value="ANY" type="text" name= Dst'.$nm.'><br>';
					echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';	
				}

				else if( strpos($regla[6], 'host') !== false){
					echo '<th> Host: <input placeholder="X.X.X.X" value='.$regla[7].' type="text" name= DstHost'.$nm.'><br>';
					echo ' RED : <input placeholder="ANY" value="" type="text" name= Dst'.$nm.'><br>';
					echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';	
				}

				else{
					echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
					echo ' RED : <input placeholder="ANY" value='.$regla[6].' type="text" name= Dst'.$nm.'><br>';
					echo ' Wildcard : <input placeholder="X.X.X.X" value='.$regla[7].' type="text" name=Destino_Wild'.$nm.'><br></th>';	
				}
			}		

			/*
   			9		acesslist 101 permit Protoclo host 	IP   tipoPuerto numPuerto	Any /
   			9		acesslist 101 permit Protoclo host 	IP 	             Any tipoPuerto numPuerto /
   			9		acesslist 101 permit Protoclo any tipoPuerto numPuerto	    host 	IP   /
   			9		acesslist 101 permit Protoclo any 					host IP  tipoPuerto numPuerto /
   			9		acesslist 101 permit protocol ip wild  tipoPuerto numPuerto       any /
   			9		acesslist 101 permit protocol ip wild               any tipoPuerto numPuerto /
			9		acesslist 101 permit protocol  any tipoPuerto numPuerto   ip wild 
			9		acesslist 101 permit protocol  any      IP wild tipoPuerto numPuerto
			*/
			else if(count($regla) == 9)
			{

				if((strpos($regla[8], 'any') !== false) || (strpos($regla[6], 'any') !== false)){
					echo '<th> Host: <input placeholder="X.X.X.X" value = "" type="text" name= DstHost'.$nm.'><br>';
					echo ' RED : <input placeholder="ANY" value="ANY" type="text" name= Dst'.$nm.'><br>';
					echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';	
				}
				else if( strpos($regla[7], 'host') !== false){
					echo '<th> Host: <input placeholder="X.X.X.X" value='.$regla[8].' type="text" name= DstHost'.$nm.'><br>';
					echo ' RED : <input placeholder="ANY" value="" type="text" name= Dst'.$nm.'><br>';
					echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';	
				}
				else if( strpos($regla[5], 'host') !== false){
					echo '<th> Host: <input placeholder="X.X.X.X" value='.$regla[6].' type="text" name= DstHost'.$nm.'><br>';
					echo ' RED : <input placeholder="ANY" value="" type="text" name= Dst'.$nm.'><br>';
					echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';	
				}
				else if(strpos($regla[4], 'any') !== false){
					if($regla[5] =='eq' || $regla[5] =='neq' || $regla[5] =='lt' || $regla[5] =='gt'){
						echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
						echo ' RED : <input placeholder="ANY" value='.$regla[7].' type="text" name= Dst'.$nm.'><br>';
						echo ' Wildcard : <input placeholder="X.X.X.X" value='.$regla[8].' type="text" name=Destino_Wild'.$nm.'><br></th>';	
					}
					else if($regla[7] =='eq' || $regla[7] =='neq' || $regla[7] =='lt' || $regla[7] =='gt'){
						echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
						echo ' RED : <input placeholder="ANY" value='.$regla[5].' type="text" name= Dst'.$nm.'><br>';
						echo ' Wildcard : <input placeholder="X.X.X.X" value='.$regla[6].' type="text" name=Destino_Wild'.$nm.'><br></th>';	
					}	
				}
				
				else{
					echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
					echo ' RED : <input placeholder="ANY" value="" type="text" name= Dst'.$nm.'><br>';
					echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';	
				}
			}	


/*	
10		acesslist 101 permit Protoclo host 	IP 	tipoPuerto numPuerto	host 	IP   /
10		acesslist 101 permit Protoclo host 	IP 		host 	IP  tipoPuerto numPuerto /
10		acesslist 101 permit Protoclo  IP 	wildacard tipoPuerto numPuerto	host 	IP /
10		acesslist 101 permit Protoclo  IP 	wildacard 	host 	IP tipoPuerto numPuerto /
10		acesslist 101 permit Protoclo host 	IP 	tipoPuerto numPuerto	IP 		wildcard  /
10		acesslist 101 permit Protoclo host 	IP 		IP 		wildcard  tipoPuerto numPuerto /
10		acesslist 101 permit Protoclo  IP 	wildacard tipoPuerto numPuerto	IP 		wildacard 
10		acesslist 101 permit Protoclo  IP 	wildacard 	IP 		wildacard tipoPuerto numPuerto
10		acesslist 101 permit Protoclo any tipoPuerto numPuerto any tipoPuerto numPuerto  
*/
else if(count($regla) == 10)
{
	if(strpos($regla[6], 'host') !== false){
		echo '<th> Host: <input placeholder="X.X.X.X" value='.$regla[7].' type="text" name= DstHost'.$nm.'><br>';
		echo ' RED : <input placeholder="ANY" value="" type="text" name= Dst'.$nm.'><br>';
		echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';	
	}
	else if(strpos($regla[8],'host') !== false){
		echo '<th> Host: <input placeholder="X.X.X.X" value='.$regla[9].' type="text" name= DstHost'.$nm.'><br>';
		echo ' RED : <input placeholder="ANY" value="" type="text" name= Dst'.$nm.'><br>';
		echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';	
	}
	else if( strpos($regla[4], 'host') !== false){
		if($regla[6] =='eq' || $regla[6] =='neq' || $regla[6] =='lt' || $regla[6] =='gt'){
			echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
			echo ' RED : <input placeholder="ANY" value='.$regla[8].' type="text" name= Dst'.$nm.'><br>';
			echo ' Wildcard : <input placeholder="X.X.X.X" value='.$regla[9].' type="text" name=Destino_Wild'.$nm.'><br></th>';	
		}
		else if($regla[8] =='eq' || $regla[8] =='neq' || $regla[8] =='lt' || $regla[8] =='gt'){
			echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
			echo ' RED : <input placeholder="ANY" value='.$regla[6].' type="text" name= Dst'.$nm.'><br>';
			echo ' Wildcard : <input placeholder="X.X.X.X" value='.$regla[7].' type="text" name=Destino_Wild'.$nm.'><br></th>';	
		}

	}
	else if(strpos($regla[7], 'any') !== false){
		echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
		echo ' RED : <input placeholder="ANY" value="ANY" type="text" name= Dst'.$nm.'><br>';
		echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';	
	}
	else if($regla[6] =='eq' || $regla[6] =='neq' || $regla[6] =='lt' || $regla[6] =='gt'){
		echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
		echo ' RED : <input placeholder="ANY" value='.$regla[8].' type="text" name= Dst'.$nm.'><br>';
		echo ' Wildcard : <input placeholder="X.X.X.X" value='.$regla[9].' type="text" name=Destino_Wild'.$nm.'><br></th>';	
	}	
	else if($regla[8] =='eq' || $regla[8] =='neq' || $regla[8] =='lt' || $regla[8] =='gt'){
		echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
		echo ' RED : <input placeholder="ANY" value='.$regla[6].' type="text" name= Dst'.$nm.'><br>';
		echo ' Wildcard : <input placeholder="X.X.X.X" value='.$regla[7].' type="text" name=Destino_Wild'.$nm.'><br></th>';	
	}	
	else{
		echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
		echo ' RED : <input placeholder="ANY" value="" type="text" name= Dst'.$nm.'><br>';
		echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';	
	}
}	
			/*
			11		acesslist 101 permit Protoclo any tipoPuerto numPuerto	host 	IP tipoPuerto numPuerto /
			11		acesslist 101 permit protocol ip wild  tipoPuerto numPuerto any tipoPuerto numPuerto /
			11		acesslist 101 permit Protoclo host 	IP tipoPuerto numPuerto	Any tipoPuerto numPuerto / 
			11		acesslist 101 permit protocol  any tipoPuerto numPuerto ip wild tipoPuerto numPuerto 
			11		acesslist 101 permit Protoclo host 	IP 	tipoPuerto numPuerto	host 	IP  tipoPuerto numPuerto /
			
			*/
			else if(count($regla) == 11)
			{
				if( strpos($regla[7], 'host') !== false){
					echo '<th> Host: <input placeholder="X.X.X.X" value='.$regla[8].' type="text" name= DstHost'.$nm.'><br>';
					echo ' RED : <input placeholder="ANY" value="" type="text" name= Dst'.$nm.'><br>';
					echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';	
				}
				else if(strpos($regla[8], 'any') !== false){
					echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
					echo ' RED : <input placeholder="ANY" value="ANY" type="text" name= Dst'.$nm.'><br>';
					echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';	
				}

				else if($regla[5] =='eq' || $regla[5] =='neq' || $regla[5] =='lt' || $regla[5] =='gt'){
					echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
					echo ' RED : <input placeholder="ANY" value='.$regla[7].' type="text" name= Dst'.$nm.'><br>';
					echo ' Wildcard : <input placeholder="X.X.X.X" value='.$regla[8].' type="text" name=Destino_Wild'.$nm.'><br></th>';	

				}
			}



			/*12    acesslist 101 permit Protoclo  IP 	wildacard tipoPuerto numPuerto	host 	IP tipoPuerto numPuerto 
			12		acesslist 101 permit Protoclo  IP 	wildacard tipoPuerto numPuerto	IP 		wildacard tipoPuerto numPuerto
			12		acesslist 101 permit Protoclo host 	IP 	tipoPuerto numPuerto	IP 		wildcard  tipoPuerto numPuerto
			*/

			else if(count($regla) == 12)
			{

				if( strpos($regla[8], 'host') !== false){
					echo '<th> Host: <input placeholder="X.X.X.X" value='.$regla[9].' type="text" name= DstHost'.$nm.'><br>';
					echo ' RED : <input placeholder="ANY" value="" type="text" name= Dst'.$nm.'><br>';
					echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';	
				}

				else if($regla[10] =='eq' || $regla[10] =='neq' || $regla[10] =='lt' || $regla[10] =='gt'){
					echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
					echo ' RED : <input placeholder="ANY" value='.$regla[8].' type="text" name= Dst'.$nm.'><br>';
					echo ' Wildcard : <input placeholder="X.X.X.X" value='.$regla[9].' type="text" name=Destino_Wild'.$nm.'><br></th>';	

				}
			}	

		}
	}
	else {
			/* Protocolo distinto de TCP/ UDP
   			6		acesslist 101 permit Protoclo any any 

   			7		acesslist 101 permit Protoclo host 	IP 	Any
   			7		acesslist 101 permit Protoclo any 		host 	IP
			7		acesslist 101 permit protocol ip wild any
			7		acesslist 101 permit protocol  any  ip wild

			8		acesslist 101 permit Protoclo host 	IP 		host 	IP
			8		acesslist 101 permit Protoclo  IP 	wildacard 	host 	IP
			8		acesslist 101 permit Protoclo host 	IP 		IP 		wildcard
			8		acesslist 101 permit Protoclo  IP 	wildacard 	IP 		wildacard*/
			if(count($regla) == 6)
			{
				echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
				echo ' RED : <input placeholder="ANY" value="ANY" type="text" name= Dst'.$nm.'><br>';
				echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';	
			}

			else if(count($regla) == 7)
			{
				if( strpos($regla[6], 'any') !== false){
					echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
					echo ' RED : <input placeholder="ANY" value="ANY" type="text" name= Dst'.$nm.'><br>';
					echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';	
				}
				else if( strpos($regla[5], 'host') !== false){
					echo '<th> Host: <input placeholder="X.X.X.X" value='.$regla[6].' type="text" name= DstHost'.$nm.'><br>';
					echo ' RED : <input placeholder="ANY" value="ANY" type="text" name= Dst'.$nm.'><br>';
					echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';	
				}
				else if( strpos($regla[4], 'any') !== false){
					echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
					echo ' RED : <input placeholder="ANY" value='.$regla[5].' type="text" name= Dst'.$nm.'><br>';
					echo ' Wildcard : <input placeholder="X.X.X.X" value='.$regla[6].' type="text" name=Destino_Wild'.$nm.'><br></th>';	
				}
			}

			else if(count($regla) == 8)
			{

				if( strpos($regla[6], 'host') !== false){
					echo '<th> Host: <input placeholder="X.X.X.X" value='.$regla[7].' type="text" name= DstHost'.$nm.'><br>';
					echo ' RED : <input placeholder="ANY" value="" type="text" name= Dst'.$nm.'><br>';
					echo ' Wildcard : <input placeholder="X.X.X.X" value="" type="text" name=Destino_Wild'.$nm.'><br></th>';	
				}
				else{
					echo '<th> Host: <input placeholder="X.X.X.X" value="" type="text" name= DstHost'.$nm.'><br>';
					echo ' RED : <input placeholder="ANY" value='.$regla[6].' type="text" name= Dst'.$nm.'><br>';
					echo ' Wildcard : <input placeholder="X.X.X.X" value='.$regla[7].' type="text" name=Destino_Wild'.$nm.'><br></th>';	
				}
			}		
		}
		


	}


	?>
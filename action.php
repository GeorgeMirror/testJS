<? 
//Phone-number test. This time I like see 10 digits.
function testPh($ph){
	if(preg_match("/^[0-9]{10}$/", $ph)) {
		return true;
	}
	else{
		return false;
	}
}

//Add element work
function addNewElement($ph,$nm){
	$file = file_get_contents ( "bd.txt" );
	$f = 0;
	$stroki=explode("-", $file);
	$sMax=count($stroki);
	for ($i=0; $i<$sMax;$i=$i+2){
		$stroki[$i]=trim($stroki[$i]);
			if ($stroki[$i]==$ph){
				$f++;
				echo "We have it already";
			}
	}
	if ($f == 0) {
		file_put_contents ( "bd.txt" , $ph."-".$nm."-\n", FILE_APPEND);
		echo "Done";
	}
}

//Edit element work
function editElement($ph, $nm){
	$file = file_get_contents ( "bd.txt" );
	$f = 0;
	$stroki=explode("-", $file);
	$sMax=count($stroki);
	$newMass="";
	for ($i=0; $i<$sMax-1;$i=$i+2){
		$stroki[$i]=trim($stroki[$i]);
		if ($stroki[$i] != $ph){
			$newMass .= $stroki[$i]."-".$stroki[$i+1]."-\n";
		}
		else{
			echo "updated";
			$newMass .= $stroki[$i]."-".$nm."-\n";
			$f=$f+2;
		}
	}
	if ($f==0) {
		echo "We have not like this";
	}			
	file_put_contents ("bd.txt" ,$newMass);
	echo "Done";
}

//Delete element work
function deleteElement($ph){
	$file = file_get_contents ( "bd.txt" );
	$f = 0;
	$stroki=explode("-", $file);
	$sMax=count($stroki);
	$newMass="";
	for ($i=0; $i<$sMax-2;$i=$i+2){
		$stroki[$i]=trim($stroki[$i]);
		if ($stroki[$i] != $_GET['Rph']){
			$newMass .= $stroki[$i]."-".$stroki[$i+1]."-\n";
		}
		else{
			echo "deleted";
			$f=$f+2;
		}
	}
	if ($f==0) {
		echo "We have not like this";
	}
	else{
		file_put_contents ("bd.txt" ,$newMass);
	}
}

//Add new element test-ask
if(isset($_GET['ph']) && isset($_GET['nm'])){
	if (testPh($_GET['ph'])){
		addNewElement($_GET['ph'],$_GET['nm']);
	}
	else{
		echo "This time phone must contain 10 digits";
	}
}

//Delete record test-ask
elseif(isset($_GET['Rph'])){
	if (testPh($_GET['Rph'])){ 
		deleteElement($_GET['Rph']);
	}
	else{
  	echo "This time phone must contain 10 digits";
	}
}

//Edit Record test-ask
elseif(isset($_GET['Eph']) && isset($_GET['Enm'])){
	if (testPh($_GET['Eph'])){  
		editElement($_GET['Eph'],$_GET['Enm']);
	}
	else{
		echo "This time phone must contain 10 digits";
	}
}

//Update by list work
elseif (isset($_GET['Upf'])){
	$fileMain = file_get_contents("bd.txt");
	$strokiMain = explode("-", $fileMain);
	$sMaxMain =  count($strokiMain);
	$fileUp = file_get_contents($_GET['Upf']);
	$strokiUp = explode("-", $fileUp);
	$sMaxUp = count($strokiUp);
	for($i = 0; $i < $sMaxMain-1; $i += 2){
		$f = 0;
		$strokiMain[$i]=trim($strokiMain[$i]);
		for ($j = 0; $j < $sMaxUp-1; $j = $j + 2){
			$strokiUp[$j]=trim($strokiUp[$j]);
			if ($strokiMain[$i] == $strokiUp[$j]){
				$f=1;
			}
		}
		if ($f==0){
			$fileUp .= $strokiMain[$i]."-".$strokiMain[$i+1]."-\n";
		}
	}
	file_put_contents ("bd.txt" ,$fileUp);
}
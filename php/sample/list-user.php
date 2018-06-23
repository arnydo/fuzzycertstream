<?php 
	require 'db.php';
 		
 		$sqltran = mysqli_query($con, "SELECT * FROM user ")or die(mysqli_error($con));
		$arrVal = array();
 		
		$i=1;
 		while ($rowList = mysqli_fetch_array($sqltran)) {
 								 
						$name = array(
								'num' => $i,
 	 		 	 				'first'=> $rowList['fname'],
	 		 	 				'last'=> $rowList['lname']
 	 		 	 			);		


							array_push($arrVal, $name);	
			$i++;			
	 	}
	 		 echo  json_encode($arrVal);		
 

	 	mysqli_close($con);
?>   
 
<?php session_start();
require('connection.php');

if(isset($_POST['sbItms'])){
	
	$result = "";
	$varInView=$_POST['sbItms'];
	if($varInView=="inc"){
		
		$result = mysql_query("SELECT * FROM income_type_tbl ORDER BY income_name ASC") or die(mysql_error());
		$colName = "income_name";
		$genOption = "<option value='allInc'>All income</option>";	
	}
	else if($varInView=="exp"){
		
		$result = mysql_query("SELECT * FROM expenses_tbl ORDER BY expns_name ASC") or die(mysql_error());
		$colName = "expns_name";
		$genOption = "<option value='allExp'>All Expenditure</option>";
	}
							
	if(mysql_num_rows($result)>0){
		echo"<option value=''>Select item here</option>";	
		echo $genOption;							
		for($i=0; $i<mysql_num_rows($result);$i++){
			
			$id = mysql_result($result,$i,'id') or die(mysql_error());
			$itemName = mysql_result($result,$i,$colName) or die(mysql_error());
			
			echo"<option value='$id'>$itemName</option>";
		}
		
	}else{echo"<option value=''>No sub-item to select</option>";}

}

if(isset($_POST['svAmnt'])){
	
	$dataValues=$_POST['svAmnt'];
	
	$valArray= explode('@',$dataValues);
	$amount = $valArray[0];
	$subCtgryId = $valArray[1];
	$dateSaved = $valArray[2];
	
	if($dateSaved!="" and strlen($dateSaved)==10){
		
		if($amount!="" and is_numeric($amount)){
			
			if($subCtgryId){
			
				$query = mysql_query("INSERT INTO income_expens_tbl VALUES('','$subCtgryId','$amount','".$_SESSION['supMarketId']."','$dateSaved','".$_SESSION['username']."')");
				if($query){
					echo true;
				}
			}else{
				echo "<div class='alert alert-danger'><strong>Error:</strong> An error occured, please cross check your entries and try agein</div>";
			}
		}else{
			
			echo "<div class='alert alert-danger'><strong>Error:</strong> some of the values entered were <strong>Not Numeric</strong>, please cross check and try again</div>";
		}
	}else{
		echo "<div class='alert alert-danger'><strong>Error:</strong> You must select the entry <strong> Day,Month and Year</strong> in order to save your entries</div>";
	}

}
?>
<?php


function getClassNm($classId){
	
	$sqlStatement = mysql_query("SELECT * FROM classes WHERE id='$classId'");
	$name = mysql_result($sqlStatement,0,'className');
	return $name;
	
}

function getTopicNm($topicId){
	
	$sqlStatement = mysql_query("SELECT * FROM topics WHERE id='$topicId'");
	$tpName = mysql_result($sqlStatement,0,'topicName');
	return $tpName;
	
}

function getName($id){
	
	$sqlStatement = mysql_query("SELECT * FROM login WHERE id='$id'");
	$saverName = mysql_result($sqlStatement,0,'name');
	return $saverName;

}
?>
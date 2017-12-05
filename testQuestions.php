<?php ob_start(); session_start();

require("connection.php");
include('functionz.php');

if($_SESSION['name'] and $_SESSION['level']=="1"){
	
}//else {header('location:logout.php');}

$error="";
$action="";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
     <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  	<link rel="stylesheet" type="text/css" href="css/styles.css"/>
    <link href="css/layout.css" rel="stylesheet" type="text/css" />
     <script src="js/jquery-1.11.1.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
    <title>Learn Mathematics| Manage Users </title>
</head>
<body class="home2">
<div class="navbar  navbar-default navbar-fixed-top" style="padding-bottom:12px;   color:#fff;">
    <div class="container">
        <div class="navbar-header">
            
             <div class="navbar-brand">
             <a href="#"><strong>LEARN MATHEMATICS</strong></a><br/>
                <small style="font-size:13px;  color:#fff; ">it starts from here . . .</small>
            </div>
        </div>
        <ul class="nav navbar-nav pull-right">
            <li><a href="#"> <span class='glyphicon  glyphicon-user' style='margin-right:7px;'></span>Welcome,  <?php echo $_SESSION['name'];?></a></li> 
            <li><a href="changePsw.php"><span class='glyphicon  glyphicon-lock' style='margin-right:7px;'></span>Change password</a></li>
           	<li><a href="logout.php"><span class='glyphicon  glyphicon-log-out' style='margin-right:7px;'></span>Logout</a></li>
        </ul>
    </div>
</div>   
<?php
if(isset($_POST['submTest'])){
	
	$userAns = array();
	$userAns = $_SESSION['userAnswers'];
	$clsId = $_SESSION['clsId'];
	$topicId = $_SESSION['topicId'];
	$id =  $_SESSION['id'];
							
	$score = 0;
	for($i=0;$i<count($userAns);$i++){
		
		if($_POST[$i] == $userAns[$i]){
			
			
			$score++;	
		
		}
		
	}
	mysql_query("INSERT INTO results VALUES('$id','$score','$topicId','$clsId','".date('d-M-Y')."')");
	$_SESSION['score'] = $score;
	header("Location:testQuestions.php?c=$clsId&&t=$topicId&&f=f");
	
	
}



if(isset($_POST['tryAgain'])){
	
	$_SESSION['userAnswers']= "";
	$_SESSION['clsId']= "";
	$_SESSION['topicId']= "";
	$_SESSION['score'] = "";
	header("Location:selectClass.php");
	
}

?>     
<div class="container" style="margin-top:110px;"> 
    <div class="row">
    	<div class="col-lg-8">
                <form action="testQuestions.php" method="post">
                <?php
                
					if($_GET['c']!=""){
						
						$classNm = $_GET['c'];
						$topic = $_GET['t'];
						
						$result = @mysql_query("SELECT *  FROM questions WHERE topicId='$topic' AND classId='$classNm' ");
									
						if(@mysql_num_rows($result)>0){
							$answArray = array();
							
							echo"
								<div class='panel-heading ' style='background-color: #777;color: #fff;'>
									<h3 class='panel-title' style='color: #fff;'>
										Test Questions -- <i>".getClassNm($classNm )." (".getTopicNm($topic).")</i> 
									</h3>
								</div>
								<table  class='table jumbotron'  style='font-size:16px;'>";
							
								for($i=0;$i<mysql_num_rows($result);$i++){
									
									$question = mysql_result($result,$i,'question');
									$optA = mysql_result($result,$i,'option1');
									$optB = mysql_result($result,$i,'option2');
									$optC = mysql_result($result,$i,'option3');
									$optD = mysql_result($result,$i,'option4');
									$rAns = mysql_result($result,$i,'answer');
									$snum = $i+1;
									array_push($answArray,$rAns);
									
									echo"
								  <tr>
									<td colspan='2'><h4>".$snum.". ".$question." </h4></td>
								  </tr>
								  <tr>
									<td width='50%' style='padding-left:20px;'><input type='radio' name='".$i."' value='A' /> &emsp;A.  $optA</td>
									<td ><input type='radio' name='".$i."' value='B'/>&emsp;B.  $optB</td>
								  </tr>
								  <tr>
									<td width='50%' style='padding-left:20px;'><input type='radio' name='".$i."' value='C' />&emsp;C.  $optC</td>
									<td ><input type='radio' name='".$i."' value='D'/>&emsp;D. $optD</td>
								  </tr> 
								  
								  <tr class='hidden ans'>
									<td  class='alert alert-success pull-right ' colspan='2'> Answer = $rAns</td>
								  </tr> ";
								}
								
								
								if(!isset($_GET['f'])){
							echo "
							
								<tr>
									<td colspan='2'><button type='submit' name='submTest' class='btn btn-success pull-right' style='width:200px;'>Submit Test &emsp;<span class='glyphicon glyphicon-send'></span> </button></td>
								</tr>";
							
								}
							echo "</table>";
							$_SESSION['userAnswers']= $answArray;
							$_SESSION['clsId']= $classNm;
							$_SESSION['topicId']= $topic;
							
						}
					
					}
				
				?>
    			
                	


         </form>       
        </div>
        <div class="col-lg-4 hidden" id="sumryDiv">
               
                <?php echo $error;?>
            
                <div class="panel-heading " style="background-color: #777;; color: #fff;">
                    <h3 class="panel-title" style="color: #fff;">
                        Result Summary
                    </h3>
                </div>
    			<form action="testQuestions.php" method="post">
                <table class="table jumbotron">
                <tr>
                    <td >
                        <label  class="text-info">
                              Total Question </label>
                     </td>
                     <td width="30%">
                        <label class="text-info"><?php echo count($_SESSION['userAnswers']);?></label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label  class="text-success">
                               Correct Answers</label>
                     </td>
                     <td width="30%">
                        <label  class="text-success"><?php echo $_SESSION['score'];?></label>
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label class="text-danger" >
                               Wrong Answers</label>
                     </td>
                     <td width="30%">
                        <label  class="text-danger"><?php echo count($_SESSION['userAnswers'])-$_SESSION['score'];?></label>
                    </td>
                </tr>
                <tr>  
               		 <td >
                        
                        <button type="submit"  name="tryAgain" class="btn btn-info pull-left">Try again &emsp;<span class='glyphicon  glyphicon-refresh' ></span></button><br />
                    </td>     
                    <td>
                       
                        <button type="button" id="showRslt"  class="btn btn-success pull-right">Show Answers &nbsp;<span class='glyphicon  glyphicon-eye-open' ></span></button><br />
                    </td>
                </tr>
             
            </table>
              </form> 
        </div>  
        <?php 
			if(isset($_GET['f'])){
	
				echo"<script>$('#sumryDiv').removeClass('hidden');</script>";
			}
		?>
    </div>
</div>
<div class="navbar  navbar-default " style="background-color:#eee;margin-bottom:0px;">
    <div class="container">
       
            <p class="navbar-text" style="color:#777;">
            
                &copy; <?php echo  date('Y');?> <span style="color:#c9302c; font-weight:bold;">Learn Mathematics</span> , All rights reserved
                 
            </p>
            <p class="navbar-text pull-right" style="color:#777;">
            
                Designed by <span style="color:#4f84b0; font-weight:bold;">Umar ( UG12/SCCS/1002 )</span>
                 
            </p>
    </div>
</div>
<script>

	$('#showRslt').click(function(){
		
		$('.ans').removeClass('hidden');
	});
</script>
</body>
</html>

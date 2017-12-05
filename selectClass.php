<?php ob_start(); session_start();

require("connection.php");
include('functionz.php');

if($_SESSION['name'] and $_SESSION['level']=="1"){
	
}//else {header('location:logout.php');}

$error="";

if(isset($_POST['startTest'])){
	
	if($_POST['classNm'] and $_POST['topic']){
			
		$classNm = $_POST['classNm'];
		$topic = $_POST['topic'];
				
			$result = @mysql_query("SELECT *  FROM questions WHERE topicId='$topic' AND classId='$classNm' ");
									
			if(@mysql_num_rows($result)>0){
					
				header("Location:testQuestions.php?c=$classNm&&t=$topic");
					
			}else{$error="<div class='alert alert-danger'><strong>Error:</strong> Sorry, there are no questions currently for this <strong>Class and Topic</strong>, please choose another one</div>";}		
			
	}else{$error="<div class='alert alert-danger'><strong>Error:</strong> You must select <strong> Class and Topic</strong> for the test</div>";}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
     <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  	<link rel="stylesheet" type="text/css" href="css/styles.css"/>
    <link href="css/layout.css" rel="stylesheet" type="text/css" />
    <title>Learn Mathematics| Select Class </title>
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
<div class="container" style="margin-top:110px; margin-bottom:50px;"> 
    <div class="row">
    	<div class="col-lg-9">
            
                <div class="panel-heading" style="background-color: #777;; color: #fff;">
                    <h3 class="panel-title" style="color: #fff;">
                        Test Guidelines
                    </h3>
                </div>
    			<div class="jumbotron">
                	<h4>Ensure that you select the class and the topic for the test</h4>
                    <h4>Ensure that you select the class and the topic for the test</h4>
                    <h4>Ensure that you select the class and the topic for the test</h4>
                    <h4>Ensure that you select the class and the topic for the test</h4>
                </div>
                
        </div>
        <div class="col-lg-3">
        
                <div class="panel-heading" style="background-color: #777;; color: #fff;">
                    <h3 class="panel-title" style="color: #fff;">
                        Want to test your math skills?
                    </h3>
                </div>
    			
                    <form action="selectClass.php" method="post">
                    <table class="table jumbotron" >
                    	<tr>
                        	<td colspan="2"><?php echo $error;?></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                            <label>
                                Class</label><br />
                            <select name="classNm" id="classNm" class="form-control">
                            	 <?php 
                        
									$result = @mysql_query("SELECT * FROM classes ORDER BY className ASC ");
									
									if(@mysql_num_rows($result)>0){
										echo "<option value=''>Select class here</option>";										
										for($i=1; $i<=@mysql_num_rows($result);$i++){
											
											$clsName = @mysql_result($result,$i-1,'className');
											$clsId = @mysql_result($result,$i-1,'id');
											
											echo"<option value='$clsId'>$clsName</option>";
										}
										
									}else{echo"<option value=''>No class to select</option>";}
								
								?>
                            </select>
                        <script> document.getElementById("classNm").value="<?php if(isset($_POST['classNm'])) echo $_POST['classNm'];?>";</script>
                        </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                            <label>
                                Topic</label><br />
                            <select name="topic" id="topic" class="form-control">
                                 <?php 
                        
									$result = @mysql_query("SELECT * FROM topics ORDER BY topicName ASC ");
									
									if(@mysql_num_rows($result)>0){
										echo "<option value=''>Select topic here</option>";										
										for($i=1; $i<=@mysql_num_rows($result);$i++){
											
											$topicName = @mysql_result($result,$i-1,'topicName');
											$topicId = @mysql_result($result,$i-1,'id');
											
											echo"<option value='$topicId'>$topicName</option>";
										}
										
									}else{echo"<option value=''>No topic to select</option>";}
								
								?>
                            </select>
                        <script> document.getElementById("topic").value="<?php if(isset($_POST['topic'])) echo $_POST['topic'];?>";</script>
                        </td>
                        </tr>
                        <tr>
                       		 <td>
                                <label>
                                    &emsp;</label><br/>
                                
                                <button type="button" name="read" class="btn btn-info pull-left" >Read Topic &nbsp;<span class='glyphicon glyphicon-book'></span></button>
                            </td>
                            <td>
                                <label>
                                    &emsp;</label><br/>
                                
                                <button type="submit" name="startTest" class="btn btn-info pull-right" >Start Test &nbsp;<span class='glyphicon glyphicon-time'></span></button><br/><h1></h1>
                            </td>
                        </tr>
                    </table>
                    </form>
               
        </div>  
    </div>
</div>
<div class="navbar  navbar-default navbar-fixed-bottom" style="background-color:#eee;margin-bottom:0px;margin-top:0px;">
    <div class="container">
       
            <p class="navbar-text" style="color:#777;">
            
                &copy; <?php echo  date('Y');?> <span style="color:#c9302c; font-weight:bold;">Learn Mathematics</span> , All rights reserved
                 
            </p>
            <p class="navbar-text pull-right" style="color:#777;">
            
                Designed by <span style="color:#4f84b0; font-weight:bold;">Umar ( UG12/SCCS/1002 )</span>
                 
            </p>
    </div>
</div>
</body>
</html>

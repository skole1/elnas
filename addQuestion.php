<?php ob_start(); session_start();

require("connection.php");
include('functionz.php');

if($_SESSION['name'] and $_SESSION['level']=="1"){
	
}//else {header('location:logout.php');}

$error="";

if(isset($_POST['addQuestion'])){
	
	if($_POST['classNm'] and $_POST['topic'] and $_POST['question'] and $_POST['ans'] and $_POST['optA'] and $_POST['optB'] and $_POST['optC'] and $_POST['optD']){
			 
		$clsName = $_POST['classNm']; 
		$topic = $_POST['topic'];
		$question = htmlentities(trim($_POST['question'])); 
		$ans = htmlentities(trim($_POST['ans']));
		$optA = htmlentities(trim($_POST['optA'])); 
		$optB = htmlentities(trim($_POST['optB']));
		$optC = htmlentities(trim($_POST['optC'])); 
		$optD = htmlentities(trim($_POST['optD'])); 
				
		$result = @mysql_query("SELECT *  FROM questions WHERE question='$question'");
							
		if(@mysql_num_rows($result)==0){
		
				
				mysql_query("INSERT INTO questions VALUES('','$clsName','$topic','$question','$optA','$optB','$optC','$optD','$ans')");
												
				$error="<div class='alert alert-success'><strong>Success:</strong>New question added sucessfully</div>";
				
				
		}else{$error="<div class='alert alert-danger'><strong>Error:</strong>This <strong> question </strong> already exist !</div>";}
			
	}else{$error="<div class='alert alert-danger'><strong>Error:</strong> All required fields must be completed</div>";}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
     <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  	<link rel="stylesheet" type="text/css" href="css/styles.css"/>
    <link href="css/layout.css" rel="stylesheet" type="text/css" />
    
    
    <title>Learn Mathematics | Add Question</title>
</head>
<body class="home2" >
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
           
        </ul>
    </div>
</div>


<div class="container" style="margin-top:110px";>
    <div class="row">   
        <div class="col-lg-12">
            <ul class="nav nav-pills"  >
            
                
                    <li ><a href="viewResults.php">View Results <span class='glyphicon  glyphicon-plus' style='margin-left:7px;'></span><span class='glyphicon  glyphicon-stats' style='margin-left:2px;'></span></a></li>
                
                <li class="active"><a href="addQuestion.php">Add Question <span class='glyphicon  glyphicon-plus-sign' style='margin-left:7px;'></span></a></li>
                <li ><a href="addClass.php">Add new class  <span class='glyphicon  glyphicon-shopping-cart' style='margin-left:7px;'></span></a></li>
                <li ><a href="manageUsers.php">Manage Users <span class='glyphicon  glyphicon-user' style='margin-left:7px;'></span></a></li>
                <li style="width:145px;"> <a href="logout.php">Logout <span class='glyphicon  glyphicon-log-out' style='margin-left:7px;'></span></a></li>
            </ul>
        </div>
    </div>   
</div>
<div class="container">   
   <div class="row">
        <div class="col-lg-12 ">
           
                 <?php echo $error;?>
                <div class="panel-heading" style="background-color: #777;; color: #fff;">
                    <h3 class="panel-title" style="color: #fff;">
                        New test question
                    </h3>
                </div>
                <form action="addQuestion.php" method="post">
                <table class="table  jumbotron">
                	<tr>
                    	<td>
                            <label>
                                Class *</label><br />
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
                        <td>
                            <label>
                                Topic *</label><br />
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
                                Question *</label><br />
                            
                       			<textarea class="form-control"  name="question" placeholder="Type in your question here"></textarea>
                        </td>
                        <td>
                            <label>
                                Answer *</label><br />
                            <select name="ans" id="ans" class="form-control">
                                <option value=''>Select answer option here</option>
                                <option value='A'>A</option>
                                <option value='B'>B</option>
                                <option value='C'>C</option>
                                <option value='D'>D</option>
                            </select>
                        <script> document.getElementById("ans").value="<?php if(isset($_POST['ans'])) echo $_POST['ans'];?>";</script>
                        </td>
                    </tr>
                    
                     <tr>
                    	<td>
                            <label>
                                Option A *</label><br />
                            
                       			<textarea class="form-control" name="optA" placeholder="option A answer here"></textarea>
                        </td>
                        <td>
                            <label>
                                Option B *</label><br />
                            
                       			<textarea class="form-control"  name="optB" placeholder="option B answer here"></textarea>
                        </td>
                        
                    </tr>
                     <tr>
                    	<td>
                            <label>
                                Option C *</label><br />
                            
                       			<textarea class="form-control"  name="optC" placeholder="option C answer here"></textarea>
                        </td>
                        <td>
                            <label>
                                Option D *</label><br />
                            
                       			<textarea class="form-control"  name="optD" placeholder="option D answer here"></textarea>
                        </td>
                        
                    </tr>
                    <tr>
                        <td colspan="2">
                            
                            <button type="submit" name="addQuestion" class="btn btn-success pull-right">Save Question &emsp;<span class='glyphicon  glyphicon-floppy-save' ></span></button><br/><h1></h1>
                        </td>
                    </tr>
                </table>
                </form>
                 
            
        </div>  
    
          
   </div>       
</div>
<div class="navbar  navbar-default" style="background-color:#eee;">
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

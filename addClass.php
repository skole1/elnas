<?php ob_start(); session_start();

require("connection.php");
include('functionz.php');

if($_SESSION['name'] and $_SESSION['level']=="1"){
	
}else {header('location:logout.php');}

$error="";
if(isset($_POST['add'])){
	
	if($_POST['clsName'] or $_POST['topic']){
			
		$clsName = htmlentities(trim($_POST['clsName'])); 
		$topic = htmlentities(trim($_POST['topic']));
		 
		if($clsName!=""){
			
			$result = @mysql_query("SELECT *  FROM classes WHERE className='$clsName'");
							
			if(@mysql_num_rows($result)==0){
			
					
					@mysql_query("INSERT INTO classes VALUES('','$clsName')");
			
					$error="<div class='alert alert-success'><strong>Success:</strong>New Class <strong> (".$_POST['clsName'].") </strong> added sucessfully</div>";
					$_POST['clsName']="";	
					
			}else{$error="<div class='alert alert-danger'><strong>Error:</strong>This Class <strong> (".$_POST['clsName'].") </strong> already exist !</div>";}
		}
		if($topic!=""){
			
			$result = @mysql_query("SELECT *  FROM topics WHERE topicName='$topic'");
							
			if(@mysql_num_rows($result)==0){
			
					
					@mysql_query("INSERT INTO topics VALUES('','$topic')");
			
					$error="<div class='alert alert-success'><strong>Success:</strong>New Topic <strong> (".$_POST['topic'].") </strong> added sucessfully</div>";
					$_POST['topic']="";	
					
			}else{$error="<div class='alert alert-danger'><strong>Error:</strong>This topic <strong> (".$_POST['topic'].") </strong> already exist !</div>";}
			
		
		}
				
		
	}else{$error="<div class='alert alert-danger'><strong>Error:</strong> All required fields <strong>must be completed</strong>,you must add <strong>Class Name </strong> or <strong>Topic</strong></div>";}
}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
     <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  	<link rel="stylesheet" type="text/css" href="css/styles.css"/>
    <link href="css/layout.css" rel="stylesheet" type="text/css" />
    <title>Learn Mathematics| Add Supermarket </title>
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
           
        </ul>
    </div>
</div>
    
    <div class="container" style="margin-top:110px";>
        <div class="row">   
            <div class="col-lg-12">
                 <ul class="nav nav-pills"  >
                    <li><a href="viewResults.php">View Results <span class='glyphicon  glyphicon-plus' style='margin-left:7px;'></span><span class='glyphicon  glyphicon-stats' style='margin-left:2px;'></span></a></li>
                    
                    <li ><a href="addQuestion.php">Add Question <span class='glyphicon  glyphicon-plus-sign' style='margin-left:7px;'></span></a></li>
                    <li class="active"><a href="addClass.php">Add new class  <span class='glyphicon  glyphicon-shopping-cart' style='margin-left:7px;'></span></a></li>
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
                            New Supermarket
                        </h3>
                    </div>

                    <form action="addClass.php" method="post">
                    <table class="table loginBg2">
                        <tr>
                            <td>
                                <label>
                                     Name of Class *</label><br />
                                <input type="text" name="clsName" class="form-control" value="<?php if(isset($_POST['clsName'])) echo $_POST['clsName'];?>"  />
                            </td>
                            <td>
                                <label>
                                    Topic *</label><br />
                                    <input type="text" name="topic" class="form-control" value="<?php if(isset($_POST['topic'])) echo $_POST['topic'];?>"/>
                                
                            </td>
                        </tr>
                        
                        <tr>
                            
                            <td colspan="2">
                                
                                <button type="submit" name="add" class="btn btn-danger pull-right">Save Details&emsp; <span class='glyphicon  glyphicon-floppy-save' ></span></button><br />
                            </td>
                        </tr>
                    </table>
                    </form>
                     
              	
            </div>  
        </div>
      
    </div><!--container-->
<div class="navbar  navbar-default navbar-fixed-bottom" style="background-color:#eee; margin-bottom:0px;">
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

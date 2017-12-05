<?php ob_start(); session_start();

require("connection.php");
include('functionz.php');

if($_SESSION['name'] and $_SESSION['level']=="1"){
	
}else {header('location:logout.php');}

$error="";
$action="";

if(isset($_GET['dl'])){
		
	$userId = $_GET['dl'];
	$sql1 = mysql_query("DELETE  FROM login WHERE username='$userId'");
	$error="<div class='alert alert-success'><strong>Success:</strong>The user has been <strong>deactivated</strong> successfully </div>";
		
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
     <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  	<link rel="stylesheet" type="text/css" href="css/styles.css"/>
    <link href="css/layout.css" rel="stylesheet" type="text/css" />
    <title>Learn Mathematics | Manage Users </title>
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
                    <li ><a href="viewResults.php">View Results <span class='glyphicon  glyphicon-plus' style='margin-left:7px;'></span><span class='glyphicon  glyphicon-stats' style='margin-left:2px;'></span></a></li>
                    
                    <li ><a href="addQuestion.php">Add Question <span class='glyphicon  glyphicon-plus-sign' style='margin-left:7px;'></span></a></li>
                    <li ><a href="addClass.php">Add new class  <span class='glyphicon  glyphicon-shopping-cart' style='margin-left:7px;'></span></a></li>
                    <li class="active"><a href="manageUsers.php">Manage Users <span class='glyphicon  glyphicon-user' style='margin-left:7px;'></span></a></li>
                    <li style="width:145px;"> <a href="logout.php">Logout <span class='glyphicon  glyphicon-log-out' style='margin-left:7px;'></span></a></li>
                </ul>
            </div>
        </div>
</div>          
<div class="container" style="margin-bottom:50px;"> 
    <div class="row">
            <div class="col-lg-12 ">
                
                <div class="panel-heading" style="background-color: #777;; color: #fff;">
                    <h3 class="panel-title" style="color: #fff;">
                        List Of Users
                    </h3>
                </div>
            
                <table class="table table-striped table-bordered tHeader">
                    <tr>
                    	<th>
                            S/No.
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Username
                        </th>
                        <th>
                            Gender
                        </th>
                       
                        <th>
                            Action
                        </th>
                    </tr>
            <?php                     
            $sql1 = mysql_query("SELECT * FROM login  WHERE id!='".$_SESSION['id']."' AND secLevel!='1'  ORDER BY name ASC");
                                        
            if(@mysql_num_rows($sql1)>0){
                
                for($i=0; $i<mysql_num_rows($sql1);$i++){
                    
					$sno = $i+1;
                    $name = mysql_result($sql1,$i,'name'); 
                    $userId = mysql_result($sql1,$i,'username'); 
                    $gender = mysql_result($sql1,$i,'gender');
					
                    echo"
                    <tr>
						<td>
                            ".$sno."
                        </td>
                        <td>
                            ".$name."
                        </td>
                        <td>
                            ".$userId."
                        </td>
                        
                        <td>
                            ".$gender."
                        </td>
                       
                        <td align='center'>
                            <b><a  class='text-danger' href='manageUsers.php?dl=".$userId."'>De-activate </a></b>
                        </td>
                    </tr>
                     ";
                    
                }
                
            }
            
            ?>
                </table>
                
            </div>
            
        </div>
</div>
<div class="navbar  navbar-default navbar-fixed-bottom " style="background-color:#eee;margin-bottom:0px;">
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

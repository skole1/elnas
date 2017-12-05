<?php ob_start(); session_start();

require("connection.php");

if($_SESSION['name'] and $_SESSION['username']){
	
	$username= $_SESSION['username'];
	
}else {header('location:logout.php');}

$error="";

if(isset($_POST['update'])){
	
	if($_POST['oldP'] and $_POST['newP'] and $_POST['comP']){
			
		$oldP = htmlentities(trim($_POST['oldP'])); 
		$newP = htmlentities(trim($_POST['newP'])); 
		$comP = htmlentities(trim($_POST['comP']));
		
		
		$result =mysql_query("SELECT * FROM admin WHERE username='$username' and password='".mysql_real_escape_string($oldP)."'");
		
		if(@mysql_num_rows($result)==1){
			
			if(strlen($newP)>=5){
			
				if($newP===$comP){
				
					mysql_query("UPDATE login SET password='$newP' WHERE id='$username'");
					
					$_POST['comP']="";
					$_POST['newP']="";
					$_POST['oldP']="";
					$color="#22a266";
					$error="<div class='alert alert-success'><strong>Success:</strong>".$_SESSION['name'] .",your password was <strong>changed sucessfully</strong></div>";
				
				}else{$color="#f10d0d";$error="<div class='alert alert-danger'><strong>Error:Passwords mismatch,</strong>please try again</div>";}
				
			}else{$color="#f10d0d";$error="<div class='alert alert-danger'><strong>Error:</strong>New password length, must <strong>not be less than 5 characters long</strong></div>";}
			
		}else{$color="#f10d0d";$error="<div class='alert alert-danger'><strong>Error: The old password </strong> entered is not correct</div>";}
			
	}else{$color="#f10d0d";$error="<div class='alert alert-danger'><strong>Error:</strong> All required fields <strong>must be completed</strong></div>";}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
    
     <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  	<link rel="stylesheet" type="text/css" href="css/styles.css"/>
    <link href="css/layout.css" rel="stylesheet" type="text/css" />
    <title>Learn Mathematics| Change Password</title>
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
            <li><a href="#"> <span class='glyphicon  glyphicon-user' style='margin-right:7px;'></span>Welcome,  <?php echo $_SESSION['name'];?></a></li> 		 <li><a href='profitCalculator.php' ><span class='glyphicon glyphicon-home' style='margin-right:7px;'></span>Click here to go back</a></li>
           
        </ul>
    </div>
</div>
   <div class="container" style="margin-top:110px";>
        
        
        <div class="container">
            <div class="row">
                <div class="col-lg-12 " >
                 <?php echo $error;?>
                     <div class="panel-heading" style="background-color: #777;; color: #fff;">
                        <h3 class="panel-title" style="color: #fff;">
                            Change Password
                        </h3>
                    </div>
                        
                       
                   
                        <form action="changePsw.php" method="post">
                        
                        <table class="table loginBg2" >
                           <tr>
                                <td>
                                    <label>
                                        Old Password *</label><br />
                                    <input type="password" name="oldP" class="form-control"   value="<?php if(isset($_POST['oldP'])) echo $_POST['oldP'];?>" placeholder="Old password here" /><br />
                                </td>
                                <td>
                                    <label>
                                        New password*</label><br />
                                    <input type="password" name="newP" class="form-control" value="<?php if(isset($_POST['newP'])) echo $_POST['newP'];?>" placeholder="Enter new password" /><br />
                                </td>
                                <td>
                                    <label>
                                        Confirm New Password*</label><br />
                                    <input type="password" name="comP" class="form-control"  value="<?php if(isset($_POST['comP'])) echo $_POST['comP'];?>" placeholder="Re-type New Password " /><br />
                                </td>
                            </tr>
                            
                            <tr>
                                
                                <td colspan="3">
                                  
                                    <input type="submit" name="update" class="btn btn-danger" value="Update Password" style="width: 210px; float:right;" /><br />
                                </td>
                            </tr>
                        </table>
                        </form>
                    
                </div>
                
            </div>
        </div>
        
    </div>
<div class="navbar  navbar-default navbar-fixed-bottom" style="background-color:#eee;">
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

<?php ob_start(); session_start();

require("connection.php");
include('functionz.php');

if($_SESSION['name'] and $_SESSION['level']=="1"){
	
}//else {header('location:logout.php');}

$error="";

if(isset($_POST['add'])){
	
	if($_POST['userId'] and $_POST['lName'] and $_POST['fName'] and $_POST['gender'] and $_POST['passw'] and $_POST['cpassw'] and $_POST['addrs'] and $_POST['schName']){
			
		$userId = htmlentities(trim($_POST['userId'])); 
		$name = htmlentities(trim(ucfirst($_POST['fName'])))." ".htmlentities(trim(ucfirst($_POST['lName']))); 
		$passw = htmlentities(trim(ucfirst($_POST['passw'])));
		$cpassw = htmlentities(trim(ucfirst($_POST['cpassw'])));
		$addrs = htmlentities(trim(ucfirst($_POST['addrs'])));
		$schName = htmlentities(trim(ucfirst($_POST['schName'])));
		$gender = $_POST['gender'];
		
			if($cpassw==$passw){
			
				$result = @mysql_query("SELECT *  FROM login WHERE username='$userId'");
										
				if(@mysql_num_rows($result)==0){
						
					mysql_query("INSERT INTO login VALUES('','$name','$userId','$passw','".mysql_escape_string($addrs)."','$schName','$gender','0')") or die(mysql_error());
										
									
					$_POST['lName']=""; $_POST['fName']=""; $_POST['userId']=""; $_POST['passw']="";$_POST['schName']="";	
					
					$error="<div class='alert alert-success'><strong>Success:</strong>New User <strong> (".$userId.") </strong> added sucessfully</div>";
						
				}else{$error="<div class='alert alert-danger'><strong>Error:</strong> A user with this username <strong> (".$userId.") </strong> already exist , please choose another one</div>";}
				
			}else{$error="<div class='alert alert-danger'><strong>Error:</strong> The two password field did not match, please try again</div>";}
			
	}else{$error="<div class='alert alert-danger'><strong>Error:</strong> All required fields <strong>must be completed</strong></div>";}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
     <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  	<link rel="stylesheet" type="text/css" href="css/styles.css"/>
    <link href="css/layout.css" rel="stylesheet" type="text/css" />
    <title>Learn Mathematics| Register  </title>
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
             
            <li><a href="logout.php"><span class='glyphicon  glyphicon-backward' style='margin-right:7px;'></span>Go back to login</a></li>
           
        </ul>
    </div>
</div>
        
<div class="container" style="margin-top:110px;"> 
    <div class="row">
        <div class="col-lg-12 ">
               
                <?php echo $error;?>
            
                <div class="panel-heading" style="background-color: #777;; color: #fff;">
                    <h3 class="panel-title" style="color: #fff;">
                        New User Registration
                    </h3>
                </div>
    
                <form action="register.php" method="post">
                <input type="hidden" name="status" value=""/>
                <table class="table jumbotron" >
                    <tr>
                        <td>
                            <label>
                                First Name *</label>
                            <input type="text" name="fName" class="form-control" value="<?php if(isset($_POST['fName'])) echo $_POST['fName'];?>"  />
                        </td>
                        <td>
                            <label>
                                Last Name *</label>
                            <input type="text" name="lName" class="form-control" value="<?php if(isset($_POST['lName'])) echo $_POST['lName'];?>" />
                        </td>
                        <td>
                        <label>
                            Gender</label>
                        <select name="gender" id="gender" class="form-control">
                        	
                            <option value='M'>Male</option>
                            <option value='F'>Female</option>
                    	</select>
                    <script> document.getElementById("gender").value="<?php if(isset($_POST['gender'])) echo $_POST['gender'];?>";</script>
                    </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                Username *</label>
                            <input type="text" name="userId" class="form-control" value="<?php if(isset($_POST['userId'])) echo $_POST['userId'];?>" placeholder="e.g (Ibi123)" />
                        </td>
                        <td>
                            <label>
                                Password *</label>
                                
                            <input type="password" name="passw" id="pp" class="form-control" value="<?php if(isset($_POST['passw'])) echo $_POST['passw'];?>"   />
                            
                        </td>
                        <td>
                            <label>
                                Confirm Password *</label>
                                
                            <input type="password" name="cpassw" id="cpp" class="form-control" value="<?php if(isset($_POST['cpassw'])) echo $_POST['cpassw'];?>"   />
                            
                        </td>
                        
                    </tr>
                    <tr>
                        <td>
                            <label>
                                Address *</label>
                            <input type="text" name="addrs" class="form-control" value="<?php if(isset($_POST['addrs'])) echo $_POST['addrs'];?>"  />
                        </td>
                        <td>
                            <label>
                                School Name *</label>
                                
                            <input type="text" name="schName" id="schName" class="form-control" value="<?php if(isset($_POST['schName'])) echo $_POST['schName'];?>"   />
                            
                        </td>
                        <td>
                            <label>
                                &emsp;</label><br/>
                            
                            <button type="submit" name="add" class="btn btn-info pull-right" >Submit &emsp;<span class='glyphicon glyphicon-send'></span></button>
                        </td>
                    </tr>
                </table>
                </form>
        </div>  
    </div>
</div><!--container
<div class="container"> 
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
                            Password
                        </th>
                        <th>
                           Supermarket
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
            <?php                     
            $sql1 = mysql_query("SELECT * FROM admin  WHERE username !='".$_SESSION['username']."' AND level!='1' AND status='1' ORDER BY fName ASC");
                                        
            if(@mysql_num_rows($sql1)>0){
                
                for($i=0; $i<mysql_num_rows($sql1);$i++){
                    
					$sno = $i+1;
                    $name = mysql_result($sql1,$i,'fName')." ".mysql_result($sql1,$i,'lName'); ; 
                    $userId = mysql_result($sql1,$i,'username'); 
                    $passwd = mysql_result($sql1,$i,'password');
					$supMrk = getSupMrktName(mysql_result($sql1,$i,'supMrkt_id'));
                  
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
                            ".$passwd."
                        </td>
                        <td>
                            ".$supMrk."
                        </td>
                        <td align='center'>
                            <b><a  class='text-info' href='addUsers.php?id=".md5($userId)."'>Edit</a> &emsp;&emsp;|&emsp;&emsp;  <a  class='text-danger' href='addUsers.php?dl=".md5($userId)."'>De-activate </a></b>
                        </td>
                    </tr>
                     ";
                    
                }
                
            }
            
            ?>
                </table>
                
            </div>
            
        </div>
</div> -->
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

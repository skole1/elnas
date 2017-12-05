<?php ob_start(); session_start();

require("connection.php");
include('functionz.php');

if($_SESSION['name'] and $_SESSION['level']=="1"){
	
}else {header('location:logout.php');}

$error="";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
     <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  	<link rel="stylesheet" type="text/css" href="css/styles.css"/>
    <link href="css/layout.css" rel="stylesheet" type="text/css" />
    <title>Learn Mathematics| View results </title>
</head>
<body class="home2">
<div class="navbar  navbar-default navbar-fixed-top" style="padding-bottom:12px;  color:#fff;">
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
                    <li class="active"><a href="viewResults.php">View Results <span class='glyphicon  glyphicon-plus' style='margin-left:7px;'></span><span class='glyphicon  glyphicon-stats' style='margin-left:2px;'></span></a></li>
                    
                    <li ><a href="addQuestion.php">Add Question <span class='glyphicon  glyphicon-plus-sign' style='margin-left:7px;'></span></a></li>
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
                            Search Result
                        </h3>
                    </div>

                    <form action="viewResults.php" method="post">
                    <table class="table jumbotron">
                        <tr>
                            <td>
                                <label>
                                      Class Name  *</label><br />
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
                                     &emsp;</label><br />
                                <button type="submit" name="view" class="btn btn-info pull-right">View Result&emsp; <span class='glyphicon  glyphicon-search' ></span></button><br />
                            </td>
                        </tr>
                    </table>
                    </form>
                     
              	
            </div>  
        </div>
      
    </div><!--container-->
<?php
if(isset($_POST['view'])){

	if($_POST['classNm']){

		$classNm = $_POST['classNm'];
		
		$sql1 = mysql_query("SELECT * FROM results  WHERE clsId='$classNm' ORDER BY dateSaved ASC");
		echo"
				<div class='container' style='margin-bottom:50px;'> 
					<div class='row'>
							<div class='col-lg-12 '>
								<div class='panel-heading' style='background-color: #777; color: #fff;'>
									<h3 class='panel-title' style='color: #fff;'>
										Students Results
									</h3>
								</div>
								<table class='table table-striped table-bordered tHeader'>
									<tr>
										<th>
											S/No.
										</th>
										<th>
											Students Name
										</th>
										<th>
											Class
										</th>
										<th>
											Topic
										</th>
										<th>
											Date
										</th>
										<th>
											Score
										</th>
									</tr>";
                                        
        if(@mysql_num_rows($sql1)>0){ 
            
                for($i=0; $i<mysql_num_rows($sql1);$i++){
                    
					$sno = $i+1;
                    $name = getName(mysql_result($sql1,$i,'student_id')); 
                    $class = getClassNm(mysql_result($sql1,$i,'clsId')); 
					$topic = getTopicNm(mysql_result($sql1,$i,'topicId')); 
					$dateSaved = mysql_result($sql1,$i,'dateSaved'); 
                    $score = mysql_result($sql1,$i,'score');
                  
                    echo"
                    <tr>
						<td>
                            ".$sno."
                        </td>
                        <td>
                            ".$name."
                        </td>
                        <td>
                            ".$class."
                        </td>
						<td>
                            ".$topic."
                        </td>
						<td>
                            ".$dateSaved."
                        </td>
						<td align='center'>
                            ".$score."
                        </td>
                                                
                    </tr>
                     ";
                    
                }
                
         }else{echo "<tr><td colspan='6'>No Record found</td>";}
	}else{echo "<div class='alert alert-danger'><strong>Error:</strong> All required fields <strong>must be completed</strong>,you must select <strong>Class Name </strong></div>";}
}
            
?>
                </table>
                
            </div>
            
        </div>
</div>
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

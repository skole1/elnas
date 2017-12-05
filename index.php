<?php ob_start(); session_start();

require("connection.php");
$error="";

if(isset($_POST['login'])){

    if($_POST['userNm'] and $_POST['passw']){

            $userNm = htmlentities(trim($_POST['userNm']));
            $passw = htmlentities(trim($_POST['passw']));

        $result = mysql_query("SELECT * FROM login WHERE username='".mysql_real_escape_string($userNm)."' and password='".mysql_real_escape_string($passw)."'") or die(mysql_error()) ;

            if(@mysql_num_rows($result) == 1){

                $name = @mysql_result($result,0,'name');
                $level = @mysql_result($result,0,'secLevel');
                $id = @mysql_result($result,0,'id');
				
					if($level=="1"){
						
						header("Location:addQuestion.php");
					}
					else{
							header("Location:selectClass.php");
						}


                    $_SESSION['name'] = $name;
                    $_SESSION['level'] = $level;
                    $_SESSION['id'] = $id;

                    

            }else{ $error= "<div class='alert alert-danger'><strong>Error:Invalid username and password</strong></div>";}

    }else{ $error= "<div class='alert alert-danger'><strong>Error:Username and Password cannot be empty</strong></div>";}

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
     <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="css/styles.css"/>
    <link href="css/layout.css" rel="stylesheet" type="text/css" />

    <title>Learn Maths | Home</title>
</head>
<body class="home">
<div class="navbar  navbar-default navbar-fixed-top" style="padding-bottom:12px; color:#fff;">
    <div class="container">
        <div class="navbar-header">
            
             <div class="navbar-brand">
             <a href="#"><strong>LEARN MATHEMATICS</strong></a><br/>
                <small style="font-size:13px;  color:#fff; ">it starts from here . . .</small>
            </div>
        </div>
        <ul class="nav navbar-nav pull-right">
            <li> <a href="#"><span class='glyphicon  glyphicon-calendar' style='margin-right:7px;'></span><?php echo @date('D, d-M-Y')?> </a></li>
        </ul>
    </div>
</div>

    <div class="container" style="margin-top:90px;">
        <div class="row">
            <div class="col-lg-6 loginBg3 " style="margin: 50px 10px  auto 10px;
                padding-top: 5px; padding-bottom: 3px;">
                <h3 class="text-success" style="font-family: Papyrus; font-size: 25px; color: #12c18f; font-weight: bold;">
                    Login</h3>
              <hr />
                <div class="center-block" style="padding: 0px 20px 0px 20px;">
                    <?php echo $error;?>
                    <div class="form-group">
                    <form action="index.php" method="post">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" class="form-control" value="<?php if(isset($_POST['userNm'])){ echo $_POST['userNm'];}?>" name="userNm" placeholder="Enter your username here" />
                        </div>
                        <br />
                        <br />
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password"  name="passw"  class="form-control" placeholder="Enter your password here" />
                        </div>
                        <br />
                        <br />
                        <input type="submit" class="btn btn-success pull-right"  name="login" value="Sign In" />
						  <h5 style="color: #090;"> <a href="register.php" class="text-info"  >Click here to sign up</a></h5>
                        <br />
                        <br />
                      </form>
                    </div>
                  
                </div>
            </div>
            <div class="col-lg-5 ">
            </div>
        </div>
    </div>
<div class="navbar  navbar-default navbar-fixed-bottom" style="background-color:#eee;">
    <div class="container">

            <p class="navbar-text" style="color:#777;">
            
                &copy; <?php echo  @date('Y');?> <span style="color:#c9302c; font-weight:bold;"> Mathematics Learning</span> , All rights reserved

            </p>
            <p class="navbar-text pull-right" style="color:#777;">

                Designed by <span style="color:#4f84b0; font-weight:bold;">Umar ( UG12/SCCS/1002 )</span>

            </p>
    </div>
</div>
</body>
</html>

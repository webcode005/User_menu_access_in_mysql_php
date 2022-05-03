<?php 
require 'db.php';

include('include/header.php');

if (isset($_POST['login'])) 
{


// (A) LOGIN FORM SENDS TO THIS SCRIPT
$_POST = [
  "email" => "john@doe.com",
  //"email" => "jane@doe.com",
  "password" => "123456"
];

$uemail = "john@doe.com";
$password = "123456";

// (B) FETCH USER FROM DATABASE & VERIFY THE PASSWORD

$user = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `users` JOIN `roles` USING (`role_id`) WHERE `user_email`='$uemail'")) ;
 
$pass = is_array($user);

if ($pass) { $pass = $user["user_password"] == $_POST["password"]; }
if (!$pass) { exit("Invalid user/password"); }

// (C) IF VERIFIED - REGISTER USER INTO SESSION
$_SESSION["user"] = $user;
$_SESSION["user"]["permissions"] = [];
unset($_SESSION["user"]["user_password"]);

$usr_role_id = $user["role_id"];

//echo "SELECT * FROM `roles_permissions` WHERE `role_id`=$usr_role_id";
// (D) REGISTER PERMISSIONS
$perm_result = $conn->query("SELECT * FROM `roles_permissions` WHERE `role_id`=$usr_role_id");

$perm = array();

while($row = $perm_result->fetch_assoc())
{
	 $perm[] = $row;
}

//print_r($perm); 

foreach ($perm as $p) { $_SESSION["user"]["permissions"][] = $p['perm_id']; }

header("location: index.php"); 		

}

// (E) DONE!
//print_r($_SESSION["user"]);
?>

<title>basantmallick.com : Demo User Menu Access with PHP & MySQL</title>
<?php include('include/container.php');?>
<div class="container contact">	
	<h2>Example: User Menu Access with PHP & MySQL</h2>	
	<div class="col-md-6">                    
		<div class="panel panel-info" >
			<div class="panel-heading">
				<div class="panel-title">Log In</div>                        
			</div> 
			<div style="padding-top:30px" class="panel-body" >
				<?php if ($errorMessage != '') { ?>
					<div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $errorMessage; ?></div>                            
				<?php } ?>
				<form id="loginform" class="form-horizontal" role="form" method="POST" action="">                                    
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" class="form-control" id="loginId" name="loginId"  value="<?php if(isset($_COOKIE["loginId"])) { echo $_COOKIE["loginId"]; } ?>" placeholder="email">                                        
					</div>                                
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" class="form-control" id="loginPass" name="loginPass" value="<?php if(isset($_COOKIE["loginPass"])) { echo $_COOKIE["loginPass"]; } ?>" placeholder="password">
					</div>            
					<div class="input-group">
					  <div class="checkbox">
						<label>
						  <input  type="checkbox" id="remember" name="remember" <?php if(isset($_COOKIE["loginId"])) { ?> checked <?php } ?>> Remember me
						</label>
						<label><a href="forget_password.php">Forget your password</a></label>	
					  </div>
					</div>
					<div style="margin-top:10px" class="form-group">                               
						<div class="col-sm-12 controls">
						  <input type="submit" name="login" value="Login" class="btn btn-info">						  
						</div>						
					</div>
					 <div class="form-group">
						<div class="col-md-12 control">
							<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
								Don't have an account! 
							<a href="register.php">
								Register 
							</a>Here. 
							</div>
						</div>
					</div>    	
				</form>   
			</div>                     
		</div>  
	</div>
</div>	
<?php include('include/footer.php');?>
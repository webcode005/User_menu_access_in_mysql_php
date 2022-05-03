<?php 
require 'db.php';

include('include/header.php');

if(!isset($_SESSION['user']))
{
	header("location:login.php");
}
?>
<title>basantmallick.com : Demo User Menu Access with PHP & MySQL</title>
<?php include('include/container.php');?>
<div class="container contact">	
	<h2>Example: User Menu Access with PHP & MySQL</h2>	
	<?php include('menu.php');?>
	<div class="table-responsive">	
	You're welcome!
	</div>
</div>	
<?php 
include('include/footer.php');?>
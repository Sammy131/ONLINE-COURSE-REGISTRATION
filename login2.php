 <?php

include('config/db_connect.php');

$errors = array('email' => '', 'password' => '', 'invalid' => '');

$email = $name  =  $password = ''; 


if(isset($_POST['submit'])){
	if(empty($_POST['email'])){
		$errors['email'] = "An email field is required"; 
	}
	else{
		$email = $_POST['email']; 
	}
 
 	if(empty($_POST['password'])){
		$errors['password'] = "A password is required"; 
	}
	else{
		$password = $_POST['password']; 
	}
 
	if($email!='' && $password!=''){
		$query="SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password'"; 
        $result=mysqli_query($conn,$query); 
 		if($result){
 			if(mysqli_num_rows($result)>0){
 				session_start(); 
 				$_SESSION['email'] = $email; 
                foreach($result as $res){
            	   $_SESSION['name'] = $res['name']; 
                } 
  			    header('Location: index3.php'); 
 			}
 			else{
 				$errors['invalid'] = 'Invalid user name or password'; 
 			}
 		} 
 		else{
 			echo "failed "; 
 		}
	}
}


?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header2.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Login</h4>

		<form class="white" action="login2.php" method="POST">

 		    <label>Email-id</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
			<div class="red-text"><?php echo $errors['email']; ?></div>
 
 		    <label>Password</label>
			<input type="text" name="password" value="<?php echo htmlspecialchars($password) ?>">
			<div class="red-text"><?php echo $errors['password']; ?></div>

			<div class="red-text"><?php echo $errors['invalid']; ?></div> 

			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>
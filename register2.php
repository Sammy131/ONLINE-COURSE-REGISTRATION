 <?php

include('config/db_connect.php');
 
$email = ''; $name = ''; $password = ''; 

$errors = array('email' => '', 'name' => '', 'password' => '');

if(isset($_POST['submit'])){

	if(empty($_POST['email'])){
		$errors['email'] = "An email field is required"; 
	}
	else{
		$email = $_POST['email']; 
	}
	if(empty($_POST['name'])){
		$errors['name'] = "A name is required"; 
	}
	else{
		$name = $_POST['name']; 
	}
	if(empty($_POST['password'])){
		$errors['password'] = "A password is required"; 
	}
	else{
		$password = $_POST['password']; 
	}
 
	if($name!='' && $email!='' && $password!=''){

		$query="INSERT INTO `users` (`name`, `email`, `password`) VALUES('$name','$email','$password')"; 
 		if(mysqli_query($conn,$query)){

 			$sql = "CREATE TABLE `mycourses_$email` (`id` INT PRIMARY KEY)"; 

 			mysqli_query($conn,$sql);  

 			session_start(); 
 			$_SESSION['email'] = $email;
 			$_SESSION['name'] = $name; 

 			header('Location: index3.php'); 
 		} 
 		else{
 			echo "failed"; 
 		}
	}
}

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header2.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Register</h4>
		<form class="white" action="register2.php" method="POST">
 
 		    <label>Name</label>
			<input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
			<div class="red-text"><?php echo $errors['name']; ?></div>

 		    <label>Email-id</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
			<div class="red-text"><?php echo $errors['email']; ?></div>
 
 		    <label>Password</label>
			<input type="text" name="password" value="<?php echo htmlspecialchars($password) ?>">
			<div class="red-text"><?php echo $errors['password']; ?></div>  

			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>
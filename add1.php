<?php

	include('config/db_connect.php');

	$title = $details = $price = $instructor = '';

	$errors = array('price' => '', 'title' => '', 'details' => '' , 'instructor'=>'');

	$upper_limit = 2000;  
	$lower_limit = 600; 

	if(isset($_POST['submit'])){
		
 		if(empty($_POST['price'])){
			$errors['price'] = 'A price is required';
		} else{
			$price = $_POST['price'];
 			if($price < $lower_limit || $price > $upper_limit ){
				$errors['price'] = 'Price must be a number between Rs. '.$lower_limit.'-'.$upper_limit;
			}
		}

 		if(empty($_POST['title'])){
			$errors['title'] = 'A title is required';
		} else{
			$title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$errors['title'] = 'Title must be letters and spaces only';
			}
		}

 		if(empty($_POST['details'])){
			$errors['details'] = 'Course details is required';
		} else{
			$details = $_POST['details'];
		}

		if(empty($_POST['instructor'])){
			$errors['instructor'] = 'Instructor field is empty';
		} else{
			$instructor = $_POST['instructor'];
		}

		if(array_filter($errors)){
 		} else {
 			$price = mysqli_real_escape_string($conn, $_POST['price']);
			$title = mysqli_real_escape_string($conn, $_POST['title']);
			$details = mysqli_real_escape_string($conn, $_POST['details']);
			$instructor = mysqli_real_escape_string($conn,$_POST['instructor']); 
 			$sql = "INSERT INTO `tuts`(`title`,`price`,`details`,`instructor`) VALUES ('$title','$price','$details' , '$instructor')";

 			if(mysqli_query($conn, $sql)){
 				header('Location: index1.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
			
		}

	}  

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header1.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Add a Course</h4>
		<form class="white" action="add1.php" method="POST">
 
 		    <label>Course Title</label>
			<input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
			<div class="red-text"><?php echo $errors['title']; ?></div>

 		    <label>Course Price</label>
			<input type="text" name="price" value="<?php echo htmlspecialchars($price) ?>">
			<div class="red-text"><?php echo $errors['price']; ?></div>
	
			<label>Course Details(at least one word)</label>
			<input type="text" name="details" value="<?php echo htmlspecialchars($details) ?>">
			<div class="red-text"><?php echo $errors['details']; ?></div>

			<label>Course Instructor</label>
			<input type="text" name="instructor" value="<?php echo htmlspecialchars($instructor) ?>">
			<div class="red-text"><?php echo $errors['instructor']; ?></div>

			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>
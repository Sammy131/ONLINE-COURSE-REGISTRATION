<?php
	include('config/db_connect.php');
    session_start(); 
    $id = $_GET['buy']; 

    $email = $_SESSION['email'];  
	$sql = "SELECT * FROM `tuts` WHERE `id`='$id'";
	$result = mysqli_query($conn, $sql);
	$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);

	if(isset($_POST['confirm'])){
		$id = $_POST['id']; 
		$query = "INSERT INTO `mycourses_$email` (`id`) VALUES ('$id')"; 
		$res = mysqli_query($conn,$query);
 		header('Location: index3.php'); 
	}

	mysqli_free_result($result); 

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header3.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Confirm to Buy Course</h4>
		<form class="white" action="buy.php" method="POST">
            <input type = "hidden"  name = "id" value = "<?php echo $id; ?>" >
<?php foreach($courses as $course): ?>

				<div class="col s6 m4">
					<div class="card z-depth-0">
						<img src="img/grad.png"class="grad">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($course['title']); ?></h6>
							<ul class="grey-text">
								<?php foreach(explode(',', $course['details']) as $ing): ?>
									<li><?php echo htmlspecialchars($ing); ?></li>
								<?php endforeach; ?>
							</ul>
							<h6 > <strong >Price</strong>: <?php echo htmlspecialchars($course['price']); ?></h6> 
                            <h6 > <strong>Instructor</strong> : <?php echo htmlspecialchars($course['instructor']); ?></h6>
						</div>
						<div class="card-action right-align">

					</div>
				</div>

			<?php endforeach; ?>

			<div class="center"> 
				<input type="submit" name="confirm" value="Confirm" class="btn green z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>
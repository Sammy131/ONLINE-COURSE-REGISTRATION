<?php 

	include('config/db_connect.php');

 
	if(isset($_GET['delete'])){
		$id = $_GET['delete'];  
		$del = "DELETE FROM `tuts` WHERE `id`='$id'";  
		mysqli_query($conn,$del); 
	}


	$sql = "SELECT `title`, `details` , `id` , `instructor` , `price` FROM `tuts` ORDER BY `created_at`";

 
 	$result = mysqli_query($conn, $sql);

 	$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);

 	mysqli_free_result($result);

 	mysqli_close($conn);
    





?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header1.php'); ?>

	<h4 class="center grey-text">Courses!</h4>

	<div class="container">
		<div class="row">

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

							<a class="brand-text" href="index1.php?delete=<?php echo $course['id'] ?>">delete</a>
							<a class="brand-text" href="edit1.php?edit=<?php echo $course['id'] ?>">edit</a>

						</div>

					</div>
				</div>

			<?php endforeach; ?>

		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>
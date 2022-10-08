<?php 
	include('config/db_connect.php');
	session_start(); 
	$id = 0 ; 
    $email = $_SESSION['email'];  
	$sql = "SELECT `title`, `details` , `id` , `instructor` , `price` FROM `tuts` ORDER BY `created_at`";
	$result = mysqli_query($conn, $sql);
	$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);

    $green  = array();  
    $cart = strval('mycourses_'.$email); 
    $sql1 = "SELECT * FROM `mycourses_$email`"; 
    $res = mysqli_query($conn,$sql1); 
    $Mycourses = mysqli_fetch_all($res, MYSQLI_ASSOC);
    foreach($Mycourses as $course){
    	$green += array($course['id'] => "YES" );   
    }
  
?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header3.php'); ?>

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
						<?php
							if($green[$course['id']]=="YES"){
			                    ?><div class="green-text">Purchased</div><?php
							}
							else{
				                 ?>
                                 <a class="brand-text" href="buy.php?buy=<?php echo $course['id'] ?>">Buy Course</a>
				                 <?php
							}
						?> 
						</div>

					</div>
				</div>

			<?php endforeach; ?>

		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>
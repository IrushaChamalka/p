<?php 

include('config/db_connect.php');

$sql = 'SELECT title,ingrediants,id FROM pizza_system ORDER BY created_at';

$result = mysqli_query($conn,$sql); //make quary and get result

$pizzas = mysqli_fetch_all($result,MYSQLI_ASSOC); //Fetch the resulting row as array

mysqli_free_result($result);
mysqli_close($conn);

// print_r($pizzas);

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<h4 class="center grey-text">Pizzas!</h4>
	<div class="container">

		<div class="row">

			<?php foreach($pizzas as $pizza): ?>
				
				<div class="col s6 md3">

					<div class="card z-depth-0">

						<div class="card-content center">

							<h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
							<?php foreach(explode(',', $pizza['ingrediants']) as $ing): ?>
								<ul><?php echo htmlspecialchars($ing) ?></ul>
							<?php endforeach; ?>
						</div>
						<div class="card-action right-align">
							<a href="#" class="brand-text">more info</a> 
						</div>

					</div>

				</div>

			<?php endforeach; ?>

		</div>

	</div>

	<?php include('templates/footer.php'); ?>

</html>
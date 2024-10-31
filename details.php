<?php

include('config/db_connect.php');

if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);

    $sql = "DELETE FROM pizza_system WHERE id = $id_to_delete";

    if(mysqli_query($conn,$sql)){
        header('Location: index.php');
    }else{
        echo "query error". mysqli_error($conn);
    }
}

if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn,$_GET['id']);

    $sql = "SELECT * FROM pizza_system WHERE id=$id";

    $result = mysqli_query($conn,$sql);

    $pizza = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);

    // print_r($pizza);
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<div class="container center">

    <?php if($pizza): ?>
        <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
        <p>Created by : <?php  echo htmlspecialchars($pizza['email']); ?></p>
        <p>Time : <?php  echo date($pizza['created_at']); ?></p><br>
        <h5>Ingrediants</h5>
        <p><?php echo htmlspecialchars($pizza['ingrediants']) ?></p>


        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']; ?>">
            <input type="submit" value="Delete" name="delete" class="btn brand z-depth-0">
        </form>

    <?php else: ?>
        <h5>No such pizza exists.</h5>
    <?php endif; ?>
    
    

</div>


<?php include('templates/footer.php'); ?>

</html>
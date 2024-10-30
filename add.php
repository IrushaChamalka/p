<?php 

include('config/db_connect.php');

$email = $ingredients = $title = '';
$errors = array('email' => '' , 'title' => '' , 'ingredients' => '');

if(isset($_POST['submit'])){

    if(empty($_POST['email'])){
        $errors['email'] = 'email requied';
    }else{
        $email = $_POST['email'];
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors['email'] =  'invalid email';
        }
    }

    if(empty($_POST['title'])){
        $errors['title'] = 'title requied';
    }else{
        $title = $_POST['title'];
        if(!preg_match('/[a-zA-Z\s]+$/',$title)){
            $errors['title'] = 'title must be letters and space only';
        }
    }

    if(empty($_POST['ingredients'])){
        $errors['ingredients'] = 'email requied';
    }else{
        $ingredients = $_POST['ingredients'];
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
            $errors['ingredients'] = 'Ingredients must be a comma separated list';
        }
    }

    if(array_filter($errors)){
        echo 'errer';
    }else{

        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $ingredients = mysqli_real_escape_string($conn,$_POST['ingredients']);
        $title = mysqli_real_escape_string($conn,$_POST['title']);

        $sql = "INSERT INTO pizza_system(title,email,ingrediants) VALUES ('$title','$email','$ingredients')";

        if(mysqli_query($conn,$sql)){
            header('Location: index.php');
        }else{
            echo 'error'.mysqli_error($conn);
        }

        
    }

}

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

    <section class="container grey-text">
        <h4 class="center">Add a Pizza</h4>
        <form action="add.php" method="POST" class="white">
            <label for="">Your Email : </label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>"><!-- values save wenwa text ekedi -->
            <div class="red-text"><?php echo $errors['email'] ?></div>

            <label for="">Pizza title : </label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
            <div class="red-text"><?php echo $errors['title'] ?></div>

            <label for="">Ingredients(comma separated):</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
            <div class="red-text"><?php echo $errors['ingredients'] ?></div>
            <div class="center">
                <input type="submit" value="submit" name="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

	<?php include('templates/footer.php'); ?>

</html>
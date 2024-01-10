<?php

$page = "users";
include('../Layout/header.php');

// var_dump($_GET['id']);
// exit();

$id = '';
$role = '';
$name = '';
$email = '';
$password = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $result = mysqli_query($connect, "SELECT * FROM category WHERE id='$id'");
    $data = mysqli_fetch_assoc($result);

    $name = $data['name'];
}

if (isset($_POST['save'])) {

    $name = $_POST['name'];

    if ($id != '') {

        $result = mysqli_query($connect, "UPDATE category SET name='$name' WHERE id='$id'");
    } else {
        
        $result = mysqli_query($connect, "INSERT INTO category (name) VALUES ('$name')");
    }

    if ($result) {
        $_SESSION['message'] = "Category saved successfully";
        header("location:index.php");
    } else {
        $_SESSION['error_message'] = "Category failed to save";
        header("location:index.php");
    }
}

?>


<h4 class="mt-4">Add Category</h4>
<div class="card" id="form-Category">
    <div class="card-body">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-12">
                    <label for="name" class="form-label my-2">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?= $name ?? '' ?>" required placeholder="Enter categories name">
                </div>
            </div>
            <button type="submit" class="btn btn-primary my-4" style="float: right;" name="save">Save</button>
            <a href="index.php" class="btn btn-secondary my-4 me-2" style="float: right;">Back</a>
        </form>
    </div>
</div>

<?php 
include('../Layout/footer.php');

ob_end_flush(); // Flush the output buffer
?>

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


    $result = mysqli_query($connect, "SELECT * FROM users WHERE id='$id'");
    $data = mysqli_fetch_assoc($result);

    $role = $data['role'];
    $name = $data['name'];
    $email = $data['email'];
}

if (isset($_POST['save'])) {

    $role = $_POST['role'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    if ($id != '') {

        $result = mysqli_query($connect, "UPDATE users SET role='$role', name='$name', email='$email', password='$password' WHERE id='$id'");
    } else {
        
        $result = mysqli_query($connect, "INSERT INTO users (role, name, email, password) VALUES ('$role', '$name', '$email', '$password')");
    }

    if ($result) {
        $_SESSION['message'] = "User saved successfully";
        header("location:index.php");
    } else {
        $_SESSION['error_message'] = "User failed to save";
        header("location:index.php");
    }
}

?>


<!-- HTML Content for Add User Form -->
<h4 class="mt-4">Add User</h4>
<div class="card" id="form-user">
    <div class="card-body">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6" id="select">
                    <label for="role" class="form-label my-2">Role</label>
                    <select name="role" class="form-select" required id="role">
                        <option value="">Select Role</option>
                        <option value="1" <?= ($role == '1') ? 'selected' : '' ?>>Admin</option>
                        <option value="0" <?= ($role == '0') ? 'selected' : '' ?>>Client</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="name" class="form-label my-2">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?= $name ?? '' ?>" required placeholder="Enter your name">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label my-2">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?= $email ?? '' ?>" required placeholder="Enter your email">
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label my-2">Password</label>
                    <input type="text" name="password" id="password" class="form-control" value="" required placeholder="Enter your password">
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

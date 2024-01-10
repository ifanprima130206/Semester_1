<?php
$page = "product";
include('../Layout/header.php');

$category_read = read("category");

$id = '';
$name = '';
$category = '';
$price = '';
$stock = '';
$image = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = mysqli_query($connect, "SELECT * FROM product WHERE id='$id'");
    $data = mysqli_fetch_assoc($result);

    $name = $data['name'];
    $category = $data['category_id'];
    $price = $data['price'];
    $stock = $data['stock'];
    $image = $data['image'];
    $description = $data['description'];
}


if (isset($_POST['save'])) {

    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image = $_FILES['image'];
    $description = $_POST['description'];

    if ($_GET['id'] != '') {

        // var_dump($_FILES);
        // exit();
        if ($_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {

            $result = mysqli_query($connect, "UPDATE product SET name='$name', category_id='$category', price='$price', stock='$stock', description='$description' WHERE id='$id'");

        }else{

            $rand = rand();
            $md_image = md5($rand);
            $ekstensi = array('png', 'jpg', 'jpeg', 'gif');
            $filename = $_FILES['image']['name'];
            $ukuran = $_FILES['image']['size'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $md_image_ext = $md_image . '.' . $ext;

            if (!in_array($ext, $ekstensi)) {
                header("location:index.php");
            } else {
            
                $uploadDirectory = '../../../Public/assets/upload/product/';

                if (is_dir($uploadDirectory)) {

                    move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory . $md_image_ext);
                    $result = mysqli_query($connect, "UPDATE product SET name='$name', category_id='$category', price='$price', stock='$stock', image='$md_image_ext', description='$description' WHERE id='$id'");
                    
                    header("location: index.php");

                } else {

                    header("location:index.php");
                }
            }


        }

    } else {

        $rand = rand();
        $md_image = md5($rand);
        $ekstensi = array('png', 'jpg', 'jpeg', 'gif');
        $filename = $_FILES['image']['name'];
        $ukuran = $_FILES['image']['size'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $md_image_ext = $md_image . '.' . $ext;

        if (!in_array($ext, $ekstensi)) {
            
            $_SESSION['error_message'] = "Failed to upload image. Invalid file extension.";
            header("location:index.php");
        } else {

            move_uploaded_file($_FILES['image']['tmp_name'], '../../../Public/assets/upload/product/' . $md_image_ext);
            header("location:index.php");
            
            $result = mysqli_query($connect, "INSERT INTO product (name, category_id, price, stock, image, description) VALUES ('$name', '$category', '$price', '$stock', '$md_image_ext', '$description')");
        }
        

    }

    if ($result) {
        $_SESSION['message'] = "Product saved successfully";
        header("location:index.php");
    } else {
        $_SESSION['error_message'] = "Product failed to save";
        header("location:index.php");
    }
}

?>

<!-- HTML Content for Add Product Form -->
<h4 class="mt-4">Product</h4>
<div class="card" id="form-product">
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <label for="name" class="form-label my-2">Name</label>
                    <input type="text" name="name" id="name" class="form-control mb-2" value="<?= $name ?? '' ?>" required placeholder="Enter product name">
                </div>
                <div class="col-md-6" id="select">
                    <label for="category" class="form-label my-2">Category</label>
                    <select name="category" class="form-select mb-2" required id="category">
                        <option value="">Select Categories</option>
                        <?php while ($result = mysqli_fetch_array($category_read)) { ?>
                            <option value="<?= $result['id'] ?>" <?= ($category == $result['id']) ? 'selected' : '' ?>><?= $result['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="price" class="form-label my-2">Price</label>
                    <input type="number" name="price" id="price" class="form-control mb-2" value="<?= $price ?? '' ?>" required placeholder="Enter product price">
                </div>
                <div class="col-md-6">
                    <label for="stock" class="form-label my-2">Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control mb-2" value="<?= $stock ?? '' ?>" required placeholder="Enter product stock">
                </div>
                <div class="col-md-12">
                    <label for="image" class="form-label my-2">Upload Image</label>
                    <input type="file" name="image" id="image" class="form-control mb-2" <?= isset($image) ? '' : 'required' ?>>
                </div>
                <div class="col-md-12">
                    <label for="description" class="form-label my-2">Description</label>
                    <textarea name="description" id="description" class="form-control mb-2" rowspan="3" required><?= $description ?? '' ?></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary my-4" style="float: right;" name="save">Save</button>
            <a href="index.php" class="btn btn-secondary my-4 me-2" style="float: right;">Back</a>
        </form>
    </div>
</div>

<?php 
include('../Layout/footer.php');
ob_end_flush();

?>

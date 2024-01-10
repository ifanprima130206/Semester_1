<?php
ob_start(); 
$page = "users";
?>
<?php include('../Layout/header.php'); ?>

<?php
$result_set = read('users');
?>

<div class="row">
    <div class="col-md-12">
        <?php include('../Layout/alert.php') ?>
    </div>
    <div class="col-md-12 my-2">
        <a href="form.php" class="btn btn-primary" style="float: right">+ Create</a>
    </div>
    <div class="col-12 my-2">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1; 
                            while ($result = mysqli_fetch_array($result_set)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td class="text-nowrap"><?php echo $result['name']; ?></td>
                                    <td class="text-nowrap"><?php echo $result['email']; ?></td>
                                    <td>
                                        <?php if ($result['role'] == '1'): ?>
                                            <span class="badge bg-primary">Admin</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">Client</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group dropstart">
                                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <em class="bx bx-dots-vertical-rounded"></em>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="form.php?id=<?= $result['id'] ?>" class="dropdown-item py-2" id="edit"><span class="bx bx-edit"></span> Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item py-2" href="#" onclick="confirmDelete(<?php echo $result['id']; ?>)"><span class="bx bx-trash"></span> Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        var result = confirm("Are you sure you want to delete this user?");
        if (result) {
            // If the user clicks "OK" in the confirmation alert, redirect to the delete page
            window.location.href = 'delete.php?id=' + id;
        }
    }
</script>

<?php
ob_end_flush();
include('../Layout/footer.php'); 
?>

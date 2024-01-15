<?php require_once('../Controller/HouseController.php'); ?>

<?php require_once('../Layout/header.php'); ?>

<div class="container">
    <h3 class="mt-5">Are you sure you want to delete it?</h3>
    <div class="row">
        <div class="col">
            <a href="add.php" class="btn btn-secondary w-100">No</a>
        </div>
        <div class="col">
            <form action="#" method="post">
                <button type="submit" class="btn btn-danger w-100" name="delete_house">Yes</button>
            </form>
        </div>
    </div>
</div>

<?php require_once('../Layout/footer.php'); ?>
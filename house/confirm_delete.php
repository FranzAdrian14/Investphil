<?php require_once('../Layout/header.php'); ?>

<title>Confirmation</title>

<div class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete?</p>
            </div>
            <div class="modal-footer">
                <a href="list.php" class="btn btn-primary" data-bs-dismiss="modal">Back</a>
                <form action="#" method="post">
                    <button type="submit" class="btn btn-danger" name="confirm">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once('../Layout/footer.php'); ?>
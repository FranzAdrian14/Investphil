<?php require_once('../Controller/CheckAuthController.php'); ?>
<?php require_once('../Controller/ClientController.php'); ?>

<?php require_once('../Layout/header.php'); ?>

<?php include '../topbar.php'; ?>
<?php include '../navbar.php'; ?>

<div class="container">
    <label for="client_list" class="mt-5">Select Client</label>
    <select class="form-select" aria-label="Default select example" id="client_list">
        <option selected>Select client</option>
        <?php foreach($clients as $client): ?>
            <?php if(empty($client->middle_name)): ?>
                <option value="<?=$client->user_id?>"><?=$client->first_name;?> <?=$client->last_name?></option>
            <?php else: ?>
                <option value="<?=$client->user_id?>"><?=$client->first_name;?> <?=$client->middle_name[0] . '.';?> <?=$client->last_name?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select>

    <label for="mode_of_payment" class="mt-3">Mode of Payment</label>
    <select class="form-select" aria-label="Default select example" id="mode_of_payment">
        <option selected>Select Mode of Payment</option>
        <option value="">Cash</option>
        <option value="">GCash</option>
    </select>
</div>

<?php require_once('../Layout/footer.php'); ?>
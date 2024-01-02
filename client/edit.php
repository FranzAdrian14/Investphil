<?php require_once('../Controller/CheckAuthController.php'); ?>
<?php require_once('../Controller/ClientController.php'); ?>
<?php require_once('../Layout/header.php'); ?>

<?php include '../navbar.php'; ?>
<?php include '../topbar.php'; ?>

<div class="container">
	<form action="#" method="post">
        <?php if(isset($_GET['messageSuccess'])): ?>
        <div class="alert alert-success mt-5">
            <?php echo $_GET['messageSuccess']; ?>
        </div>
        <?php elseif($messageFailed): ?>
        <div class="alert alert-danger mt-5">
            <?php echo $messageFailed; ?>
        </div>
        <?php endif; ?>
		<div class="row">
			<div class="col">
				<div class="mt-3 mb-3">
					<label for="first_name">First Name</label>
					<input type="text" class="form-control" id="first_name" name="first_name" value="<?=$client->first_name;?>" />
				</div>
				<div class="mb-3">
					<label for="first_name">Middle Name</label>
					<input type="text" class="form-control" id="middle_name" name="middle_name" value="<?=$client->middle_name;?>" />
				</div>
				<div class="mb-3">
					<label for="first_name">Last Name</label>
					<input type="text" class="form-control" id="last_name" name="last_name" value="<?=$client->last_name;?>" />
				</div>
				<div class="mb-3">
					<label for="age">Age</label>
					<input type="text" class="form-control" id="age" name="age" value="<?=$client->age;?>" />
				</div>
			</div>
			<div class="col">
                <div class="mt-3 mb-3">
                    <label for="user_role">Gender</label>
                    <select class="form-select" aria-label="role" id="gender_id" name="gender_id">
                        <option value="<?=$client->gender_id;?>" selected><?=$client->gender;?></option>
                        <?php foreach($genders as $gender): ?>
                        <option value="<?=$gender->gender_id;?>"><?=$gender->gender;?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
				<div class="mb-3">
					<label for="email">Email</label>
					<input type="text" class="form-control" id="email" name="email" value="<?=$client->email;?>" />
				</div>
				<div class="mb-3">
					<label for="contact_number">Contact Number</label>
					<input type="text" class="form-control" id="contact_number" name="contact_number" value="<?=$client->contact_number;?>" />
				</div>
                <div class="mb-3">
					<label for="confirm_password">User Role</label>
					<select class="form-select" aria-label="role" id="user_role_id" name="user_role_id">
                        <option value="<?=$client->user_role_id;?>" selected><?=$client->role;?></option>
                        <?php foreach($userRoles as $userRole): ?>
                        <option value="<?=$userRole->user_role_id;?>"><?=$userRole->role;?></option>
                        <?php endforeach; ?>
                    </select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<a href="list.php" class="btn btn-secondary mt-3 w-100">Back</a>
			</div>
			<div class="col">
				<button type="submit" class="btn btn-primary mt-3 w-100" name="edit_client">Save</button>
			</div>
		</div>
	</form>
</div>

<?php require_once('../Layout/footer.php'); ?>
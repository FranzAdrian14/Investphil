<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}
if($action == 'update_account'){
	$save = $crud->update_account();
	if($save)
		echo $save;
}
if($action == "save_settings"){
	$save = $crud->save_settings();
	if($save)
		echo $save;
}
if($action == "save_category"){
	$save = $crud->save_category();
	if($save)
		echo $save;
}

if($action == "delete_category"){
	$delete = $crud->delete_category();
	if($delete)
		echo $delete;
}
if($action == "save_house"){
	$save = $crud->save_house();
	if($save)
		echo $save;
}
if($action == "delete_house"){
	$save = $crud->delete_house();
	if($save)
		echo $save;
}

if($action == "save_tenant"){
	$save = $crud->save_tenant();
	if($save)
		echo $save;
}
if($action == "delete_tenant"){
	$save = $crud->delete_tenant();
	if($save)
		echo $save;
}
if($action == "get_tdetails"){
	$get = $crud->get_tdetails();
	if($get)
		echo $get;
}

if($action == "save_payment"){
	$save = $crud->save_payment();
	if($save)
		echo $save;
}
if($action == "delete_payment"){
	$save = $crud->delete_payment();
	if($save)
		echo $save;
}
if (isset($_POST['action']) && $_POST['action'] == 'save_house') {
    $house_no = $_POST['house_no'];
    $category_id = $_POST['category_id'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if (isset($_FILES['house_image'])) {
        $image_name = $_FILES['house_image']['name'];
        $image_tmp = $_FILES['house_image']['tmp_name'];
        $image_path = 'upload/' . $image_name; // Define your upload directory
        move_uploaded_file($image_tmp, $image_path);
    } else {
        $image_path = ''; // Set a default image path if no file was uploaded
    }

    // Rest of your code to save the house details
    // ...

    // Make sure to save $image_path in your database, so you can display it later.

    // Return a response, e.g., "1" for success
    echo "1";
    exit;
}

ob_end_flush();
?>

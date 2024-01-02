<?php require_once('Controller/CheckAuthController.php'); ?>
<?php require_once('Controller/CategoryController.php'); ?>
<?php include('db_connect.php');?>
<?php require_once('Layout/header.php'); ?>

<title>PHILINVEST | Categories</title>

<?php
include 'navbar.php';
include 'topbar.php';
?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="#" method="post" id="manage-category">
				<div class="card">
					<div class="card-header">
						    Category Form
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<?php if($messageSuccess): ?>
								<div class="alert alert-success">
									<?php echo $messageSuccess; ?>
								</div>
								<?php elseif($messageFailed): ?>
								<div class="alert alert-danger">
									<?php echo $messageFailed; ?>
								</div>
								<?php endif; ?>
								<label class="control-label">Name</label>
								<input type="text" class="form-control" name="save_category">
							</div>
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-sm btn-primary col-sm-3 offset-md-3" name="save"> Save</button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#manage-category').get(0).reset()"> Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<b>Category List</b>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Category</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($categories as $category): ?>
								<tr>
									<td><?=$category->category_id;?></td>
									<td><?=$category->category;?></td>
									<td>
										<div class="btn-group" role=""group>
											<!-- 
												Example
												<a href="filename.php?category_id=<?=$category->user_id?>" class="btn btn-outline-primary">View</a> 
											-->
											<a href="#" class="btn btn-outline-primary">View</a>
											<a href="#" class="btn btn-outline-warning">Edit</a>
											<a href="#" class="btn btn-outline-danger">Delete</a>
										</div>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
</style>
<script>
	
	// $('#manage-category').submit(function(e){
	// 	e.preventDefault()
	// 	start_load()
	// 	$.ajax({
	// 		url:'ajax.php?action=save_category',
	// 		data: new FormData($(this)[0]),
	// 	    cache: false,
	// 	    contentType: false,
	// 	    processData: false,
	// 	    method: 'POST',
	// 	    type: 'POST',
	// 		success:function(resp){
	// 			if(resp==1){
	// 				alert_toast("Data successfully added",'success')
	// 				setTimeout(function(){
	// 					location.reload()
	// 				},1500)
// 
	// 			}
	// 			else if(resp==2){
	// 				alert_toast("Data successfully updated",'success')
	// 				setTimeout(function(){
	// 					location.reload()
	// 				},1500)
// 
	// 			}
	// 		}
	// 	})
	// })
	// $('.edit_category').click(function(){
	// 	start_load()
	// 	var cat = $('#manage-category')
	// 	cat.get(0).reset()
	// 	cat.find("[name='id']").val($(this).attr('data-id'))
	// 	cat.find("[name='name']").val($(this).attr('data-name'))
	// 	end_load()
	// })
	// $('.delete_category').click(function(){
	// 	_conf("Are you sure to delete this category?","delete_category",[$(this).attr('data-id')])
	// })
	// function delete_category($id){
	// 	start_load()
	// 	$.ajax({
	// 		url:'ajax.php?action=delete_category',
	// 		method:'POST',
	// 		data:{id:$id},
	// 		success:function(resp){
	// 			if(resp==1){
	// 				alert_toast("Data successfully deleted",'success')
	// 				setTimeout(function(){
	// 					location.reload()
	// 				},1500)
// 
	// 			}
	// 		}
	// 	})
	// }
	// $('table').dataTable()
</script>
<?php require_once('Layout/footer.php'); ?>
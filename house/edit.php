<?php 
require_once('../Controller/CheckAuthController.php');
require_once('../Controller/CategoryController.php');
require_once('../Controller/HouseController.php');
include('../db_connect.php');
require_once('../Layout/header.php');

include '../navbar.php';
include '../topbar.php';
?>

<style>
    
    td{
        vertical-align: middle !important;
    }
    td p {
        margin: flex;
        padding: flex;
        line-height: 2em;
    }
</style>
	
<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="#" id="manage-house" method="post">
                <?php if(isset($_GET['messageSuccess'])): ?>
                    <div class="alert alert-success">
                        <?php echo $_GET['messageSuccess']; ?>
                    </div>
				<?php endif; ?>
				<?php if($messageFailed): ?>
                    <div class="alert alert-danger">
                        <?php echo $messageFailed; ?>
                    </div>
				<?php endif; ?>
				<div class="card">
					<div class="card-header">
						    House Form
				  	</div>
					<div class="card-body">
							<div class="form-group" id="msg"></div>
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">House No</label>
								<input type="text" class="form-control" name="house_no" value="<?=$house->house_no;?>" required>
							</div>
							<div class="form-group">
								<label class="control-label">Category</label>
								<select name="category_id" id="" class="custom-select" required>
									<option value="<?=$house->category_id;?>" selected hidden><?=$house->category;?></option>
									<?php foreach($categories as $category): ?>
                                        <option value="<?=$category->category_id;?>"><?=$category->category;?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label for="" class="control-label">Description</label>
								<textarea name="description"  id="" cols="30" rows="4" class="form-control" required><?=$house->description;?></textarea>
							</div>
							<div class="form-group">
								<label class="control-label">Price</label>
								<input type="number" class="form-control text-right" name="price" value="<?=$house->price;?>" step="any" required="">
							</div>
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-sm btn-primary col-sm-3 offset-md-3" name="edit_house"> Save</button>
								<button class="btn btn-sm btn-default col-sm-3" type="reset" > Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->
		</div>
		
<script>
	// $('#manage-house').on('reset',function(e){
	// 	$('#msg').html('')
	// })
	// $('#manage-house').submit(function(e){
	// 	e.preventDefault()
	// 	start_load()
	// 	$('#msg').html('')
	// 	$.ajax({
	// 		url:'ajax.php?action=save_house',
	// 		data: new FormData($(this)[0]),
	// 	    cache: false,
	// 	    contentType: false,
	// 	    processData: false,
	// 	    method: 'POST',
	// 	    type: 'POST',
	// 		success:function(resp){
	// 			if(resp==1){
	// 				alert_toast("Data successfully saved",'success')
	// 				setTimeout(function(){
	// 					location.reload()
	// 				},1500)

	// 			}
	// 			else if(resp==2){
	// 				$('#msg').html('<div class="alert alert-danger">House number already exist.</div>')
	// 				end_load()
	// 			}
	// 		}
	// 	})
	// })
	// $('.edit_house').click(function(){
	// 	start_load()
	// 	var cat = $('#manage-house')
	// 	cat.get(0).reset()
	// 	cat.find("[name='id']").val($(this).attr('data-id'))
	// 	cat.find("[name='house_no']").val($(this).attr('data-house_no'))
	// 	cat.find("[name='description']").val($(this).attr('data-description'))
	// 	cat.find("[name='price']").val($(this).attr('data-price'))
	// 	cat.find("[name='category_id']").val($(this).attr('data-category_id'))
	// 	end_load()
	// })

	// $('.delete_house').click(function(){
	// 	_conf("Are you sure to delete this house?","delete_house",[$(this).attr('data-id')])
	// })
	// function delete_house($id){
	// 	start_load()
	// 	$.ajax({
	// 		url:'ajax.php?action=delete_house',
	// 		method:'POST',
	// 		data:{id:$id},
	// 		success:function(resp){
	// 			if(resp==1){
	// 				alert_toast("Data successfully deleted",'success')
	// 				setTimeout(function(){
	// 					location.reload()
	// 				},1500)

	// 			}
	// 		}
	// 	})
	// }
	// $('table').dataTable()
</script>
<?php require_once('../Layout/footer.php'); ?>
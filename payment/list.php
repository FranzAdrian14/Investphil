<?php require_once('../Controller/CheckAuthController.php'); ?>
<?php require_once('../db_connect.php');?>

<?php require_once('../Layout/header.php'); ?>

<style>
    
    td{
        vertical-align: middle !important;
    }
    td p{
        margin: unset
    }
    img{
        max-width:100px;
        max-height: :150px;
    }
</style>

<?php include '../topbar.php'; ?>
<?php include '../navbar.php'; ?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>List of Payments</b>
						<span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="add.php" id="new_invoice">
					<i class="fa fa-plus"></i> New Entry
				</a></span>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">Invoice</th>
									<th class="text-center">Client</th>
									<th class="text-center">Amount</th>
									<th class="text-center">Date</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
                                <?php foreach($payments as $payment): ?>
                                    <tr>
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
<script>
	// $(document).ready(function(){
	// 	$('table').dataTable()
	// })
	
	// $('#new_invoice').click(function(){
	// 	uni_modal("New invoice","manage_payment.php","mid-large")
		
	// })
	// $('.edit_invoice').click(function(){
	// 	uni_modal("Manage invoice Details","manage_payment.php?id="+$(this).attr('data-id'),"mid-large")
		
	// })
	// $('.delete_invoice').click(function(){
	// 	_conf("Are you sure to delete this invoice?","delete_invoice",[$(this).attr('data-id')])
	// })
	
	// function delete_invoice($id){
	// 	start_load()
	// 	$.ajax({
	// 		url:'ajax.php?action=delete_payment',
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
</script>
<?php require_once('../Layout/footer.php'); ?>
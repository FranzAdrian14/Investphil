<?php
require_once('../Controller/CheckAuthController.php');
require_once('../Controller/ClientController.php');
include('../db_connect.php');
require_once('../Layout/header.php');

include '../navbar.php';
include '../topbar.php';
?>


<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<!--<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>List of Client</b>
						<span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="manage_tenant.php" id="new_client">
					<i class="fa fa-plus"></i> New Client
				</a></span>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Name</th>
									<th class="">House Rented</th>
									<th class="">Monthly Rate</th>
									<th class="">Outstanding Balance</th>
									<th class="">Last Payment</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$tenant = $conn->query("SELECT t.*,concat(t.lastname,', ',t.firstname,' ',t.middlename) as name,h.house_no,h.price FROM tenants t inner join houses h on h.id = t.house_id where t.status = 1 order by h.house_no desc ");
								while($row=$tenant->fetch_assoc()):
									$months = abs(strtotime(date('Y-m-d')." 23:59:59") - strtotime($row['date_in']." 23:59:59"));
									$months = floor(($months) / (30*60*60*24));
									$payable = $row['price'] * $months;
									$paid = $conn->query("SELECT SUM(amount) as paid FROM payments where tenant_id =".$row['id']);
									$last_payment = $conn->query("SELECT * FROM payments where tenant_id =".$row['id']." order by unix_timestamp(date_created) desc limit 1");
									$paid = $paid->num_rows > 0 ? $paid->fetch_array()['paid'] : 0;
									$last_payment = $last_payment->num_rows > 0 ? date("M d, Y",strtotime($last_payment->fetch_array()['date_created'])) : 'N/A';
									$outstanding = $payable - $paid;
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td>
										<?php echo ucwords($row['name']) ?>
									</td>
									<td class="">
										 <p> <b><?php echo $row['house_no'] ?></b></p>
									</td>
									<td class="">
										 <p> <b><?php echo number_format($row['price'],2) ?></b></p>
									</td>
									<td class="text-right">
										 <p> <b><?php echo number_format($outstanding,2) ?></b></p>
									</td>
									<td class="">
										 <p><b><?php echo  $last_payment ?></b></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary view_payment" type="button" data-id="<?php echo $row['id'] ?>" >View</button>
										<button class="btn btn-sm btn-outline-primary edit_tenant" type="button" data-id="<?php echo $row['id'] ?>" >Edit</button>
										<button class="btn btn-sm btn-outline-danger delete_tenant" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div> -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>List of Client</b>
						<span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="add.php" id="new_client">
					<i class="fa fa-plus"></i> New Client
				</a></span>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<?php if(isset($_GET['messageSuccess'])): ?>
								<div class="alert alert-success">
									<?php echo $_GET['messageSuccess']; ?>
								</div>
							<?php endif; ?>
							<thead>
								<tr>
									<th>No.</th>
									<th>First Name</th>
									<th>Middle Name</th>
									<th>Last Name</th>
									<th>Age</th>
									<th>Gender</th>
									<th>Email</th>
									<th>Contact Number</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($clients as $client): ?>
								<tr>
									<td><?=$client->user_id;?></td>
									<td><?=$client->first_name;?></td>
									<td><?=$client->middle_name;?></td>
									<td><?=$client->last_name;?></td>
									<td><?=$client->age;?></td>
									<td><?=$client->gender;?></td>
									<td><?=$client->email;?></td>
									<td><?=$client->contact_number;?></td>
									<td>
										<div class="btn-group" role=""group>
											<!-- 
												Example
												<a href="filename.php?client_id=<?=$client->user_id;?>" class="btn btn-outline-primary">View</a> 
											-->
											<a href="view.php?client_id=<?=$client->user_id;?>" class="btn btn-outline-primary">View</a>
											<a href="edit.php?client_id=<?=$client->user_id;?>" class="btn btn-outline-warning">Edit</a>
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
<?php require_once('../Layout/footer.php'); ?>
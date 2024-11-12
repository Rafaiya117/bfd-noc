<?php

pg_header();
show_banner('login', 'Super Admin  :: Applicant Section');

pg_topnavbar();



//include 'pages/nav.php';
?>

<body>
	<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper card">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-6">
							<h3 style="color:  #FFFFFF">Applicant List 

							</h3>
						</div>
						<div class="col-sm-6">
							<!-- <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="fa fa-download">&#xE147;</i> <span> Download </span></a>						 -->
							<!-- <span>Search</span><input type="text" name="search" class="form-control inner-textfield"> -->
						</div>
					</div>
				</div>
				<table class="table  table-striped table-hover">
					
					<thead>


						<tr>
						<th scope="col"style="text-align: center;">SL No.</th>
							<th scope="col"style="text-align: center;">Name</th>
							<th scope="col"style="text-align: center;">Email</th>
							<th scope="col"style="text-align: center;">Phone</th>
							<th scope="col"style="text-align: center;">Company Name</th>
							<!-- <th scope="col">Headcount</th> -->
						</tr>
					</thead>

					<tbody>
						<?php
						
							for ($i = 0, $ilen = sizeof($rows); $i < $ilen; $i += 1) {
								$member = $rows[$i];
								
								echo '<tr><td><a href="vendor_details.php?id=',$member['id'],'">', $member['id'], '</a></td>';
								echo'<td>', $member['name'], '</td>
								<td>', $member['email'], '</td>
                                <td>', $member['phone'], '</td>
						        <td>', $member['company_name'], '</td>
								<td><a href="vendor_details.php?id=',$member['id'],'">Edit</a></td>
								<td><a href="vendor_passwordchange.php?id=',$member['id'],'">Change Password</a></td>
							</tr>';
							
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">
						<h4 class="modal-title">Download</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Company Name</label>
							<input type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Address</label>
							<input type="" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Head Count</label>
							<textarea class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Date</label>
							<input type="text" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">
						<h4 class="modal-title">Edit</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Company Name</label>
							<input type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Address</label>
							<input type="" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Head Count</label>
							<textarea class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Date</label>
							<input type="text" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-info" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php
	include '../super-admin-view/page-section/footer.php';
	?>
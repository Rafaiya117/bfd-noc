<?php
include '../header-footer/header.php';
include '../header-footer/navbar.php';
// include 'pages/nav.php';
?>
<style>
	.permitbtn {
		position: absolute;
		right: 50px;
		bottom: 30px
	}
</style>

<body>
	
	<div class="container-xl">

		<div class="card mt-3 border-0">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h3 style="color:  #FFFFFF">List of all NOCs</h3>
					</div>
					<div class="col-sm-6">
						
					</div>
				</div>
			</div>
		</div>
		<div class="table-responsive mt-0">
		<?php show_noc_list($rows); ?>
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
	include '../header-footer/footer.php';
	?>
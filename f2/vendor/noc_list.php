<?php
die('this is a dead page.. ');
include '_a.php';
must_login();

$rows = $db->select('SELECT *
from noc_import  limit 20');



pg_header();
show_banner('cites_non_cites');
pg_topnavbar();
?>
<style>
	.permitbtn{position:absolute; right:50px; bottom:30px}
</style>
<body>
<div class="container-xl">
	<div class="card mt-3 border-0">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-6">
					<h3 style="color:  #FFFFFF">List of NOC's</h3>
				</div>
				<div class="col-sm-6">
					<!-- <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="fa fa-download">&#xE147;</i> <span> Download </span></a>						 -->
					<!-- <input type="text" name="search" placeholder="search..." class="form-control inner-textfield"> -->
				</div>
			</div>
		</div>
	</div>
	<div class="table-responsive mt-0">
		<table class="table  table-striped table-hover">
			<thead>
				<tr>
					<th>Memo No.</th>
					<th>Company Information</th>
					<th>Head Count</th>
					<th>Application Date</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					for($i=0, $ilen=sizeof($rows);$i<$ilen;$i+=1){
						$noc = $rows[$i];
						echo '<tr>
						<td><a href="./details.php?id=',$noc['id'],'">',$noc['memo_no'],'</a></td>
						<td><a href="./details.php?id=',$noc['id'],'">',$noc['company_name'],'<br>',$noc['company_address'],'</a></td>
						<td>',$noc['headcount'],'</td>
						<td>', bd_date_format($noc['application_date']),'</td>
						
						</tr>';	
					}
				?>
				</tbody>		
			</table>
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
pg_footer();
?>
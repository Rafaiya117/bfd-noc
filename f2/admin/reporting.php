<?php
include '_a.php';


$birds = [];


if(!empty($_POST)){
    if(empty($_POST['noc_type']) || empty($_POST['sub_of_noc']) || empty($_POST['start_date']) || empty($_POST['end_date'])){
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }
    
        update_headcount_all();
       $total_nocs = $db->select('SELECT count(id) as `noc_count`, sum(headcount) as `total_head_count`, count(DISTINCT noc_import.user_id) as `applicant_count`
       
                        from noc_import 
                        where `status`="1000_signed_document"  and noc_type = ? and sub_of_noc = ? and application_date between ? and ? 
                        
                        ', 
                            $_POST['noc_type'], $_POST['sub_of_noc'], $_POST['start_date'], $_POST['end_date']    
                        )[0];
        // echo 'SELECT count(id) as `noc_count`, sum(headcount) as `total_head_count`, count(DISTINCT noc_import.user_id) as `applicant_count`
       
        //                 from noc_import 
        //                 where `status`="1000_signed_document"  
        //                 and noc_type = "', $_POST['noc_type'] ,'" and sub_of_noc = "' ,$_POST['sub_of_noc'] ,
        //                 '" and application_date between "',$_POST['start_date'],'" and "',$_POST['end_date'],'" ' ; 
                            
        
        // if(empty($nocs)){
        //     echo '<div class="alert alert-danger">No data found for the selected parameters</div>';
        //     exit;
        // }

        $monthly = $db->select('SELECT 
                                    YEAR(application_date) AS `year`,
                                    MONTHNAME(application_date) AS `month`,
                                    COUNT(id) AS `noc_count`,
                                    SUM(headcount) AS `total_head_count`,
                                    COUNT(DISTINCT noc_import.user_id) AS `applicant_count`
                                FROM
                                    noc_import
                                WHERE
                                    `status` = "1000_signed_document"
                                    AND noc_type = ?
                                    AND sub_of_noc = ?
                                    AND application_date BETWEEN ? AND ?
                                GROUP BY
                                    YEAR(application_date),
                                    MONTH(application_date);
                        ', 
                            $_POST['noc_type'], $_POST['sub_of_noc'], $_POST['start_date'], $_POST['end_date']    
                        );

       $birds = $db->select('SELECT imp_noc_species_duplicate.species_scientific_name,  imp_noc_species_duplicate.species_english_name, 
                        count(imp_noc_species_duplicate.id) as `frequency`, 
                        sum(imp_noc_species_duplicate.quantity) as `headcount`,
                        count(DISTINCT noc_import.user_id) as `unique_applicants_count`
                    from imp_noc_species_duplicate 
                    inner join noc_import on imp_noc_species_duplicate.noc_id = noc_import.id
                    where noc_import.`status`="1000_signed_document" 
                                and noc_import.noc_type = ? and noc_import.sub_of_noc = ? 
                                and noc_import.application_date between ? and ? 

                    group by imp_noc_species_duplicate.species_scientific_name 
                    order by  sum(imp_noc_species_duplicate.quantity) desc, count(imp_noc_species_duplicate.id) desc ', 
                    $_POST['noc_type'], $_POST['sub_of_noc'], $_POST['start_date'], $_POST['end_date']    
                );

    // pre($birds, 'birds on report! ');

}



pg_header();
show_banner('home2', '<br>Reporting Tool');
pg_topnavbar();


?>
<div class="container">
<h1> Reporting Tool</h1>
<div class="card">
    <div class="card-header">  
            <h7>Select Reporting parameters</h7>
    </div>
    <div class="card-body">
        <form method="POST">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="noc_type">NOC type<small class="text-danger" >*</small></label>
                    <select class="form-control" id="noc_type" name="noc_type" required >
                    <option value="" disabled selected ></option>
                        <option value="import" >Import</option>
                        <option value="export" >Export</option>
                        <!-- <option value="all">Both Import & Export</option> -->
                        
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="sub_of_noc">Select CITES / NON-CITES <small class="text-danger" >*</small></label>
                    <select class="form-control" id="sub_of_noc" name="sub_of_noc" required >
                        <option value="" disabled selected ></option>
                        <option value="CITES" >CITES</option>
                        <option value="NON-CITES" >NON-CITES</option>
                        <!-- <option value="all">Both CITES & NON-CITES</option> -->
                        
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="start_date"> Starting Application Date <small class="text-danger" >*</small></label>
                    <input class="form-control" type="date" id="start_date" name="start_date" required />
                    
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="end_date"> Closing Application Date <small class="text-danger" >*</small></label>
                    <input class="form-control" type="date" id="end_date" name="end_date" required />
                    
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <div style="margin-top:32px;">
                    <button type="submit" class="form-control btn btn-primary">Generate Report</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    </div>    
</div>

<?php 


if(!empty($birds)){ 
    // pre($birds, 'birds on report! ');    
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">  
                    <h3>Report</h3>
                    <p> Report showing the frequency of species in the 
                        selected NOC type <?php echo $_POST['sub_of_noc']; ?>  <?php echo ucfirst($_POST['noc_type']); ?> 
                        
                        from <i><?php echo bd_date_format($_POST['start_date']); ?></i> to <i><?php echo bd_date_format($_POST['end_date']); ?></i>

                        <table class="table table-bordered table-striped" style="text-align: center;">
                            <tr>
                                <td>Total NOCs</td>
                                <td>Total Headcount</td>
                                <td>Number of Applicants</td>
                            </tr>
                            
                            <tr>
                                
                                <td><?php echo $total_nocs['noc_count'] ?></td>
                                <td><?php echo $total_nocs['total_head_count']; ?></td>
                                <td><?php echo $total_nocs['applicant_count']; ?></td>
                            </tr>
                        </table>
                    </p>

            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>Species Scientific Name</th>
                            <th>Species English Name</th>
                            
                            <th>Headcount</th>
                            <th>No Application</th>
                            <th>No Unique Applicant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($birds as $bird){ ?>
                            <tr>
                                <td><i><?php echo $bird['species_scientific_name']; ?></i></td>
                                <td><?php echo $bird['species_english_name']; ?></td>
                                <td><?php echo $bird['headcount']; ?></td>
                                <td><?php echo $bird['frequency']; ?></td>
                                <td><?php echo $bird['unique_applicants_count']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>


                <h4>Monthly Report </h4>
                <table class="table table-bordered table-striped" style="text-align: center;">
                    <thead>
                        <tr>
                            
                            <th>Month</th>
                            <th>Total NOCs</th>
                            <th>Total Headcount</th>
                            <th>Number of Applicants</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($monthly as $month){ ?>
                            <tr>
                                
                                <td><?php echo $month['month'], ' ', $month['year'];; ?></td>
                                <td><?php echo $month['noc_count']; ?></td>
                                <td><?php echo $month['total_head_count']; ?></td>
                                <td><?php echo $month['applicant_count']; ?></td>
                            </tr>
                        <?php } ?>
                            <tr>
                                
                                <td>Total</td>
                                <td><?php echo $total_nocs['noc_count']; ?></td>
                                <td><?php echo $total_nocs['total_head_count']; ?></td>
                                <td><?php echo $total_nocs['applicant_count']; ?></td>
                            </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
<?php
 } 
?>

</div>
<?php
pg_footer();



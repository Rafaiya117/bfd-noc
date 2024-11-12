<?php
include '_a.php';
must_login();
pg_header();
show_banner('login', 'Super Admin  :: Online NOC System');
$applicants = $db->select('select * from `vendor` order by `id` desc limit 40');
pg_topnavbar();
// include 'pages/dash_navbar.php';
?>

    
    <div class="container">
        <h1>  Applicant list  </h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        All Applicants
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Purpose</th>
                                    <th>Company Name</th>
                                    <th>BFD License No</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $sn = 1;
                                foreach ($applicants as $applicant) {
                                    echo '<tr>';
                                    echo '<td>' , $sn++ , '</td>';
                                    echo '<td>' , $applicant['name'] , '</td>';
                                    echo '<td>' , $applicant['email'] , '</td>';
                                    echo '<td>' , $applicant['phone'] , '</td>';
                                    echo '<td>' , $applicant['address'] , '</td>';
                                    echo '<td>' , $applicant['company_name'] , '</td>';
                                    echo '<td>' , $applicant['company_licence_num'] , '</td>';
                                    echo '<td> <a href="./page-view/vendor_details.php?id=' , $applicant['id'] , '">View</a> </td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    <!-- end row -->
    <?php pg_footer();